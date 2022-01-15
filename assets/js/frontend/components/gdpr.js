const { jQuery } = window;

/**
 * Init function for the GDPR Banner
 */
const init = () => {
	const dismissButton = jQuery('#js-dismiss-gdpr');
	const banner = jQuery('.js-gdpr-banner');
	const bannerStatus = getBannerStatus();

	dismissButton.on('click', handleDismissClick.bind(this, banner));

	if (bannerStatus !== 'hidden') {
		showBanner(banner);
	}
};

/**
 * @param banner
 */
const handleDismissClick = (banner) => {
	hideBanner(banner);
};

/**
 * Retrieve session storage
 */
const getBannerStatus = () => sessionStorage.getItem('gdpr_banner');

/**
 * Hide the banner
 *
 * @param banner
 */
const hideBanner = (banner) => {
	banner.addClass('js-is-hidden');
};

/**
 * Show the banner, clear the session storage valie
 *
 * @param banner
 */
const showBanner = (banner) => {
	banner.removeClass('js-is-hidden');
	sessionStorage.removeItem('gdpr_banner');
};

export default init;
