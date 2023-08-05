<?php

namespace Theme\Core;

use Theme\Core\Registrable;
use \Symfony\Component\Yaml\Yaml;

class Bootstrap {

	/**
	 * Theme name.
	 *
	 * @var string $name.
	 */
	private static $name;

	/**
	 * Theme version.
	 *
	 * @var string $version.
	 */
	public static $version;

	/**
	 * Text domain.
	 *
	 * @var string $text_domain.
	 */
	public static $text_domain;

	/**
	 * Icon directory.
	 *
	 * @var string $icon_dir.
	 */
	public static $icon_dir;

	/**
	 * Image directory.
	 *
	 * @var string $image_dir;
	 */
	public static $image_dir;

	/**
	 * Styles.
	 *
	 * @var array $styles.
	 */
	public static $styles = array();

	/**
	 * Scripts
	 *
	 * @var array $scripts.
	 */
	public static $scripts = array();

	/**
	 * JQuery allowance.
	 *
	 * @var string $jquery.
	 */
	public static $jquery;

	/**
	 * Custom fields.
	 *
	 * @var string $custom_fields;
	 */
	public static $custom_fields;

	/**
	 * Sidebars.
	 *
	 * @var array $sidebars;
	 */
	public static $sidebars = array();

	/**
	 * Menus.
	 *
	 * @var array $menus.
	 */
	public static $menus = array();

	/**
	 * Include Files.
	 *
	 * @var string $included_files.
	 */
	protected $included_files;

	protected $services;

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \Noma\Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \Noma\Plugin An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance->run();

	}

	/**
	 * Run
	 * @return void
	 */
	public function run() {
		$this->do_setup( $this->get_setup() );
	}

	/**
	 * Get Setup
	 *
	 * Retrieves the setup file and its content.
	 * @return mixed
	 */
	public function get_setup() {
		// -----------------------------------------------------------------------
		// Read the Setup file.
		// Setup file is a YAML file that is located at includes/setup.yaml
		// -----------------------------------------------------------------------
		return Yaml::parseFile( \get_stylesheet_directory() . '/src/setup.yaml' );
	}

	/**
	 * Init.
	 *
	 * @return void
	 */
	public function do_setup( $init = array() ) {

		// Use the array root.
		$kit = $init['themekit'];

		// -----------------------------------------------------------------------
		// Set Config Data.
		// -----------------------------------------------------------------------
		self::$name = $kit['config']['theme_name'];
		self::$version = $kit['config']['theme_version'];
		self::$text_domain = $kit['config']['text_domain'];
		self::$jquery = $kit['config']['jquery_support'] ? array( 'jquery' ) : array();
		self::$custom_fields = $kit['config']['custom_fields'] ? $kit['config']['custom_fields'] : 'none';


		// -----------------------------------------------------------------------
		// Set Directory Data.
		// -----------------------------------------------------------------------
		self::$icon_dir = get_stylesheet_directory() . $kit['dir']['icon_dir'];
		self::$image_dir = get_stylesheet_directory_uri() . $kit['dir']['image_dir'];

		// -----------------------------------------------------------------------
		// Set Assets Data.
		// -----------------------------------------------------------------------
		self::$styles = $kit['styles'];
		self::$scripts = $kit['scripts'];

		// -----------------------------------------------------------------------
		// Set Sidebars Data.
		// -----------------------------------------------------------------------
		self::$sidebars = $kit['sidebars'];

		// -----------------------------------------------------------------------
		// Set Menu Data.
		// -----------------------------------------------------------------------
		self::$menus = $kit['menus'];


		// echo self::$name;

		/**
		 * Initialize Modules.
		 *
		 * @since 1.0.0
		 */
		foreach ( $kit['include_files'] as $filename ) {
			require get_template_directory() . '/' . $filename . '.php';
		}

		// -----------------------------------------------------------------------
		// Setup Services.
		// -----------------------------------------------------------------------
		foreach ( $kit['services'] as $service ) {

			if ( ( new $service ) instanceof Registrable ) {
				( new $service )->register();
			}
		}

	}

}
