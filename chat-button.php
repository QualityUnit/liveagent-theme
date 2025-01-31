<script type="text/javascript">
function createButton() {
	function getParameterByName( name ) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");

		const regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
		const results = regex.exec(location.search);

		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}

	const source = getParameterByName('utm_source');
	const brandingLinks = ['branding', 'chat', 'contactform', 'knowledge_base', 'textlink'];
	let timeout = 250;

	if ( brandingLinks.includes( source ) ) {
		timeout = 30000;
	}

	if ( window.innerWidth < 768 ) {
		timeout = 5000;
	}

	<?php if ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE === 'sv' ) { ?>
		setTimeout( function() {
			(function(d, src, c) { s=d.createElement('script');s.id='la_x2s6df8d';s.async=true;s.src=src;s.onload=s.onreadystatechange=function(){var rs=this.readyState;if(rs&&(rs!='complete')&&(rs!='loaded')){return;}c(this);};document.querySelector('#chatBtn').appendChild(s);})(document,
				'https://support.liveagent.se/scripts/track.js',
				function(e){
					LiveAgent.createButton('67a82a6b', e);
				});
		}, timeout );
	<?php } elseif ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE === 'ja' ) { ?>
		setTimeout( function() {
			(function(d, src, c) { s=d.createElement('script');s.id='la_x2s6df8d';s.async=true;s.src=src;s.onload=s.onreadystatechange=function(){var rs=this.readyState;if(rs&&(rs!='complete')&&(rs!='loaded')){return;}c(this);};document.querySelector('#chatBtn').appendChild(s);})(document,
				'//support.intwk.co.jp/liveagent/scripts/track.js',
				function(e){
					LiveAgent.createButton('fadd3dc5', e);
				});
		}, timeout );
	<?php } else { ?>
		setTimeout( function() {
			(function(d, src, c) { s=d.createElement('script');s.id='la_x2s6df8d';s.async=true;s.src=src;s.onload=s.onreadystatechange=function(){var rs=this.readyState;if(rs&&(rs!='complete')&&(rs!='loaded')){return;}c(this);};document.querySelector('#chatBtn').appendChild(s);})(document,
			'//support.qualityunit.com/scripts/track.js',
			function(e){
				<?php if ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE === 'de' ) { ?>
					LiveAgent.createButton('a8xw4r0d', e);
				<?php } elseif ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE === 'fr' ) { ?>
					LiveAgent.createButton('ojy731wl', e);
				<?php } elseif ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE === 'es' ) { ?>
					LiveAgent.createButton('ryv7oyvn', e);
				<?php } elseif ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE === 'pt-br' ) { ?>
					LiveAgent.createButton('y7aecte9', e);
				<?php } elseif ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE === 'hu' ) { ?>
					LiveAgent.createButton('9hrzq40p', e);
				<?php } elseif ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE === 'nl' ) { ?>
					LiveAgent.createButton('o1zypcx0', e);
				<?php } elseif ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE === 'pl' ) { ?>
					LiveAgent.createButton('keus4mm5', e);
				<?php } elseif ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE === 'it' ) { ?>
					LiveAgent.createButton('28bwor7y', e);
				<?php } elseif ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE === 'ru' ) { ?>
					LiveAgent.createButton('k88ai80o', e);
				<?php } elseif ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE === 'zh-hans' ) { ?>
					LiveAgent.createButton('49v7ehwf', e);
				<?php } else { ?>
					LiveAgent.createButton('443a9d07', e);
				<?php } ?>
			});
		}, timeout );
	<?php } ?>
}
		createButton()

</script>
