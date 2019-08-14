<?php
/**
 * This controls the plugin
 * @package  JA
 */

if ( !class_exists( 'WooCommerce' ) ) {
	return;
}

class Ja_Woo_Filter {

	public function __construct() {

		$this->load_includes();
		$this->load_assets();

	}

	//Include admin and Public files
	public function load_includes() {
		include_once( plugin_dir_path( __FILE__ ) . 'public/form-ajax.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'public/custom-shortcode.php' );

	}

	//Load Assets
	public function load_assets() {

		add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ) );

	}

	public function register_assets() {
		//css
		wp_enqueue_style( 'checkradio-css', plugin_dir_url( __FILE__ ) . 'css/jquery.checkradios.min.css', array(), '1.0' );
		wp_enqueue_style( 'ja-woo-filter-css', plugin_dir_url( __FILE__ ) . 'css/main.css', array(), '1.0' );
		

		//js
		wp_enqueue_script( 'checkradio-js', plugin_dir_url( __FILE__ ) . 'js/jquery.checkradios.min.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'ja-woo-filter-js', plugin_dir_url( __FILE__ ) . 'js/main.js', array('jquery'), '1.0', true );

	}

}