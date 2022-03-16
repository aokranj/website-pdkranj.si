<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico"/>
		<?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>

    <nav class="pd-header navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container-fluid">
        <h1 class="navbar-brand">
          <a href="<?php echo home_url(); ?>">
            <?php bloginfo( 'name' ); ?>
          </a>
        </h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primaryNav" aria-controls="primaryNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-column align-items-end" id="primaryNav">
          <?php require_once 'tpl/social.php'; ?>
          <?php wp_nav_menu([
            'menu'          	=> 'header',
            'theme_location'	=> 'header',
            'depth'         	=> 2,
            'container'			  => false,
            'menu_class'    	=> 'navbar-nav',
            'fallback_cb'   	=> '__return_false',
            'walker'         	=> new bootstrap_5_wp_nav_menu_walker()
          ]); ?>
        </div>
      </div>
    </nav>

    <?php if($_SERVER['REQUEST_URI'] == '/') require_once 'tpl/slider.php'; ?>

    <main class="pd-main container-md">
      <div class="row">
        <div class="pd-content col-lg-9 order-1 order-lg-2">