import texts_cn from '../../data/i18n/cn';
import texts_ae from '../../data/i18n/ae';
import texts_bg from '../../data/i18n/bg';
import texts_cz from '../../data/i18n/cz';
import texts_de from '../../data/i18n/de';
import texts_dk from '../../data/i18n/dk';
import texts_ee from '../../data/i18n/ee';
import texts_en from '../../data/i18n/en';
import texts_es from '../../data/i18n/es';
import texts_fi from '../../data/i18n/fi';
import texts_fr from '../../data/i18n/fr';
import texts_gr from '../../data/i18n/gr';
import texts_hr from '../../data/i18n/hr';
import texts_hu from '../../data/i18n/hu';
import texts_it from '../../data/i18n/it';
import texts_jp from '../../data/i18n/jp';
import texts_lt from '../../data/i18n/lt';
import texts_lv from '../../data/i18n/lv';
import texts_nl from '../../data/i18n/nl';
import texts_no from '../../data/i18n/no';
import texts_pl from '../../data/i18n/pl';
import texts_pt from '../../data/i18n/pt';
import texts_ro from '../../data/i18n/ro';
import texts_ru from '../../data/i18n/ru';
import texts_se from '../../data/i18n/se';
import texts_si from '../../data/i18n/si';
import texts_sk from '../../data/i18n/sk';
import texts_tg from '../../data/i18n/tg';
import texts_vn from '../../data/i18n/vn';

export const getLang = () => {
	const { lang } = document.documentElement;
	const langFixed = lang.replace(/-.+/i,'');
	switch ( langFixed ) {
		case 'zh':
			return texts_cn;
		case 'ar':
			return texts_ae;
		case 'bg':
			return texts_bg;
		case 'cz':
			return texts_cz;
		case 'de':
			return texts_de;
		case 'da':
			return texts_dk;
		case 'et':
			return texts_ee;
		case 'en':
			return texts_en;
		case 'es':
			return texts_es;
		case 'fi':
			return texts_fi;
		case 'fr':
			return texts_fr;
		case 'el':
			return texts_gr;
		case 'gr':
			return texts_gr;
		case 'hr':
			return texts_hr;
		case 'hu':
			return texts_hu;
		case 'it':
			return texts_it;
		case 'ja':
			return texts_jp;
		case 'lt':
			return texts_lt;
		case 'lv':
			return texts_lv;
		case 'nl':
			return texts_nl;
		case 'no':
			return texts_no;
		case 'pl':
			return texts_pl;
		case 'pt':
			return texts_pt;
		case 'ro':
			return texts_ro;
		case 'ru':
			return texts_ru;
		case 'se':
			return texts_se;
		case 'sl':
			return texts_si;
		case 'sk':
			return texts_sk;
		case 'ph':
			return texts_tg;
		case 'fil':
			return texts_tg;
		case 'tl':
			return texts_tg;
		case 'vi':
			return texts_vn;

		default:
			return texts_en;
	}
};

export const i18n = getLang();
