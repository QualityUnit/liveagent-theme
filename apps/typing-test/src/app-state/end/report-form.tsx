import React from 'react';

type Props = {
    
}

type State = {
    email: string,
    name: string,
}

class ReportForm extends React.Component<Props, State> {
    constructor(props: Props) {
	super(props);

	this.state = {
	    email: '',
	    name: '',
	}
    }

    onChange = (event: React.ChangeEvent<HTMLInputElement>) => {
	switch (event.target.name) {
	    case "name":
		this.setState({
		    name: event.target.value
		});
		break;
	    case "email":
		this.setState({
		    email: event.target.value
		})
		break;
	    default:
		break;
	}
    }

    onSubmit = () => {
	
    }
    
    render() {
	return (
	    <form onSubmit={this.onSubmit}>
		<label>
		    Name:
		    <input type="text" name="name" value={this.state.name} onChange={this.onChange}/>
		</label>
		<label>
		    Email:
		    <input type="text" name="email" value={this.state.email} onChange={this.onChange} />
		</label>
	    </form>
	)
    }
}

export default ReportForm;
