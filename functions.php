<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */

  // Options Framework (https://github.com/devinsays/options-framework-plugin)
  if ( !function_exists( 'optionsframework_init' ) ) {
    define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/_/inc/' );
    require_once dirname( __FILE__ ) . '/_/inc/options-framework.php';
  }

  // Theme Setup (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
  function html5reset_setup() {
    load_theme_textdomain( 'html5reset', get_template_directory() . '/languages' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'structured-post-formats', array( 'link', 'video' ) );
    add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'quote', 'status' ) );
    register_nav_menu( 'primary', __( 'Navigation Menu', 'html5reset' ) );
    add_theme_support( 'post-thumbnails' );
  }
  add_action( 'after_setup_theme', 'html5reset_setup' );

  // Scripts & Styles (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
  function html5reset_scripts_styles() {
    global $wp_styles;

    // Load Comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
      wp_enqueue_script( 'comment-reply' );

    // Load Stylesheets
//    wp_enqueue_style( 'html5reset-reset', get_template_directory_uri() . '/reset.css' );
//    wp_enqueue_style( 'html5reset-style', get_stylesheet_uri() );

    // Load IE Stylesheet.
//    wp_enqueue_style( 'html5reset-ie', get_template_directory_uri() . '/css/ie.css', array( 'html5reset-style' ), '20130213' );
//    $wp_styles->add_data( 'html5reset-ie', 'conditional', 'lt IE 9' );

    // Modernizr
    // This is an un-minified, complete version of Modernizr. Before you move to production, you should generate a custom build that only has the detects you need.
    // wp_enqueue_script( 'html5reset-modernizr', get_template_directory_uri() . '/_/js/modernizr-2.6.2.dev.js' );

  }
  add_action( 'wp_enqueue_scripts', 'html5reset_scripts_styles' );

  // WP Title (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
  function html5reset_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() )
      return $title;

//     Add the site name.
    $title .= get_bloginfo( 'name' );

//     Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
      $title = "$title $sep $site_description";

//     Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 )
      $title = "$title $sep " . sprintf( __( 'Page %s', 'html5reset' ), max( $paged, $page ) );

    return $title;
  }
  add_filter( 'wp_title', 'html5reset_wp_title', 10, 2 );




//OLD STUFF BELOW


  // Load jQuery
  if ( !function_exists( 'core_mods' ) ) {
    function core_mods() {
      if ( !is_admin() ) {
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', ( "http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ), false);
        wp_enqueue_script( 'jquery' );
      }
    }
    add_action( 'wp_enqueue_scripts', 'core_mods' );
  }

  // Clean up the <head>, if you so desire.
  //  function removeHeadLinks() {
  //      remove_action('wp_head', 'rsd_link');
  //      remove_action('wp_head', 'wlwmanifest_link');
  //    }
  //    add_action('init', 'removeHeadLinks');

  // Custom Menu
  register_nav_menu( 'primary', __( 'Navigation Menu', 'html5reset' ) );

  // Widgets
  if ( function_exists('register_sidebar' )) {
    function html5reset_widgets_init() {
      register_sidebar( array(
        'name'          => __( 'Sidebar Widgets', 'html5reset' ),
        'id'            => 'sidebar-primary',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
      ) );
    }
    add_action( 'widgets_init', 'html5reset_widgets_init' );
  }



  /**********************************************************************
   * Add excerpt support for pages
   **********************************************************************/
  add_action( 'init', 'my_add_excerpts_to_pages' );
  function my_add_excerpts_to_pages() {
       add_post_type_support( 'page', 'excerpt' );
  }



  /**********************************************************************
   * Creating a function to create our CPT
   * https://www.smashingmagazine.com/2012/11/complete-guide-custom-post-types/
   **********************************************************************/
  function custom_post_type() {

  // Set UI labels for Custom Post Type
    $labels = array(
      'name'                => 'Custom Posts',
      'singular_name'       => 'Custom Post',
      'menu_name'           => 'Custom Post',
      'all_items'           => 'All Custom Posts',
      'view_item'           => 'View Custom Post',
      'add_new_item'        => 'Add New Custom Post',
      'add_new'             => 'Add New',
      'edit_item'           => 'Edit Custom Post',
      'update_item'         => 'Update Custom Post',
      'search_items'        => 'Search Custom Post',
      'not_found'           => 'Not Found',
      'not_found_in_trash'  => 'Not found in Trash',
    );

  // Set other options for Custom Post Type

    $args = array(
      'label'               => 'custom',
      'description'         => 'Posts for Custom',
      'labels'              => $labels,
      // Features this CPT supports in Post Editor
      'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
      // You can associate this CPT with a taxonomy or custom taxonomy.
      // 'taxonomies'          => array( 'genres' ),
      /* A hierarchical CPT is like Pages and can have
      * Parent and child items. A non-hierarchical CPT
      * is like Posts.
      */
      'hierarchical'        => true,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_nav_menus'   => true,
      'show_in_admin_bar'   => true,
      'menu_position'       => 5,
      'can_export'          => true,
      'has_archive'         => true, // If set to true, rewrite rules will be created for you, enabling a post type archive at http://mysite.com/posttype/ (by default)
      'exclude_from_search' => false,
      'publicly_queryable'  => true,
      'capability_type'     => 'post',
    );

    // Registering your Custom Post Type
    register_post_type( 'custom', $args );

  }

  /* Hook into the 'init' action so that the function
  * Containing our post type registration is not
  * unnecessarily executed.
  */

  add_action( 'init', 'custom_post_type', 0 );



  /**********************************************************************
  * Add custom field checkbox for featured homepage teaser
  ***********************************************************************/
  // add_action( 'post_submitbox_misc_actions', 'demus_featured_post_field' );
  function demus_featured_post_field()
  {
    global $post;

    /* check if this is a post, if not then we won't add the custom field */
    /* change this post type to any type you want to add the custom field to */
    if (get_post_type($post) != 'post') return false;

    /* get the value corrent value of the custom field */
    $value = get_post_meta($post->ID, 'demus_featured_post_field', true);
    ?>
      <div class="misc-pub-section">
        <?php //if there is a value (1), check the checkbox ?>
        <label><input type="checkbox"<?php echo (!empty($value) ? ' checked="checked"' : null) ?> value="1" name="demus_featured_post_field" />Highlight-Teaser (größer)</label>
      </div>
    <?php
  }

  // add_action( 'save_post', 'demus_save_postdata');
  function demus_save_postdata($postid)
  {
    /* check if this is an autosave */
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return false;

    /* check if the user can edit this page */
    if ( !current_user_can( 'edit_page', $postid ) ) return false;

    /* check if there's a post id and check if this is a post */
    /* make sure this is the same post type as above */
    if(empty($postid) || $_POST['post_type'] != 'post' ) return false;

    /* if you are going to use text fields, then you should change the part below */
    /* use add_post_meta, update_post_meta and delete_post_meta, to control the stored value */

    /* check if the custom field is submitted (checkboxes that aren't marked, aren't submitted) */
    if(isset($_POST['demus_featured_post_field'])){
      /* store the value in the database */
      add_post_meta($postid, 'demus_featured_post_field', 1, true );
    }
    else{
      /* not marked? delete the value in the database */
      delete_post_meta($postid, 'demus_featured_post_field');
    }
  }



  /**********************************************************************
   * Add custom thumb size
   **********************************************************************/
  // add_action( 'after_setup_theme', 'wpdocs_theme_setup' );
  function wpdocs_theme_setup() {
    add_image_size( 'thumbnail-featured', 1160, 320, true );
  }



  /**********************************************************************
   * Strip wordpress gallery to needed elements only
   **********************************************************************/
  // add_filter('post_gallery', 'my_post_gallery', 10, 2);
  function my_post_gallery($output, $attr) {
    global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
      if (!$attr['orderby'])
        unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
      'order' => 'ASC',
      'orderby' => 'menu_order ID',
      'id' => $post->ID,
      'itemtag' => 'dl',
      'icontag' => 'dt',
      'captiontag' => 'dd',
      'columns' => 3,
      'size' => 'thumbnail',
      'include' => '',
      'exclude' => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
      $include = preg_replace('/[^0-9,]+/', '', $include);
      $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

      $attachments = array();
      foreach ($_attachments as $key => $val) {
        $attachments[$val->ID] = $_attachments[$key];
      }
    }

    if (empty($attachments)) return '';

    // Here's your actual output, you may customize it to your need
    $output = "<section class=\"mod-slider\">\n";
    $output .= "<div class=\"mod-slider__wrapper\">\n";
    $output .= "<ul class=\"mod-slider__list\">\n";

    // Now you loop through each attachment
    foreach ($attachments as $id => $attachment) {
      // Fetch the thumbnail (or full image, it's up to you)
      // $img = wp_get_attachment_image_src($id, 'medium');
      $img = wp_get_attachment_image_src($id, 'large');
      // $img = wp_get_attachment_image_src($id, 'full');
      // $img = wp_get_attachment_image_src($id, 'my-custom-image-size');

      $output .= "<li class=\"mod-slider__item\">\n";
      $output .= "<div class=\"mod-slider__aspect\">\n";
      $output .= "<img class=\"mod-slider__image\" src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />\n";
      $output .= "</div>\n";
      $output .= "</li>\n";
    }

    $output .= "</ul>\n";
    $output .= "</div>\n";

    $output .= "<div class=\"mod-slider__actionbar\">\n";
    $output .= "<div class=\"mod-slider__pagination\">\n";
    $output .= "</div>\n";
    $output .= "<button class=\"mod-slider__control mod-slider__control--prev mod-icon-arrow-left\" type=\"button\" title=\"vorheriges\"></button>\n";
    $output .= "<button class=\"mod-slider__control mod-slider__control--next mod-icon-arrow-right\" type=\"button\" title=\"nächstes\"></button>\n";
    $output .= "</div>\n";

    $output .= "</section>\n";

    return $output;
  }
?>
