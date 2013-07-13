<?php
/*
Template Name: Portada
*/

get_header(); 

if(have_posts() ) : the_post;

	$page = get_page_by_title( 'Portada' );
	$content = foo_filter('the_content', $page->post_content);
	$images="";
	$imagenes = foo_images( $post->ID , 'full' );
	
	foreach ($imagenes as $imagen) {
		$images.=foo_img($imagen[0]);
	}

	$echo .= foo_link("Archive proyectos",get_post_type_archive_link("proyecto"));
	$echo .= foo_div("content","",$content);
	$echo .= foo_div("images","",$images);

	echo $echo;

endif;
?>
<?php get_footer(); ?>


	<script type="text/javascript">
		var $j = jQuery.noConflict();
		
		
		$j(document).ready(function(){
			$j('#images').orbit({ animationSpeed: 5000 });
		});
	</script>
			
</html>
