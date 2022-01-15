import ReactDom from 'react-dom';
import gdpr from './components/gdpr';
import Form from './components/form';
import './components/get-in-touch';

const { jQuery } = window;

/**
 * TODO: Remove just a debug script
 */
const secondaryButton = document.querySelector('.button-secondary');
secondaryButton.addEventListener('click', (e) => {
	e.preventDefault();
	alert('TODO: Remove just a debug script');
});

jQuery(document).ready(() => {
	gdpr();

	const formContainer = jQuery('.c-form-block .form-container');

	ReactDom.render(<Form sendTo="admin@website.com" />, formContainer[0]);
});

var $ = jQuery;

$(window).bind('load', function () {
	$(document).on('click', '#js-nav-primary__toggle', function () {
		console.log('click');
		$('html').toggleClass('topmenu_mobile__active');
	});

	$(window).scroll(windowScroll);

	windowScroll();
});

function topmenu() {
	const windowHeight = $(window).height();
	const scrollTop = $(window).scrollTop();

	if (scrollTop < windowHeight - 70) {
		$('html').addClass('topmenu_active');
	} else {
		$('html').removeClass('topmenu_active');
	}
}

// when window resizing
function windowScroll() {
	topmenu();
}
function setupGTM() {
	
}
setupGTM();
