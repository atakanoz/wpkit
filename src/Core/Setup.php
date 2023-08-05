<?php
namespace Theme\Core;

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
class Setup {

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
}
