import React from 'react';

class Form extends React.Component {
	constructor(props) {
		super(props);
		this.state = {
			name: '',
			email: '',
			question: '',
			submitted: false,
			sendTo: this.props.sendTo,
		};

		this.updateField = this.updateField.bind(this);
		this.submit = this.submit.bind(this);
	}

	componentWillMount() {
	}

	submit() {
		this.setState({ submitted: true });

		/**
		 * Here we would take the form info and email it to this.state.sendTo
		 */
	}

	updateField(event) {
		const newState = {};

		newState[event.target.getAttribute('name')] = event.target.value;

		this.setState(newState);
	}

	render() {
		return (
			<>
				{!this.state.submitted ? (
					<>
						<div>
							<input
								name="name"
								onChange={this.updateField}
								type="text"
								value={this.state.name}
								placeholder="Name"
							/>
						</div>
						<div>
							<input
								name="email"
								onChange={this.updateField}
								type="text"
								value={this.state.email}
								placeholder="Email"
							/>
						</div>
						<div>
							<textarea
								value={this.state.question}
								onChange={this.updateField}
								name="question"
								placeholder="Question?"
							/>
						</div>
						<div>
							<a className="button-primary" onClick={this.submit}>
								Vivamus tristique
							</a>
						</div>
					</>
				) : (
					<div>We received your message!</div>
				)}
			</>
		);
	}
}

export default Form;
