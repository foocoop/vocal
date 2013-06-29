<?php
/*
Template Name: Portada
*/

get_header(); 

makeLink("Archive proyectos",get_post_type_archive_link("proyecto"));
$page = get_page_by_title( 'Portada' );
$content = apply_filters('the_content', $page->post_content);
$images="";
$imagenes = get_images(get_the ID());
foreach ($imagenes as $imagen) {
	$images.=makeLi("","",$imagen);
}
makeDiv("content","",$content);
makeDiv("images","",$images);
?>
<?php get_footer(); ?>