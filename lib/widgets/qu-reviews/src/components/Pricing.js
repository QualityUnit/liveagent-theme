const Pricing = ( meta ) => {
	const { currency, equal_la_plan, free_trial, free_version, note, period, price } = meta;

	return (
		<>
			<h3>Pricing</h3>
			<strong>Starting from:</strong>
			{ currency }
			<p>{ price }</p>
			<p>{ period }</p>
		</>
	);
};
export default Pricing;
