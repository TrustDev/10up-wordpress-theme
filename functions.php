<?php
/**
 * WP Theme constants and setup functions
 *
 * @package ExerciseTheme
 */

// Useful global constants.
define( 'ET_VERSION', '0.1.3' );
define( 'ET_TEMPLATE_URL', get_template_directory_uri() );
define( 'ET_PATH', get_template_directory() . '/' );
define( 'ET_INC', ET_PATH . 'includes/' );

require_once ET_INC . 'core.php';
require_once ET_INC . 'template-tags.php';
require_once ET_INC . 'helpers.php';

// Run the setup functions.
ExerciseTheme\Core\setup();

// Require Composer autoloader if it exists.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once 'vendor/autoload.php';
}
