<?php
  function my_theme_enqueue_styles() {
    wp_enqueue_style( 'hestia_style',
      get_template_directory_uri() . '/style.css',
      array( 'font-awesome', 'bootstrap' )
    );
    wp_enqueue_style( 'child-style',
      get_stylesheet_directory_uri() . '/style.css',
      array( 'hestia_style' )
    );
  }
  add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
?>