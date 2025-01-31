<script type="text/javascript">
	function createAiButton() {
		function getParameterByName(name) {
			name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
			const regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
			const results = regex.exec(location.search);
			return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
		}

		const source = getParameterByName('utm_source');
		const brandingLinks = ['branding', 'chat', 'contactform', 'knowledge_base', 'textlink'];
		let timeout = 250;

		if (brandingLinks.includes(source)) {
			timeout = 30000;
		}

		if (window.innerWidth < 768) {
			timeout = 5000;
		}

		setTimeout(function() {
			(function(d, src, c) {
				var s = d.createElement('script');
				s.id = 'la_x2s6df8d';
				s.async = true;
				s.src = src;
				s.onload = s.onreadystatechange = function() {
					var rs = this.readyState;
					if (rs && rs !== 'complete' && rs !== 'loaded') { return; }
					c(this);
				};

				document.querySelector('#chatBot').appendChild(s);
			})(document,
				'https://support.ladesk.com/scripts/track.js',
				function(e) {
					LiveAgent.createButton('lc71ooi3', e);
				});
		}, timeout);
	}

		createAiButton();
</script>
