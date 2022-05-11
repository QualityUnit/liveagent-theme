const iconTabs = document.querySelectorAll( '.IconTabs' );

if ( iconTabs.length > 0 ) {
	iconTabs.forEach( ( element ) => {
		const thisSection = element;
		const thisContent = thisSection.querySelector(
			'.IconTabs__content > .elementor-column-wrap > .elementor-widget-wrap'
		);
		const tabs = thisSection.querySelectorAll( '.IconTabs__tabs li' );
		const blocks = thisSection.querySelectorAll( '.IconTabs__block' );
		const svgAnims = thisSection.querySelectorAll( '.IconTabs__block img[data-lasrc*=".svg"]' );
		svgAnims.forEach( ( animation, index ) => {
			animation.dataset.lasrc = animation.dataset.lasrc + '-' + index;
		} );

		const percentCounter = ( thisBlock ) => {
			if ( ! thisBlock.classList.contains( 'counted' ) ) {
				const chartPercentage = thisBlock.querySelector(
					'.IconTabs__chartText p'
				);

				if ( chartPercentage ) {
					const chartPercentageText = chartPercentage.innerText.split(
						/–|-/
					);

					const number1 = parseInt( chartPercentageText[ 0 ], 10 );
					let number2 = null;

					if ( ! chartPercentageText[ 1 ] ) {
						const secs = 2500 / number1;
						let count = 0;
						const counter = setInterval( () => {
							count += 1;
							chartPercentage.innerHTML = `${ count }%`;
							if ( count === number1 ) {
								clearInterval( counter );
							}
						}, secs );
					}
					if ( chartPercentageText[ 1 ] ) {
						number2 = parseInt( chartPercentageText[ 1 ], 10 );
						const secs1 = 2500 / number1;
						const secs2 = 2500 / number2;
						const mainCounter = [ 0, 0 ];
						let count1 = 0;
						let count2 = 0;
						const counter1 = setInterval( () => {
							count1 += 1;
							mainCounter[ 0 ] = count1;
							if ( count1 === number1 ) {
								clearInterval( counter1 );
							}
						}, secs1 );
						const counter2 = setInterval( () => {
							count2 += 1;
							mainCounter[ 1 ] = count2;
							chartPercentage.innerHTML = `${ mainCounter[ 0 ] }–${ mainCounter[ 1 ] }%`;
							if ( count2 === number2 ) {
								clearInterval( counter2 );
							}
						}, secs2 );
					}
				}

				thisBlock.classList.add( 'counted' );
			}
		};

		// Sets class active for first tab and first block
		tabs.item( 0 ).classList.add( 'active' );
		blocks.item( 0 ).classList.add( 'active' );

		percentCounter( blocks.item( 0 ) );

		// Assigns data-item ID number for each item to pair it without entering ID attribute
		tabs.forEach( ( tab, index ) => {
			const tabItem = tab;
			tabItem.dataset.item = index;
		} );

		blocks.forEach( ( block, index ) => {
			const item = block;
			item.dataset.item = index;
		} );

		tabs.forEach( ( tab ) => {
			tab.addEventListener( 'click', ( event ) => {
				event.preventDefault();
				event.stopPropagation();
				const prevActiveTab = thisSection.querySelector(
					'.IconTabs__tabs li.active'
				);
				const prevActiveBlock = thisSection.querySelector(
					'.IconTabs__block.active'
				);
				const thisId = tab.dataset.item;
				const thisBlock = thisSection.querySelector(
					`.IconTabs__block[data-item="${ thisId }"]`
				);
				const thisBlockItemCount = thisBlock.dataset.item;

				prevActiveTab.classList.remove( 'active' );
				prevActiveBlock.classList.remove( 'active' );

				tab.classList.add( 'active' );
				thisContent.style.transform = `translateX(-${
					thisBlockItemCount * 100
				}%)`;
				percentCounter( thisBlock );
				thisBlock.classList.add( 'active' );
			} );
		} );
	} );
}
