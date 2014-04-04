<?php
/**
 * Header
 *
 * Setup the header for our theme
 *
 * @package WordPress
 * @subpackage Foundation, for WordPress
 * @since Foundation, for WordPress 4.0
 */
?>

<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="width=device-width" />



<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


<title>VOCAL</title>

<?php	wp_enqueue_script("jquery");
		//~ wp_enqueue_script("jquery-ui-core");
		//~ wp_enqueue_script("jquery-ui-widget");
		//~ wp_enqueue_script("jquery-ui-button");
?>

<?php wp_head(); ?>

<link rel="stylesheet" href="<?php echo themeDir(); ?>/iCheck/skins/vocal/vocal.css" />
<script language="javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/iCheck/jquery.icheck.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?php echo themeDir(); ?>/scripts/mobilyslider/css/default.css" />
<script language="javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/scripts/mobilyslider/js/mobilyslider.js" type="text/javascript"></script>

<script language="javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/scripts/resize/jquery.resizecrop-1.0.3.min.js" type="text/javascript"></script>

</head>



<body <?php body_class(); ?>>

  <div id="contenedor_principal">

    
	<?php 
        /* if( !is_front_page() ) */
		vocal_main_nav();
        /* else
	vocal_portada_nav(); */
	if ( $header !== "blank" ) : ?>

	<?php endif; ?>

<!-- Begin Page -->
<div id="content" class="row">




<?php



    $imgDir = get_stylesheet_directory_uri()."/img/";
    $ajaxLoader = foo_div("","ajax-loader",foo_img($imgDir."ajax-loader.gif"));

	echo foo_div("url","hidden",get_site_url());
	echo foo_div("ajax-loader-div","hidden",$ajaxLoader);




	//~ $arr2json = array(
		//~ 'posts' => "hola",
		//~ 'lis' => "adios"	
	//~ );
//~ 
	//~ header('Content-Type: application/json');
	//~ $json = json_encode($arr2json);
//~ echo foo_div("","debug",$json);



?>

