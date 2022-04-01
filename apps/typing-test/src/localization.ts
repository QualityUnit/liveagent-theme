import texts_zh from './data/chinese_texts.json';
import texts_nl from './data/dutch_texts.json';
import texts_fr from './data/french_texts.json';
import texts_de from './data/german_texts.json';
import texts_hu from './data/hungarian_texts.json';
import texts_it from './data/italian_texts.json';
import texts_pl from './data/polish_texts.json';
import texts_pt from './data/portuguese_texts.json';
import texts_ru from './data/russian_texts.json';
import texts_sk from './data/slovak_texts.json';
import texts_es from './data/spanish_texts.json';
import texts_en from './data/texts.json';

import country_code_map from './data/country_code_map.json'

import localization from './data/localization.json'

export type Localization = {
    choose_test_diff: string,
    choose_test_dur: string,
    timer_unit: string,
    i_dont_want_this_text: string,
    lets_try_one_more_test: string,
    wpm: string,
    cpm: string,
    mpm: string,
    average_cpm: string,
    average_mpm: string
};

export interface Text {
    id: number,
    name: string,
    text: string
}

interface Difficulty {
    display_name: string
}

interface Timeout {
    display_name: string
}

export interface Texts {
    difficulties: Map<string, Difficulty>,
    timeouts: Map<string, Timeout>,
    texts: Map<string, Text[]>
}

function texts_from_json(json: any): Texts {
    var texts: Texts = {
	difficulties: new Map(),
	timeouts: new Map(),
	texts: new Map()
    }

    for (let difficulty in json["difficulties"]) {
	let texts_from_json = (json["texts"] as any)[difficulty];
	if (texts_from_json) { texts.texts.set(difficulty, texts_from_json) };

	let diff_from_json = (json["difficulties"] as any)[difficulty];
	if (diff_from_json) { texts.difficulties.set(difficulty, diff_from_json) }
    }

    for (let timeout in json["timeouts"]) {
	let timeout_from_json = (json["timeouts"] as any)[timeout];
	if (timeout_from_json) { texts.timeouts.set(timeout, timeout_from_json) };
    }

    return texts
}

function localization_from_json(country_code: string): Localization {
    var local;
    switch (country_code) {
	case "cn":
	    local = localization.cn
	    break;
	case "nl":
	    local = localization.nl
	    break;
	case "fr":
	    local = localization.fr
	    break;
	case "de":
	    local = localization.de
	    break;
	case "hu":
	    local = localization.hu
	    break;
	case "it":
	    local = localization.it
	    break;
	case "pl":
	    local = localization.pl
	    break;
	case "br":
	    local = localization.br
	    break;
	case "ru":
	    local = localization.ru
	    break;
	case "sk":
	    local = localization.sk
	    break;
	case "es":
	    local = localization.es
	    break;
	case "en":
	    local = localization.en
	    break;
	default:
	    local = localization.en
	    console.error("Invalid CC: " + country_code);
	    break;
    }

    return {
	choose_test_diff: local.choose_test_diff,
	choose_test_dur: local.choose_test_dur,
	timer_unit: local.timer_unit,
	i_dont_want_this_text: local.i_dont_want_this_text,
	lets_try_one_more_test: local.lets_try_one_more_test,
	wpm: local.wpm,
	cpm: local.cpm,
	mpm: local.mpm,
	average_cpm: local.average_cpm,
	average_mpm: local.average_mpm
    }
}

function parse_country_code_map(json: any): Map<string, string> {
    var map = new Map();
    for (let tld in json) {
	map.set(tld, json[tld]);
    }
    return map
}

export function texts_by_country_code(country_code: string): Texts {
    switch (country_code) {
	case "cn":
	    return texts_from_json(texts_zh)
	case "nl":
	    return texts_from_json(texts_nl)
	case "fr":
	    return texts_from_json(texts_fr)
	case "de":
	    return texts_from_json(texts_de)
	case "hu":
	    return texts_from_json(texts_hu)
	case "it":
	    return texts_from_json(texts_it)
	case "pl":
	    return texts_from_json(texts_pl)
	case "br":
	    return texts_from_json(texts_pt)
	case "ru":
	    return texts_from_json(texts_ru)
	case "sk":
	    return texts_from_json(texts_sk)
	case "es":
	    return texts_from_json(texts_es)
	case "en":
	    return texts_from_json(texts_en)
    }
    console.error("Invalid CC: " + country_code);
    return texts_from_json(texts_en)
}

export function get_locale(): [Texts, Localization] {
    let url = window.location.href;
    let regex = RegExp('^(?:https?:\\/\\/)?(?:[^@\\/\\n]+@)?(?:www\\.)?([^:\\/\\n]+)\\.([^:\\/\\n]+)(?:\\/*[^:\\/\\n]*)*');

    let tld = url.replace(regex, "$2");

    let cc = parse_country_code_map(country_code_map).get(tld);
    if (typeof cc === "string") {
	return [texts_by_country_code(cc), localization_from_json(cc)]
    } else {
	console.error("Unknown TLD: " + tld);
	return [texts_by_country_code("en"), localization_from_json("en")]
    }
}
