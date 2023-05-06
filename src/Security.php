<?php

namespace Theme;

class Security extends Kit {
	public function __construct() {

	}

	/**
	 * Hide WordPress Version
	 *
	 * @since 1.0.0
	 * @return void
	 * -----------------------------------------------------------------------------
	 * -----------------------------------------------------------------------------
	 */
	public function hide_wp_version() {
		\remove_action( 'wp_head', __return_empty_string() );
		\add_filter( 'the_generator', __return_empty_string() );
	}

	/**
	 * Remove Pingback
	 *
	 * @param  mixed $headers
	 * @return void
	 * -----------------------------------------------------------------------------
	 * -----------------------------------------------------------------------------
	 */
	public function remove_pingback() {

		\add_filter(
			'wp_headers',
			function() {
				unset( $headers['X-Pingback'], $headers['x-pingback'] );
				return $headers;
			}
		);

		\add_filter( 'pings_open', '__return_false', 9999 );
	}

	/**
	 * Disable XMLRPC
	 *
	 * @since 1.0.0
	 * @return void
	 * -----------------------------------------------------------------------------
	 * -----------------------------------------------------------------------------
	 */
	public function disable_xml_rpc() {
		\add_filter( 'xmlrpc_enabled', '__return_false' );
	}

	/**
	 * Intercept XMLRPC
	 *
	 * @since 1.0.0
	 * @return void
	 * -----------------------------------------------------------------------------
	 * -----------------------------------------------------------------------------
	 */
	public function intercept_xml_rpc() {
		add_action(
			'init',
			function() {
				if ( ! isset( $_SERVER['SCRIPT_FILENAME'] ) ) {
					return;
				}

				if ( 'xmlrpc.php' !== basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
					return;
				}

				$header = 'HTTP/1.1 403 Forbidden';
				header( $header );
				echo $header;
				die();
			}
		)
	}

	/**
	 * Disable Rest API Links
	 *
	 * @since 1.0.0
	 * -----------------------------------------------------------------------------
	 * -----------------------------------------------------------------------------
	 */
	public function disable_rest_api_links() {
		\remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
		\remove_action( 'wp_head', 'rest_output_link_wp_head' );
		\remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
	}

	/**
	 * Disable WLWManifest Link
	 *
	 * @since 1.0.0
	 * -----------------------------------------------------------------------------
	 * -----------------------------------------------------------------------------
	 */
	public function disable_wlw_manifest_link() {
		\remove_action( 'wp_head', 'wlwmanifest_link' );
	}

	/**
	 * Disable RSD Link
	 *
	 * @since 1.0.0
	 * -----------------------------------------------------------------------------
	 * -----------------------------------------------------------------------------
	 */
	public function disable_rsd_link() {
		\remove_action( 'wp_head', 'rsd_link' );
	}

	/**
	 * Disable Shortlink
	 *
	 * @since 1.0.0
	 * -----------------------------------------------------------------------------
	 * -----------------------------------------------------------------------------
	 */
	public function disable_shortlink() {
		\remove_action( 'wp_head', 'wp_shortlink_wp_head' );
		\remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
	}
}