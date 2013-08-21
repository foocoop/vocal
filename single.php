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
      $texto = foo_div("","texto", apply_filters('the_content', $post->post_content ) );

      $imgs = foo_imgs($post->ID,'full','true');
      
      foreach($imgs as $img ) {
        $items .= foo_div("","sliderItem",foo_img($img));
      }
      
      $slider = foo_div("","slider", foo_div("","sliderContent",$items ) );
      echo foo_div("","large-8 columns imagenes", $titulo . $slider );
      
      $metalinks = get_post_meta($post->ID,'links_proyecto');
      
      if($metalinks) {
	foreach( $metalinks[0] as $link ) {
	  $url = $link["url"];
	  $linkLis .= foo_li("","",$url,$url);
	}
	$linkDiv = foo_div("","links",$linkLis);
      }
      
      echo foo_div("","large-4 columns contenido", $texto . $linkDiv );
      
      

      echo foo_div("hiddendiv","hidden", foo_div("","sliderItem","item") );
      
      
      endwhile;
      endif;
      ?>

    </div>
    <!-- End Main Content -->
<?php get_footer(); ?>

<script type="text/javascript">

 $j = jQuery.noConflict();
 $j(document).ready(
   function()
   {	
    var txt = $j('.texto');
    var as = txt.find('a img').parent();
    var imgs = txt.find('a img');
    //~ alert(imgs.length);
    imgs.remove();
    as.remove();
    txt.fadeIn();



    var iframes = $j('iframe');
    var sliderItem = $j('#hiddendiv .sliderItem');

    iframes.each(
       function(i)
       {
         var iframe = $j(this).detach();
         var item = sliderItem.clone().html( iframe  );
         $j('.sliderContent').append( item );
         
       }
     );

    var imgW = $j('.post .imagenes').width();
    var contH = $j('.contenido .texto').height()+ $j('.contenido .links').height() + 30;
    
    
    var slider = $j('.slider');

    slider.width( imgW );
    slider.height( contH );
    slider.children().width( imgW );
    slider.children().height( contH );
    slider.children().find('img').height( contH );
    slider.children().find('img').width( 'auto' );
    
    slider.mobilyslider({
       content: '.sliderContent', // class for slides container
       children: 'div', // selector for children elements
       transition: 'horizontal', // transition: horizontal, vertical, fade
       animationSpeed: 300, // slide transition speed (miliseconds)
       autoplay: false,
       autoplaySpeed: 3000, // time between transitions (miliseconds)
       pauseOnHover: false, // stop animation while hovering
       bullets: false, // generate pagination (true/false, class: sliderBullets)
       arrows: true, // generate next and previous arrow (true/false, class: sliderArrows)
       arrowsHide: false, // show arrows only on hover
       prev: 'prev', // class name for previous button
       next: 'next', // class name for next button
       animationStart: function(){}, // call the function on start transition
       animationComplete: function(){} // call the function when transition completed
     });
    
    }
 );
	
</script>
