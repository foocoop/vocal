<?php
/**
 * Single
 *
 * Loop container for single post content
 *
 * @package WordPress
 * @subpackage Foundation, for WordPress
 * @since Foundation, for WordPress 4.0
 */

get_header(); ?>

    <!-- Main Content -->
    <div class="large-12 columns post" role="main">

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
			
				$titulo = get_the_title();
				$titulo = foo_div("","titulo",foo_h($titulo,3));
				$texto = foo_div("","texto", $post->post_content );
				echo foo_div("","large-8 columns imagenes",$titulo . foo_img(foo_featImg()));

				$metalinks = get_post_meta($post->ID,'links_proyecto');
								
				if($metalinks) {
					foreach( $metalinks[0] as $link ) {
						$url = $link["url"];
						$linkLis .= foo_li("","",$url,$url);
					}
					$linkDiv = foo_div("","links",$linkLis);
				}
				
				echo foo_div("","large-4 columns contenido", $texto . $linkDiv );

				
				
			endwhile;
		 endif;
		 ?>

    </div>
    <!-- End Main Content -->
<?php get_footer(); ?>

<script type="text/javascript">


	$(document).ready(function(){	
			var txt = $('.texto');
			var as = txt.find('a img').parent();
			var imgs = txt.find('a img');
			//~ alert(imgs.length);
			imgs.remove();
			as.remove();
			txt.fadeIn();
			
	});
	
</script>
