<?php
  function getStyle() {
    wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.min.css');
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&display=swap', false );
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css', false);
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

  // Carbon fields
  use Carbon_Fields\Container;
  use Carbon_Fields\Field;

  add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
    function crb_attach_theme_options() {
      Container::make( 'post_meta', 'Details sidebar' )
      ->where( 'post_type', '=', 'post' )
      ->add_fields( array(
          Field::make('rich_text', 'crb_details', 'Edit details sidebar')
      ));
  }
  add_action( 'carbon_fields_register_fields', 'crb_attach_post_meta' );
  function crb_attach_post_meta() {
    Container::make( 'post_meta', 'Experience' )
        ->where( 'post_type', '=', 'page' ) // only show our new fields on pages
        ->where( 'post_id', '=', get_option( 'page_on_front' ) )
        ->add_fields( array(
            Field::make( 'complex', 'crb_occupations', 'Edit experience' )
              ->set_layout( 'grid' )
              ->add_fields( array(
                Field::make( 'text', 'occupation_title', 'Title' ),
                Field::make( 'text', 'occupation_company', 'Company name' ),
                Field::make( 'text', 'occupation_date', 'Date' ),
              ) ),
        ) );
    Container::make( 'post_meta', 'Education' )
    ->where( 'post_type', '=', 'page' ) // only show our new fields on pages
    ->where( 'post_id', '=', get_option( 'page_on_front' ) )
    ->add_fields( array(
      Field::make( 'complex', 'crb_educations', 'Edit education' )
        ->set_layout( 'grid' )
        ->add_fields( array(
          Field::make( 'text', 'education_field_of_study', 'Field of study' ),
          Field::make( 'text', 'education_degree', 'Degree' ),
          Field::make( 'text', 'education_school', 'School' ),
          Field::make( 'text', 'education_date', 'Date' ),
        ) ),
    ) );
}

  // Custom category color
  add_action('category_add_form_fields', 'my_category_fields', 10, 2);
  add_action('category_edit_form_fields', 'my_category_fields', 10, 2);
  function my_category_fields($term) {
          $cat_color = get_term_meta($term->term_id, 'cat_color', true);
          if($cat_color == '') $cat_color = '#000000'; // Default black color

  ?>
  <div class="form-field">
    <label for="cat_color"><?php _e('Category color'); ?></label>
    <input type="color" size="40" value="<?php echo esc_attr($cat_color); ?>" id="cat_color" name="cat_color"><br/>
    <p class="description"><?php _e('Please select a color for the category.'); ?></p>
  </div>
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

  // Get current URL
  function wp_get_current_url() {
    return home_url( $_SERVER['REQUEST_URI'] );
  }

  // Custom logo
  add_theme_support( 'custom-logo' );

  // Customization options
  function rapsoo_customize_register( $wp_customize ) {

    // Header customization
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

    // Posts customization
    $wp_customize->add_section('rapsoo_posts_section', array(
      'title' => 'Posts',
      'priority' => 31,
    ));
    $wp_customize->add_setting('rapsoo_posts_heading', array(
      'default' => 'My works',
    ));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'rapsoo_posts_heading_control', array(
      'label' => 'Posts heading',
      'section' => 'rapsoo_posts_section',
      'settings' => 'rapsoo_posts_heading',
      'type' => 'text',
    )));

    // Footer customization
    $wp_customize->add_section('rapsoo_footer_section', array(
      'title' => 'Footer',
      'priority' => 32,
    ));
    $wp_customize->add_setting('rapsoo_footer_heading', array(
      'default' => 'Contact me',
    ));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'rapsoo_footer_heading_control', array(
      'label' => 'Footer heading',
      'section' => 'rapsoo_footer_section',
      'settings' => 'rapsoo_footer_heading',
      'type' => 'text',
    )));

    // Email address
    $wp_customize->add_setting('rapsoo_email_address', array(
      'default' => '',
    ));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'rapsoo_email_address_control', array(
      'label' => 'Your Email address',
      'description' => 'Provide your email address (format: name@domain.com)',
      'section' => 'rapsoo_footer_section',
      'settings' => 'rapsoo_email_address',
      'type' => 'text',
    )));

    // Social media links
    $wp_customize->add_setting('rapsoo_instagram_link', array(
      'default' => '',
    ));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'rapsoo_instagram_link_control', array(
      'label' => 'Your Instagram',
      'description' => 'Provide URL for your Instgram account',
      'section' => 'rapsoo_footer_section',
      'settings' => 'rapsoo_instagram_link',
      'type' => 'text',
    )));

    $wp_customize->add_setting('rapsoo_linkedin_link', array(
      'default' => '',
    ));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'rapsoo_linkedin_link_control', array(
      'label' => 'Your LinkedIn',
      'description' => 'Provide URL for your LinkedIn account',
      'section' => 'rapsoo_footer_section',
      'settings' => 'rapsoo_linkedin_link',
      'type' => 'text',
    )));

    $wp_customize->add_setting('rapsoo_github_link', array(
      'default' => '',
    ));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'rapsoo_github_link_control', array(
      'label' => 'Your Github',
      'description' => 'Provide URL for your Github account',
      'section' => 'rapsoo_footer_section',
      'settings' => 'rapsoo_github_link',
      'type' => 'text',
    )));

    $wp_customize->add_setting('rapsoo_instagram_link', array(
      'default' => '',
    ));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'rapsoo_instagram_link_control', array(
      'label' => 'Your Instagram',
      'description' => 'Provide URL for your Instgram account',
      'section' => 'rapsoo_footer_section',
      'settings' => 'rapsoo_instagram_link',
      'type' => 'text',
    )));
    
  }
  add_action('customize_register', 'rapsoo_customize_register');
?>