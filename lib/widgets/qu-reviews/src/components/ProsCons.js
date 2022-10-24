const ProsCons = ( { pros, cons } ) => {
	if ( pros.length ) {
		pros = pros.split( '\r\n' );
	}
	if ( cons.length ) {
		cons = cons.split( '\r\n' );
	}

	return (
		<>
			{ pros.length
				? <ul className="checklist checklist--pros">
					{ pros.map( ( pro ) => {
						return (
							<li key={ pro }>{ pro }</li>
						);
					} ) }
				</ul>
				: null }

			{ cons.length
				? <ul className="checklist checklist--cons">
					{ cons.map( ( con ) => {
						return (
							<li key={ con }>{ con }</li>
						);
					} ) }
				</ul>
				: null
			}
		</>
	);
};
export default ProsCons;
