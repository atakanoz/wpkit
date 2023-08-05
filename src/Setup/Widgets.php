<?php

namespace Theme\Setup;

use Theme\Core\Bootstrap;
use Theme\Core\Registrable;


class Widgets implements Registrable {

	public function register() {
		\add_action( 'widgets_init', array( $this, 'factory' ) );
	}

	public function factory() {

		if ( is_array( Bootstrap::$sidebars ) || is_object( Bootstrap::$sidebars ) ) {

			foreach ( Bootstrap::$sidebars as $sidebar => $value ) {

				/**
				 * Register the sidebars.
				 *
				 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
				 */
				register_sidebar(
					array(
						'id' => $sidebar,
						'name' => $value['name'],
						'description' => isset( $value['description'] ) ? $value['description'] : '',
						'before_widget' => isset( $value['before_widget'] ) ? $value['before_widget'] : '',
						'after_widget' => isset( $value['after_widget'] ) ? $value['after_widget'] : '',
						'before_title' => isset( $value['before_title'] ) ? $value['before_title'] : '',
						'after_title' => isset( $value['after_title'] ) ? $value['after_title'] : '',
					)
				);
			}
		}
	}
}
