<?php
  function getStyle() {
    wp_enqueue_style('normalize', get_template_directory_uri() . 'css/normalize.min.css');
    wp_enqueue_style('all', get_template_directory_uri() . 'css/all.min.css');
    wp_enqueue_style('style', get_stylesheet_uri());
  }
  add_action('wp_enqueue_scripts', 'getStyle' );

  function my_enqueue_scripts() {
    wp_enqueue_script( 'jquery_3.4.1', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), '3.4.1', true);
    wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/js/custom-script.js', array(), null, true);
    $translation_array = array( 'templateUrl' => get_template_directory_uri());
    wp_localize_script( 'custom-script', 'customScriptVar', $translation_array );
  }
  add_action( 'wp_enqueue_scripts', 'my_enqueue_scripts' );

  // Theme setup
  function rapsooSetup() {

  }
  add_action('after_setup_theme', 'rapsooSetup');

  add_theme_support( 'post-thumbnails' );
      
  // Theme path
  if (!defined('THEME_IMG_PATH')) {
    define('THEME_IMG_PATH', get_stylesheet_directory_uri() . '/img');
  };

?>