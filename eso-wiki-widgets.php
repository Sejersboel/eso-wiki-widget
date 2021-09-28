<?php
/**
 * ESOWiki widgets plugin
 *
 * @package eso-wiki-widgets
 *
 * Plugin Name: ESOWiki Widgets
 * Description: Widgets til nemmere at kunne lave artikler til TDGs ESOWiki
 * Plugin URI:  https://github.com/Sejersboel/eso-wiki-widget
 * Version:     1.0.0
 * Author:      Hagbard Jensen
 * Text Domain: eso-wiki-widgets
 */

define('ESO_WIKI_WIDGETS', __FILE__);

/**
 * Include the ESO_Wiki_Widgets class.
 */
require plugin_dir_path( ESO_WIKI_WIDGETS ) . 'class-eso-wiki-widgets.php';
