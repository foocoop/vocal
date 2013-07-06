<?php
/*
Template Name: Portada
*/

get_header(); 

if(have_posts() ) : the_post;

	$page = get_page_by_title( 'Portada' );
	$content = apply_filters('the_content', $page->post_content);
	$images="";
	$imagenes = get_images( $post->ID , 'full' );
	
	foreach ($imagenes as $imagen) {
		$images.=makeImg($imagen[0]);
	}

	$echo .= makeLink("Archive proyectos",get_post_type_archive_link("proyecto"));
	$echo .= makeDiv("content","",$content);
	$echo .= makeDiv("images","",$images);

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
