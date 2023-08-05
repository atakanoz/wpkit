<?php

namespace Theme\Setup;

use Theme\Core\Bootstrap;
use Theme\Core\Registrable;

class NavMenus implements Registrable {

	public function register() {
		\add_action( 'after_setup_theme', array( $this, 'config' ) );
	}

	public function config() {
		if ( is_array( Bootstrap::$menus ) || is_object( Bootstrap::$menus ) ) {

			foreach ( Bootstrap::$menus as $menu ) {

				register_nav_menu( $menu['location'], $menu['description'] );

			}
		}
	}
}
