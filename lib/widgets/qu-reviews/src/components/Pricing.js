const Pricing = ( meta ) => {
	const { currency, equal_la_plan, free_trial, free_version, note, period, price } = meta;

	return (
		<>
			<h3>Pricing</h3>
			<div className="Reviews__info">
				<dl className="Reviews__info--details first mt-xs">
					<dt>Starting from:</dt>
					<dd>
						<div className="Reviews__info--pricing">
							<strong className="currency">{ meta.currency }</strong>
							<strong className="price">{ meta.price }</strong>
							<span className="text-light">{ meta.period }</span>
						</div>
					</dd>
					<dt className="note invisible">Note</dt>
					<dd className="note text-light">{ meta.note }</dd>
				</dl>
				<dl className="Reviews__info--details second">
					<dt>Free trial:</dt>
					<dd>{ meta.free_trial ? meta.free_trial : 'No' }</dd>
					<dt>Free version:</dt>
					<dd>{ meta.free_version ? meta.free_version : 'No' }</dd>
				</dl>
			</div>
		</>
	);
};
export default Pricing;
