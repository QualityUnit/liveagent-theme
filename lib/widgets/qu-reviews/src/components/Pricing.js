const Pricing = ( meta ) => {
	const { currency, free_trial, free_version, note, period, price } = meta;

	return (
		<>
			<h3>Pricing</h3>
			<div className="Reviews__info">
				<dl className="Reviews__info--details first mt-xs">
					<dt>Starting from:</dt>
					<dd>
						<div className="Reviews__info--pricing">
							<strong className="currency">{ currency }</strong>
							<strong className="price">{ price }</strong>
							<span className="text-light">{ period }</span>
						</div>
					</dd>
					<dt className="note invisible">Note</dt>
					<dd className="note text-light">{ note }</dd>
				</dl>
				<dl className="Reviews__info--details second">
					<dt>Free trial:</dt>
					<dd>{ free_trial ? free_trial : 'No' }</dd>
					<dt>Free version:</dt>
					<dd>{ free_version ? free_version : 'No' }</dd>
				</dl>
			</div>
		</>
	);
};
export default Pricing;
