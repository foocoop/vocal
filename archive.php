<?php get_header(); ?>
			
	<div id="content" class="clearfix row">
		
					
		<?php
		
		$i=0;
		$col_no = 6;
		$proyectos = array();
		
		if (have_posts()) : while (have_posts()) : the_post();
		//~ 
		//~ $i++;
		//~ if( $i % $col_no )
			//~ $str .= foo_open(""."ten columns row clearfix");

		$titulo = get_the_title();
		$img = foo_img( foo_thumb( foo_featImg($post->ID), 550, 550*0.77 ) );
		$link = get_permalink();

		$proyecto = foo_link($titulo,$link);
		
		$lis .= foo_li( "","", $proyecto );
		
		array_push( $proyectos , $proyecto  );
		

		$str .= foo_article( array(
			'class' => 'proyecto columns',
			'header'=> foo_link(foo_vcenter( foo_h( $titulo, 5) ),$link),
			'content'=> $img
		) );
					
		//~ if( $i % $col_no )
			//~ $proyectos .= foo_close();

		endwhile; endif;
		
		
		
		
		echo foo_div("menu_proyectos","small-6 large-2 columns show-for-small",foo_dropdown( $post->id, "opcion", $proyectos));
		echo foo_div("menu_proyectos","small-6 large-2 columns hide-for-small", $lis );
		echo foo_div("proyectos","large-10 columns",$str);
		
		?>	
	
		
		
<!--
		</div>
-->
	


	</div> <!-- end #content -->

<?php get_footer(); ?>
