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

  // Custom category color
  add_action('category_add_form_fields', 'my_category_fields', 10, 2);
  add_action('category_edit_form_fields', 'my_category_fields', 10, 2);
  function my_category_fields($term) {
          $cat_color = get_term_meta($term->term_id, 'cat_color', true);
          if($cat_color == '') $cat_color = '#000000'; // Default black color

  ?>
  <tr class="form-field">
          <th valign="top" scope="row"><label for="cat_color"><?php _e('Color code'); ?></label></th>
          <td>
              <input type="color" size="40" value="<?php echo esc_attr($cat_color); ?>" id="cat_color" name="cat_color"><br/>
              <span class="description"><?php _e('Please select a color'); ?></span>
          </td>
      </tr>
  <?php
  }

  add_action('edited_category', 'save_my_category_fields', 10, 2);
  add_action('create_category', 'save_my_category_fields', 10, 2);

  function save_my_category_fields($term_id) {
    if (!isset($_POST['cat_color'])) {
        return;
    }

  update_term_meta($term_id, 'cat_color', sanitize_text_field($_POST['cat_color']));

  }

  // Custom logo
  add_theme_support( 'custom-logo' );

  // Customization options
  function rapsoo_customize_register( $wp_customize ) {

    // Custom header
    $wp_customize->add_section('rapsoo_header_section', array(
      'title' => 'Header',
      'priority' => 30,
    ));
    $wp_customize->add_setting('rapsoo_headline', array(
      'default' => 'I am John Doe, a Photo Model specializing in WordPress mockup sites',
    ));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'rapsoo_headline_control', array(
      'label' => 'Headline',
      'section' => 'rapsoo_header_section',
      'settings' => 'rapsoo_headline',
      'type' => 'text',
    )));
  }
  add_action('customize_register', 'rapsoo_customize_register');
?>