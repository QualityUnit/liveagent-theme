const iconTabs = document.querySelectorAll( '.IconTabs' );

if ( iconTabs.length > 0 ) {
	iconTabs.forEach( ( element ) => {
		const thisSection = element;
		const thisContent = thisSection.querySelector( '.IconTabs__content > .elementor-widget-wrap' );
		const tabs = thisSection.querySelectorAll( '.IconTabs__tabs li' );
		const blocks = thisSection.querySelectorAll( '.IconTabs__block' );

		// Set 'active' class for the first tab and block
		tabs[ 0 ].classList.add( 'active' );
		blocks[ 0 ].classList.add( 'active' );

		// Initialize progress bar for the first block
		recalculateProgress( blocks[ 0 ] );

		// Assign data-item ID for each tab and block
		tabs.forEach( ( tab, index ) => {
			tab.dataset.item = index;
		} );

		blocks.forEach( ( block, index ) => {
			block.dataset.item = index;
		} );

		// Add click event listener to each tab
		tabs.forEach( ( tab ) => {
			tab.addEventListener( 'click', ( event ) => {
				event.preventDefault();
				const prevActiveTab = thisSection.querySelector( '.IconTabs__tabs li.active' );
				const prevActiveBlock = thisSection.querySelector( '.IconTabs__block.active' );
				const thisId = tab.dataset.item;
				const thisBlock = thisSection.querySelector( `.IconTabs__block[data-item="${ thisId }"]` );

				// Remove 'active' class from previous tab and block
				prevActiveTab.classList.remove( 'active' );
				prevActiveBlock.classList.remove( 'active' );

				// Add 'active' class to the clicked tab and corresponding block
				tab.classList.add( 'active' );
				thisContent.style.transform = `translateX(-${ thisId * 100 }%)`;
				thisBlock.classList.add( 'active' );

				// Recalculate and animate progress bar for the new active block
				recalculateProgress( thisBlock );
			} );
		} );
	} );
}

// Function to update and animate the progress bar
function recalculateProgress( block ) {
	const pElement = block.querySelector( '.IconTabs__chartText p' );
	if ( pElement ) {
		const percentTextValue = pElement.textContent.replace( '%', '' );
		const numberValue = parseFloat( percentTextValue );

		const path = block.querySelector( '#foregroundPath' );
		const circle = block.querySelector( '#progressCircle' );

		if ( ! path || ! circle ) {
			return;
		}

		const totalLength = path.getTotalLength();

		const updateProgressBar = ( percentage ) => {
			const progressLength = totalLength * ( percentage / 100 );
			path.style.strokeDasharray = `${ progressLength } ${ totalLength }`;
			const pointAtLength = path.getPointAtLength( progressLength );
			circle.setAttribute( 'cx', pointAtLength.x );
			circle.setAttribute( 'cy', pointAtLength.y );
		};

		const animateProgressBar = ( targetPercentage, duration ) => {
			let start = null;
			const startPercentage = 0;

			const step = ( timestamp ) => {
				if ( ! start ) {
					start = timestamp;
				}
				const progress = timestamp - start;
				// eslint-disable-next-line no-mixed-operators
				const percentage = Math.min( startPercentage + ( progress / duration ) * targetPercentage, targetPercentage );
				updateProgressBar( percentage );
				pElement.textContent = `${ Math.round( percentage ) }%`; // Update the percentage text
				if ( percentage < targetPercentage ) {
					requestAnimationFrame( step );
				}
			};

			requestAnimationFrame( step );
		};

		// Animate the progress bar to the calculated percentage
		animateProgressBar( numberValue, 1500 );
	}
}

// Initialize progress bar for the initially active block when DOM is fully loaded
document.addEventListener( 'DOMContentLoaded', () => {
	const initialBlock = document.querySelector( '.IconTabs__block.active' );
	if ( initialBlock ) {
		recalculateProgress( initialBlock );
	}
} );
