<?php
/**
 * Plugin Name: Call to Action Box Animate for Elementor
 * Description: A Simple and Interactive Call-to-Action (CTA) Elementor Widget which has content hover animations, background hover transition, 2 buttons with separator text in-between, subtitle with option to choose before or after the title, overlay text and overlay animation and more.
 * Plugin URI:  https://internetcss.com/
 * Version:     1.0.3
 * Author:      InternetCSS
 * Author URI:  https://internetcss.com/about-us/
 * Text Domain: eb-cta-box-animate
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'EB_CTA_BOX_ANIMATE__FILE__', __FILE__ );
define( 'eb_cta_box_animate_version', '1.0.3' );

require_once __DIR__ . '/elementor-helper.php';


/**
 * Load CTA Box Animate
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 * @since 1.0.0
 */
function eb_cta_box_animate_load() {
	// Load localization file
	load_plugin_textdomain( 'eb-cta-box-animate' );

	// Notice if the Elementor is not active
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'eb_elementor_cta_box_animate_fail_load' );
		return;
	}

	// Check required version
	$elementor_version_required = '1.8.0';
	if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
		add_action( 'admin_notices', 'eb_check_cta_box_animate_elementor_load_out_of_date' );
		return;
	}

	// Require the main plugin file
	function add_eb_cta_box_animate_element(){
		require_once __DIR__ . '/widgets/eb-cta-box-animate-widget.php';
	}
	add_action('elementor/widgets/widgets_registered','add_eb_cta_box_animate_element');
}

add_action( 'plugins_loaded', 'eb_cta_box_animate_load' );

function eb_elementor_cta_box_animate_fail_load() {

	$message = '<p>' . __( 'You do not have Elementor Page Builder on your WordPress. Elementor Call-to-Action Box Animate require Elementor in order to work.', 'eb-cta-box-animate' ) . '</p>';

	echo '<div class="error">' . $message . '</div>';
}

function eb_check_cta_box_animate_elementor_load_out_of_date() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}

	$file_path = 'elementor/elementor.php';

	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message = '<p>' . __( 'Elementor Call-to-Action Box Animate Widget may not work or is not compatible because you are using an old version of Elementor.', 'eb-cta-box-animate' ) . '</p>';
	$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Elementor Now', 'eb-cta-box-animate' ) ) . '</p>';

	echo '<div class="error">' . $message . '</div>';
}

/**
 * Register and enqueue a custom stylesheet in the Elementor.
 */
add_action('elementor/editor/before_enqueue_scripts', function(){
	wp_enqueue_style( 'eb-cta-box-animate-admin', plugins_url( '/assets/css/eb-cta-box-animate-admin.css', EB_CTA_BOX_ANIMATE__FILE__ ) );
});

add_action('elementor/frontend/after_enqueue_styles', function(){
	wp_enqueue_style( 'eb-cta-box-animate', plugins_url( '/assets/css/eb-cta-box-animate.css', EB_CTA_BOX_ANIMATE__FILE__ ) );
});

add_action('elementor/frontend/after_register_scripts', function(){
	wp_register_script( 'eb-cta-box-animate', plugins_url( '/assets/js/eb-cta-box-animate.js', EB_CTA_BOX_ANIMATE__FILE__ ), [ 'jquery' ], eb_cta_box_animate_version, true );
});