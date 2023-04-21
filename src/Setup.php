<?php
namespace Theme;

/**
 * Setup Extender.
 * -------------------------------------------------------------
 * This class is mainly crafted for to create required setup
 * methods to be used with the Kit class.
 *
 * These methods are linked at class-kit.php and called with
 * Kit namespace (e.g Kit::method()).
 *
 * @category   Extender
 * @package    SiteKit
 * @version    1.0.0
 * @author     KitStudio <hello@kitstudio.com>
 * @copyright  2022 KitStudio
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @see        Kit, Kit::icon(), Kit::layout() etc...
 */
class Setup extends Kit {

	/**
	 * Theme Styles.
	 *
	 * @since 1.0.0
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	 */
	public function styles() {

		if ( is_array( Kit::$styles ) ) {
			foreach ( Kit::$styles as $style => $path ) {
				wp_enqueue_style( $style, get_stylesheet_directory_uri() . $path, array(), Kit::$version );
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
		if ( is_array( Kit::$scripts ) ) {
			foreach ( Kit::$scripts as $script => $path ) {
				wp_enqueue_script( $script, get_stylesheet_directory_uri() . $path, Kit::$jquery, Kit::$version, true );
			}
		}
	}

	/**
	 * Initialize Composer.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function init_composer() {

		if ( Kit::$composer === true && file_exists( get_template_directory() . '/vendor/autoload.php' ) ) {

			require_once get_template_directory() . '/vendor/autoload.php';

		}

	}

	/**
	 * Initialize Carbon Fields.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function init_carbon_fields() {

		if ( Kit::$custom_fields === 'carbon_fields' && Kit::$composer === true ) {

			\Carbon_Fields\Carbon_Fields::boot();

		}
	}

	/**
	 * Sidebars.
	 *
	 * @param array $sidebars Sidebars array.
	 * @since 1.0.0
	 * @return void
	 */
	public function make_sidebars() {

		if ( is_array( Kit::$sidebars ) || is_object( Kit::$sidebars ) ) {

			foreach ( Kit::$sidebars as $sidebar => $value ) {

				/**
				 * Register the sidebars.
				 *
				 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
				 */
				register_sidebar(
					array(
						'id'            => $sidebar,
						'name'          => $value['name'],
						'description'   => isset( $value['description'] ) ? $value['description'] : '',
						'before_widget' => isset( $value['before_widget'] ) ? $value['before_widget'] : '',
						'after_widget'  => isset( $value['after_widget'] ) ? $value['after_widget'] : '',
						'before_title'  => isset( $value['before_title'] ) ? $value['before_title'] : '',
						'after_title'   => isset( $value['after_title'] ) ? $value['after_title'] : '',
					)
				);
			}
		}
	}

	/**
	 * Nav Menus.
	 *
	 * @since 1.0.0
	 * @param  mixed $menus
	 * @return void
	 */
	public function make_nav_menus() {
		/**
		 * Register the navigation menus.
		 *
		 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
		 */

		if ( is_array( Kit::$sidebars ) || is_object( Kit::$sidebars ) ) {

			foreach ( Kit::$menus as $location => $description ) {

				register_nav_menu( $location, $description );

			}
		}

	}

}

$the_setup = new Setup();

add_action( 'widgets_init', array( $the_setup, 'make_sidebars' ) );

add_action( 'wp_enqueue_scripts', array( $the_setup, 'styles' ) );

add_action( 'wp_enqueue_scripts', array( $the_setup, 'scripts' ) );

add_action( 'after_setup_theme', array( $the_setup, 'make_nav_menus' ) );