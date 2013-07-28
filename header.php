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



<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="width=device-width" />

<title><?php wp_title(); ?></title>

<?php wp_enqueue_script("jquery"); ?>

<?php wp_head(); ?>

</head>

<!--
-->

<script language="javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/scripts/jquery-easy-drop-down/jquery.dropdown.js" type="text/javascript"></script>

<body <?php body_class(); ?>>

	<?php 
	if( !is_front_page() )
		vocal_main_nav();
	else
		vocal_portada_nav();
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
