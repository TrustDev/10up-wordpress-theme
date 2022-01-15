const getInTouch = () => {
	const button = document.querySelector('.c-get-in-touch a');
	const contactPanel = document.querySelector('.contact-panel');

	function handleClick(e) {
		e.preventDefault();
		console.log(e);
		contactPanel.classList.add('-open');
	}

	button.addEventListener('click', handleClick);
};

getInTouch();
