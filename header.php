<?php
/**
 * @package WordPress
 * @subpackage Custom-Theme
 * @since Custom-Theme
 */
?><!doctype html>

<!--[if lte IE 8 ]><html class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->

<head>
  <meta charset="<?php bloginfo('charset'); ?>">

  <!--[if IE ]>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <![endif]-->

  <?php
    if (is_search())
      echo '<meta name="robots" content="noindex, nofollow" />';
  ?>

  <title><?php wp_title( '|', true, 'right' ); ?></title>


  <?php /*********** Meta ***********/ ?>
  <meta name="title" content="<?php wp_title( '|', true, 'right' ); ?>">
  <meta name="description" content="<?php bloginfo('description'); ?>" />
  <meta name="Copyright" content="Copyright &copy; <?php bloginfo('name'); ?> <?php echo date('Y'); ?>. All Rights Reserved.">
  <?php
    if (true == of_get_option('meta_author'))
      echo '<meta name="author" content="' . of_get_option("meta_author") . '" />';

    if (true == of_get_option('meta_google'))
      echo '<meta name="google-site-verification" content="' . of_get_option("meta_google") . '" />';
  ?>


  <?php /*********** Favicon ***********/ ?>
  <?php
    if (true == of_get_option('meta_viewport'))
      echo '<meta name="viewport" content="' . of_get_option("meta_viewport") . ' minimal-ui" />';

    if (true == of_get_option('head_favicon')) {
      echo '<meta name=”mobile-web-app-capable” content=”yes”>';
      echo '<link rel="shortcut icon" sizes=”1024x1024” href="' . of_get_option("head_favicon") . '" />';
    }

    if (true == of_get_option('head_apple_touch_icon'))
      echo '<link rel="apple-touch-icon" href="' . of_get_option("head_apple_touch_icon") . '">';
  ?>


  <?php /*********** HTML5 Shim ***********/ ?>
  <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/_/inc/js/html5shiv.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/_/inc/js/html5shiv-printshiv.js"></script>
  <![endif]-->


  <?php /*********** CSS ***********/ ?>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/_/css/styles.css" />


  <?php /*********** Options ***********/ ?>
  <?php
    // Windows 8
    if (true == of_get_option('meta_app_win_name')) {
      echo '<meta name="application-name" content="' . of_get_option("meta_app_win_name") . '" /> ';
      echo '<meta name="msapplication-TileColor" content="' . of_get_option("meta_app_win_color") . '" /> ';
      echo '<meta name="msapplication-TileImage" content="' . of_get_option("meta_app_win_image") . '" />';
    }

    // Twitter
    if (true == of_get_option('meta_app_twt_card')) {
      echo '<meta name="twitter:card" content="' . of_get_option("meta_app_twt_card") . '" />';
      echo '<meta name="twitter:site" content="' . of_get_option("meta_app_twt_site") . '" />';
      echo '<meta name="twitter:title" content="' . of_get_option("meta_app_twt_title") . '">';
      echo '<meta name="twitter:description" content="' . of_get_option("meta_app_twt_description") . '" />';
      echo '<meta name="twitter:url" content="' . of_get_option("meta_app_twt_url") . '" />';
    }

    // Facebook
    if (true == of_get_option('meta_app_fb_title')) {
      echo '<meta property="og:title" content="' . of_get_option("meta_app_fb_title") . '" />';
      echo '<meta property="og:description" content="' . of_get_option("meta_app_fb_description") . '" />';
      echo '<meta property="og:url" content="' . of_get_option("meta_app_fb_url") . '" />';
      echo '<meta property="og:image" content="' . of_get_option("meta_app_fb_image") . '" />';
    }
  ?>

  <link rel="profile" href="http://gmpg.org/xfn/11" />

  <?php /*********** Pingback for Wordpress Posts ***********/ ?>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

  <?php // wp_head(); ?>

</head>

<body <?php // body_class(); ?>>

  <div class="c-main-wrapper">

    <?php /*********** Main header ***********/ ?>
    <header id="header" class="c-main-header" role="banner">
      <a class="-main-header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
          <span class="visuallyhidden"><?php bloginfo( 'name' ); ?></span>
          <img src="<?php echo bloginfo('template_directory'); ?>/_/inc/images/main-logo.png" alt="Logo" width="263" height="67" />
      </a>

      <?php /*
        <div class="description"><?php bloginfo( 'description' ); ?></div>
      */ ?>


      <?php /*********** Main navigation ***********/ ?>
      <nav id="nav" role="navigation">
        <ul class="main-nav__list">
          <?php wp_nav_menu( array('theme_location' => 'primary', "container" => "", "items_wrap" => '%3$s') ); ?>
        </ul>
      </nav>

      <nav id="meta-nav" class="main-meta-nav" role="navigation">
          <ul class="meta-nav__list">
              <?php wp_nav_menu( array('theme_location' => 'meta', "container" => "", "items_wrap" => '%3$s') ); ?>

              <?php /*********** Language switch ***********/ ?>
              <?php
                  if (true == function_exists('pll_the_languages'))
                  {
                      pll_the_languages(array("dropdown"=>0,"show_flags"=>0, "hide_current"=>1));
                  }
              ?>
          </ul>
      </nav>
    </header>

    <main class="c-main-content">


