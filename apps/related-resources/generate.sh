#!/bin/bash

echo "Deleting files..."
rm -r cache/liveagent.csv
rm -r outputs.csv
echo "Done! \n"

echo "Generating..."
python3 WebsiteUrlSimilarity.py
echo "Done! \n"