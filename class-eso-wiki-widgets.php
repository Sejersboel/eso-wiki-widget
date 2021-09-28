<?php
/**
 * ESO_Wiki_Widgets class.
 *
 * @category    Class
 * @package     eso-wiki-widgets
 * @subpackage  WordPress
 * @author      Hagbard Jensen
 * @copyright   2021 Hagbard Jensen
 * @since       1.0.0
 * php version  7.0
 */

if ( ! defined ('ABSPATH' ) ) {
  // Exit if accessed directly.
  exit;
}

/**
 * Main plugin Class
 *
 * The ini cæass that runs the eso-wiki-widgets plugin
 *
 * Only modify constants to match plugin needs.
 */
final class ESO_Wiki_Widgets {
  /**
   * Plugin Version
   *
   * @since 1.0.0
   * @var string The plugin version
   */
  const VERSION = '1.0.0';
  
  /** 
   * Minimum Elementor Version
   *
   * @since 1.0.0
   * @var string Minimum Elementor version required to use plugin.
   */
  const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

  /**
   * Minimum PHP Version
   *
   * @since 1.0.0
   * @var string Minimum PHP version required to use plugin.
   */
  const MINIMUM_PHP_VERSION = '7.0';

  /**
   * Constructor
   *
   * @since 1.0.0
   * @access public
   */
  public function __construct() {
    // Load the translation.
    add_action( 'init', array ($this, 'i18n' ) );

    // Initialise the plugin
    add_action( 'plugins_loaded', array( $this, 'init' ) );
  }

  /**
   * Load Textdomain
   *
   * Load plugin localisation files.
   * Fired by 'init' action hook.
   *
   * @since 1.0.0
   * @access public
   */
  public function i18n() {
    load_plugin_textdomain( 'eso-wiki-widgets' );
  }

  /**
   * Initialise the plugin
   *
   * Validates that Elementor is already loaded.
   * Checks for basic plugin requirements.
   *
   * Fires by 'plugins_loaded' action hook.
   *
   * @since 1.0.0
   * @access public
   */
  public function init() {

    //Checks if Elementor is installed and activated.
    if ( ! did_action ('elementor/loaded' ) ) {
      add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
      return;
    }

    //Checks for required Elementor version
    if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
      add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
      return;
    }

    if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
      add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
      return;
    }

    require_once 'class-widgets.php';
  }

  /**
   * Amin notice
   *
   * Warning when the site doesn't have Elementor installed or activated.
   *
   * @since 1.0.0
   * @access public
   */
  public function admin_notice_missing_main_plugin() {
    deactivate_plugins( plugin_basename( ESO_WIKI_WIDGETS ) );

    return sprintf(
      wp_kses(
        '<div class="notice-warning is-dismissible"><p><strong>"%1$s"</strong> requires <strong>"%2$s"</strong> to be installed and activated.</p></div>',
        array(
          'div' => array(
              'class' => array(),
              'p'     => array(),
              'strong'=> array(),
          ),
        )
      ), 
      'ESOWiki Widgets',
      'Elementor'
    );
  }


  /**
   * Amin notice
   *
   * Warning when the site doesn't have the minimum required version of
   * elementor.
   *
   * @since 1.0.0
   * @access public
   */
  public function admin_notice_minimum_elementor_version() {
    deactivate_plugins( plugin_basename( ESO_WIKI_WIDGETS ) );

    return sprintf(
      wp_kses(
        '<div class="notice-warning is-dismissible"><p><strong>"%1$s"</strong> requires <strong>"%2$s"</strong> to be installed and activated.</p></div>',
        array(
          'div' => array(
              'class' => array(),
              'p'     => array(),
              'strong'=> array(),
          ),
        )
      ), 
      'ESOWiki Widgets',
      'Elementor',
      self::MINIMUM_ELEMENTOR_VERSION
    );
  }

  /**
   * Amin notice
   *
   * Warning when the site doesn't have the minimum required version of
   * PHP.
   *
   * @since 1.0.0
   * @access public
   */
  public function admin_notice_minimum_php_version() {
    deactivate_plugins( plugin_basename( ESO_WIKI_WIDGETS ) );

    return sprintf(
      wp_kses(
        '<div class="notice-warning is-dismissible"><p><strong>"%1$s"</strong> requires <strong>"%2$s"</strong> to be installed and activated.</p></div>',
        array(
          'div' => array(
              'class' => array(),
              'p'     => array(),
              'strong'=> array(),
          ),
        )
      ), 
      'ESOWiki Widgets',
      'Elementor',
      self::MINIMUM_PHP_VERSION
    );
  }
}

// Instansiate ESO_Wiki_Widgets.
new ESO_Wiki_widgets();
