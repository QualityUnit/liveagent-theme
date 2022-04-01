#all necessary imports
import re

from usp.tree import sitemap_tree_for_homepage
import urllib
from bs4 import BeautifulSoup
import difflib
from sklearn.feature_extraction.text import TfidfVectorizer
import faiss
import numpy as np
import csv
import os
import sys
from transformers import pipeline
summarizer = pipeline("summarization", model="facebook/bart-large-cnn", device=0)

#this function converts a text into vectors using the previously declared tf-idf vectorizer
def vectorize(text_array):
    global vocab
    vectors = vectorizer.fit_transform(text_array)
    vocab = vectorizer.get_feature_names()
    dense = vectors.todense()
    denselist = dense.tolist()
    return denselist

#this function gets the unique text for a website when compared to a different website
def difference(input_article, reference):
    #most functional
    #splits the two articles into independent lines based on the \n tag in the text
    input_article = input_article.splitlines()
    reference = reference.splitlines()
    #finds the difference between the two articles and puts the simbol for unique lines as the first character of the line ("-" unique to input_article, "+" unique to reference, and " " identical in both)
    difference = difflib.unified_diff(input_article, reference)
    final_article = []
    for line in difference:
        if line[0] == "-":
            final_article.append(line[1:] + " ")
    final_article = ''.join(final_article)
    return final_article

#this function gets the text from a website
def getHtmlText(fullHtml):
    soup = BeautifulSoup(fullHtml, features="lxml")
    try:
        whitelist = [
            'p', 'h1', 'h2', 'h3', 'h4', 'span', 'div'
        ]

        h1s = soup.findAll("h1")
        if (len(h1s) < 1):
            print("******* missing H1!!!!")
            text_elements = [t.strip() for t in soup.find_all(text=True) if t.parent.name in whitelist]
        else:
            text_elements = [t.strip() for t in soup.body.h1.find_all_next(text=True) if t.parent.name in whitelist]

        text_elements = [x for x in text_elements if x.strip()]
        return "\n".join(text_elements).encode('ascii', 'ignore').decode('ascii')

    except:
        print("couldn't get text")
        return ""

def image_alt_text_recommendation(html):
    soup = BeautifulSoup(fullHtml, features="lxml")
    for img in soup.find_all('img'):
        if not('alt' in img) or len(img['alt']) < 5 or len(img['alt']) > 140:
            if 'src' in img:
                print("***** Image: " + img['src'])
            if 'alt' in img:
                print("***** WRONG alt text: " + img['alt'])

#this function gets the title of a website
def getHtmlTitle(fullHtml):
    soup = BeautifulSoup(fullHtml, features="lxml")
    title = soup.find("title")
    try:
        title = title.get_text()
    except AttributeError as error:
        title = ""
    return title

#returns the processed data with the 10 nearest sites to every site on the site map
def faiss_nn(arr, k):
    #setting input into faiss
    d = len(arr[0])
    index = faiss.IndexFlatL2(d) #IndexFlatL2 is a brute search algorythm
    index.add(arr) #adds the training dataset to the faiss index
    D, I = index.search(arr, k) #actual search guess is an array of #_test_values-by-k where each index is equivalent to the index of the test array with k number of nearest neighbors
    #print(I) prints indexes of the k nearest neighbors of all of the webpages on a sitemap
    return I

#this function generates the name of the cache file based on the url given
def get_web_name(input):
    web_name = input[0]
    web_name = web_name[8:]
    web_name = web_name[:-4]
    web_name = web_name.replace(".", "")
    web_name = web_name.replace("www", "")
    web_name = web_name + '.csv'
    return web_name

def is_banned_url(url):
    if "support.qualityunit.com" in url:
        return True

    if "/trial/" in url or \
            "/sitemap/" in url or \
            "/demo/" in url or \
            "/login/" in url or \
            "/free-account/" in url or \
            "/ms_" in url or \
            "/elementor-templates/" in url or \
            url.endswith("/business/") or \
            url.endswith("/industry/") or \
            url.endswith("/academy/") or \
            url.endswith("/templates/") or \
            url.endswith("/customer-support-glossary/") or \
            url.endswith("/blog/") or \
            url.endswith("/integrations/") or \
            url.endswith("/migration/") or \
            url.endswith("/webinars/") or \
            url.endswith("/alternatives/"):
        return True

    return False

#this function gets the Ids which occur in the text too frequently
def ban_ids(arr, p):
    idx_dict = {}
    total = 0
    for nn_list in arr:
        for idx in nn_list:
            if idx not in idx_dict:
                total += 1
                idx_dict[idx] = 1
            else:
                total += 1
                idx_dict[idx] += 1
    banned_ids = []
    for key in idx_dict.keys():
        percent = float(idx_dict[key]) / float(total)
        url = urls[key]
        if percent > p:
            banned_ids.append(key)
        if "Update: " in titles[key]:
            banned_ids.append(key)
    return banned_ids

#this function compares x-1 sites before and after the url and uses the difference function to get the unique text on a website
def diff_loop(i, x):

    diff = texts[i]

    for k in range(1,x):
        #ending fencepost
        if i == len(urls)-1:
            text = texts[len(urls)-(x+k)]
        #ending fencepost wraparound
        elif i+k > len(urls)-1:
            text = texts[(i-x)-(k%(len(urls)-i))]
        #normal case
        else:
            text = texts[i+k]
        diff = difference(diff, text)

    #get and compare x urls before the index
    for k in range(1,x):
        #starting fencepost
        if i == 0:
            text = texts[(i+x)+k]
        #starting fencepost wraparound
        elif i-k < 0:
            text = texts[(i+x)+(k%i)]
        #normal case
        else:
            text = texts[i-k]
        diff = difference(diff, text)
    diff = diff.replace("-- ", "")
    return diff

#establish arrays that output will be taken from (note: the array vocab is also a global array but is declared in specific functions)
urls = []
titles = []
texts = []
summarizations = []
vectors = []

#populate this array with the URLs of the websites you want to run the program on
contentSites = ["https://www.liveagent.com", "https://support.liveagent.com"]
mainUrl = "https://www.liveagent.com"
web_name = get_web_name(contentSites)

#initialize the tf-idf vectorizer that is going to be used for the vectorization of text
vectorizer = TfidfVectorizer(ngram_range=(1, 3), min_df=2, max_df=0.9, stop_words='english', strip_accents='unicode', analyzer='word', max_features=40000)

#increase the size of the number of items that can be read from a csv file to the maximum
csv.field_size_limit(sys.maxsize)

#get all of the files in a directory to check whether a file is present in it
directory = '/home/vzeman/work/MachineLearning/websimilarity/cache/'
files = os.listdir(directory)

#if a cache for a website and its data isn't present in the chache folder create one and write all of the data into the file
if web_name in files:
    with open(directory + web_name) as csv_file:
        print("reading " + web_name)
        csv_reader = csv.reader(csv_file, delimiter=';')
        for row in csv_reader:
            if len(row[1]) > 0:
                urls.append(row[0])
                titles.append(row[1])
                texts.append(row[2])
                summarizations.append(row[3])
            if len(row[2]) < 10:
                print("wrong url: " + row[0] + "\n")

with open(directory + web_name, 'a', newline='') as file:
    writer = csv.writer(file, delimiter=';')
    for site in contentSites:
        tree = sitemap_tree_for_homepage(site) #the url of the homepage of the website wanted for a similarity search of its content
        for page in tree.all_pages():
            url = page.url.replace(mainUrl, '')
            if page.url.startswith("http") and url not in urls:
                try:
                    url = page.url.replace(mainUrl, '')
                    if is_banned_url(page.url):
                        print("Skip banned url: " + page.url)
                        continue
                    print("processing " + page.url)
                    fullHtml = urllib.request.urlopen(page.url).read()

                    #recommendations
                    image_alt_text_recommendation(fullHtml)

                    title = getHtmlTitle(fullHtml).replace(' | LiveAgent', '')
                    if len(title) < 3:
                        continue
                    html = getHtmlText(fullHtml)
                    urls.append(url)
                    titles.append(title)
                    texts.append(html)
                    if len(html)>100:
                        summary = summarizer(html, max_length=100, min_length=30, do_sample=False, truncation=True)
                        summary_text = summary[0]["summary_text"]
                    else:
                        summary_text = html
                    summarizations.append(summary_text)
                    writer.writerow([url, title, html, summary_text])
                except Exception as e:
                    print("failed to load " + page.url)


#getting rid of unnecessary and arbitrary data from the website such as the header and the footer for the nearest neighbor and the vectorization to come out better
print("processing clean text by diff ... wait")
for i in range(len(urls)):
    diff = diff_loop(i, 11)
    vectors.append(diff)



texts = []

#turn the processed and stripped webpages into vectors using the previous function (utilizing sklearn tf-idf vectorizer)
print("vectorizing clean text")
vectors = vectorize(vectors)
vectors = np.array(vectors, dtype=np.float32)

#The Faiss nearest neighbor search the number of nearest neighbors is num_of_sites*2 to account for banned ids
print("nearest neighbor search")
num_of_sites = 9
I = faiss_nn(vectors, num_of_sites*2)

vectors = []

#find the most frequesnt ids and get rid of them (some forums dominate the text) also company specific links which shouldn't be included
print("banning")
banned_ids = ban_ids(I, 0.025)

#write the relevant values into a csv file
with open('outputs.csv', 'w', newline='') as file:
    #the titles row for easy identification of the columns meaning
    print("writing")
    writer = csv.writer(file, delimiter=';')
    label = ["SOURCE"]
    for i in range(num_of_sites-1):
        label.append("URL_" + str(i+1))
        label.append("TITLE_" + str(i+1))
        label.append("ALT_" + str(i + 1))
    writer.writerow(label)

    #loops over all of the nearest neighbor values to be written out into the csv
    seen = []
    for nn_list in I:
        temp = []
        #this loop appends all the relevant information to the temporary array temp
        for idx in nn_list:
            if len(temp) <= 3*num_of_sites-3 and (idx not in banned_ids) and (urls[idx].replace("http://", "https://") not in temp):
                temp.append(urls[idx].replace("http://", "https://"))
                temp.append(titles[idx])
                if len(summarizations[idx])>0:
                    temp.append(summarizations[idx])
                else:
                    temp.append(titles[idx])
        # get rid of the title of the source page, it isn't necessary
        if len(temp) > 2:
            del temp[1]
            del temp[1]
        else:
            print("problem ?" + len(temp))
            continue

        #if the link with it's nearest neighbors is already in output or it is a support.liveagent link then it will not be written out into the output csv file
        if temp[0].startswith(contentSites[1]) or temp[0] in seen:
            continue
        else:
            seen.append(temp[0])
            writer.writerow(temp)

exit()

#--------------------------- Email results ----------------------------
import smtplib

# import the corresponding modules
from email import encoders
from email.mime.base import MIMEBase
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

port = 25
smtp_server = "localhost"
login = "" # paste your login generated by Mailtrap
password = "" # paste your password generated by Mailtrap

subject = "urls relation"
sender_email = "vzeman@qualityunit.com"
receiver_email = "mstepanek@qualityunit.com"

message = MIMEMultipart()
message["From"] = sender_email
message["To"] = receiver_email
message["Subject"] = subject

# Add body to email
body = "Update web with new relations"
message.attach(MIMEText(body, "plain"))

filename = "outputs.csv"
# Open PDF file in binary mode

# We assume that the file is in the directory where you run your Python script from
with open(filename, "rb") as attachment:
    # The content type "application/octet-stream" means that a MIME attachment is a binary file
    part = MIMEBase("application", "octet-stream")
    part.set_payload(attachment.read())

# Encode to base64
encoders.encode_base64(part)

# Add header
part.add_header(
    "Content-Disposition",
    f"attachment; filename= {filename}",
)

# Add attachment to your message and convert it to string
message.attach(part)
text = message.as_string()

# send your email
with smtplib.SMTP(smtp_server, port) as server:
    #server.login(login, password)
    server.sendmail(
        sender_email, receiver_email, text
    )
print('Sent')
