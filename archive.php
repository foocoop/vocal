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
		$img = foo_img( foo_thumb( foo_featImg($post->ID), 300, 300 ) );
		$link = get_permalink();

		$proyecto = foo_link($titulo,$link);
		
		$lis .= foo_li( "","", $proyecto );
		
		array_push( $proyectos , $proyecto  );
		

		$str .= foo_article( array(
			'class' => 'proyecto two columns',
			'header'=> foo_vcenter( foo_h( $titulo, 5) ),
			'content'=> $img
		) );
					
		//~ if( $i % $col_no )
			//~ $proyectos .= foo_close();

		endwhile; endif;
		
		
		
		
		echo foo_div("menu_proyectos","two columns show-for-small",foo_dropdown( $post->id, "opcion", $proyectos));
		echo foo_div("menu_proyectos","two columns hide-for-small", $lis );
		echo foo_div("proyectos","ten columns",$str);
		
		?>	
	
		
		
<!--
		</div>
-->
	


	</div> <!-- end #content -->

<?php get_footer(); ?>
