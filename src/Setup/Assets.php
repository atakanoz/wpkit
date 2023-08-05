<?php

namespace Theme\Setup;

use Theme\Core\Bootstrap;
use Theme\Core\Config;
use Theme\Core\Registrable;

class Assets implements Registrable {

	public function register() {
		\add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );
		\add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
	}

	/**
	 * Theme Styles.
	 *
	 * @since 1.0.0
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	 */
	public function styles() {

		if ( is_array( Bootstrap::$styles ) ) {
			foreach ( Bootstrap::$styles as $style => $path ) {
				wp_enqueue_style( $style, get_stylesheet_directory_uri() . $path, array(), Bootstrap::$version );
			}
		}
	}

	/**
	 * Theme Scripts.
	 *
	 * @since 1.0.0
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
	 */
	public function scripts() {


		if ( is_array( Bootstrap::$scripts ) ) {
			foreach ( Bootstrap::$scripts as $script => $path ) {
				wp_enqueue_script( $script, get_stylesheet_directory_uri() . $path, Bootstrap::$jquery, Bootstrap::$version, true );
			}
		}
	}
}
