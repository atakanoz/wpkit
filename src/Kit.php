<?php

namespace Theme;

use Theme\Utilities\Helpers;

final class Kit {

	public static $custom_classes = [];

	/**
	 * Debug.
	 *
	 * @param  mixed $code
	 * @return void
	 */
	public static function debug( $code ) {

		Helpers::get_debugger( $code );

	}

	/**
	 * Layout.
	 *
	 * @var  mixed $layout_name
	 * @param  mixed $layout_content
	 * @param  mixed $layout_args
	 * @return void
	 */
	public static function layout( $layout_name, $layout_content, $layout_args = array() ) {

		self::$custom_classes[] = 'layout-' . $layout_name;

		Helpers::get_layout( $layout_name, $layout_content, $layout_args );
	}

	/**
	 * Icon.
	 *
	 * @param  mixed $icon
	 * @return void
	 */
	public static function icon( $icon = '' ) {

		Helpers::get_icon( $icon );

	}

	/**
	 * Image.
	 *
	 * @param  mixed $image
	 * @param  mixed $alt
	 * @param  mixed $class
	 * @return void
	 */
	public static function image( $image, $alt = '', $class = 'x-image', $type = 'tag' ) {

		Helpers::get_image( $image, $alt, $class, $type );

	}

	/**
	 * Template.
	 *
	 * @param  mixed $template
	 * @param  mixed $args
	 * @return void
	 */
	public static function component( $type = 'Page', $template, $args = array() ) {

		Helpers::get_component( $type, $template, $args );

	}

	/**
	 * Button.
	 *
	 * @param  mixed $content
	 * @param  mixed $link
	 * @param  mixed $class
	 * @param  mixed $style
	 * @return void
	 */
	public static function button( $content, $link = '#', $class = '', $style = '' ) {

		Helpers::get_button( $content, $link, $class, $style );

	}
}
