const ProsCons = ( { pros, cons, editor_avg } ) => {
	if ( pros.length ) {
		pros = pros.split( '\r\n' );
	}
	if ( cons.length ) {
		cons = cons.split( '\r\n' );
	}

	return (
		<>
			<div className="Reviews__rating editor">
				<div className="Reviews__rating--count mb-s">Editor`s Rating</div>
				<div className="flex flex-align-center">
					<span className="Reviews__rating--rating mr-s-tablet-landscape">{ editor_avg }</span>
					<div className="Reviews__rating--stars">
						<div className="Reviews__rating--stars__fill"
							style={ { width: `${ editor_avg / 5 * 103 }%` } }></div>
					</div>
				</div>
			</div>
			<div className="wp-block-columns">
				{ pros.length
					? <div className="wp-block-column checklist checklist--pros">
						<h4>Pros</h4>
						<ul>
							{ pros.map( ( pro ) => {
								return (
									<li key={ pro }>{ pro }</li>
								);
							} ) }
						</ul>
					</div>
					: null }

				{ cons.length
					? <div className="wp-block-column checklist checklist--cons">
						<h4>Cons</h4>
						<ul>
							{ cons.map( ( con ) => {
								return (
									<li key={ con }>{ con }</li>
								);
							} ) }
						</ul>
					</div>
					: null
				}
			</div>
		</>
	);
};
export default ProsCons;
