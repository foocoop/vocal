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
  echo foo_div("","large-8 small-12 columns imagenes ", $titulo . $slider );
  
  $metalinks = get_post_meta($post->ID,'links_proyecto');
  
  if($metalinks) {
    foreach( $metalinks[0] as $link ) {
      $url = $link["url"];
      $linkLis .= foo_li("","",$url,$url);
    }
    $linkDiv = foo_div("","links",$linkLis);
  }
  
  echo foo_div("","large-4 small-12 columns contenido", $texto . $linkDiv );
  
  
  $cats =  get_the_category();
  
  if( count($cats)>0 ) {
    
    foreach($cats as $cat) {
      
      $catStr .= foo_li("","cat",$cat->name);
    }
  }

  $discs = get_the_terms( get_the_ID(), "disciplina");

  if( count($discs)>0 ) {
    foreach($discs as $disc) {
      $discStr .= foo_li("","disc",$disc->name);
    }
  }
  
  echo foo_div("cats_on","hidden",$catStr);
  echo foo_div("discs_on","hidden",$discStr);
  
  endwhile;
  endif;
  ?>

</div>
<!-- End Main Content -->
<?php get_footer(); ?>

<script type="text/javascript">

 $j = jQuery.noConflict();

 var slider = $j('.slider');

 var resize_img = function() {


   
   var imgW = $j('.post .imagenes').width();
   var contH = $j('.contenido .texto').height()+ $j('.contenido .links').height() + 30;
   
   
   /* slider.width( imgW );
   slider.children().width( imgW ); */

   var img = slider.find('img');

   if( $j(window).width() > 768 ) {


     slider.width( imgW );
     slider.height( contH );
     slider.children().height( contH );

     
//     img.hide();



     var doc_width = slider.width();
     var doc_height = slider.height();
     // alert("Step 1: getting document size\n\nWidth: "+doc_width+"px\nHeight = "+doc_height+"px");
     var image_width = img.width();
     var image_height = img.height();
     // alert("Step 2: getting image size\n\nWidth: "+image_width+"px\nHeight = "+image_height+"px");
     var image_ratio = image_width/image_height;
     // alert("Step 3: getting image width/height ratio: "+image_ratio);       
     var new_width = doc_width;
     var new_height = Math.round(new_width/image_ratio);
     // alert("Step 4: adapting the image to document width, mantaining the ratio\n\nWidth: "+new_width+"px\nHeight = "+new_height+"px");
     img.width(new_width);
     img.height(new_height);
     if(new_height<doc_height){
       new_height = doc_height;
       new_width = Math.round(new_height*image_ratio);
       // alert("Step 5: the image isn't high enough\n\nAdapting the image to document height, mantaining the ratio\n\nWidth: "+new_width+"px\nHeight = "+new_height+"px");
       img.width(new_width);
       img.height(new_height);
       var width_offset = Math.round((new_width-doc_width)/2);
       // alert("Step 6: moving the image left by "+width_offset+"px to have it centered");
       if( img.offset().left + new_width < doc_width){
         img.width(doc_width);
         img.height( Math.round(doc_width/image_ratio) );
       }


       img.css("left","-"+width_offset+"px");
       
     }

   }
   img.show();
   
   /* img.resizecrop({
   width:imgW,
   height:contH,
   vertical:"middle"
   });
   
   $j('.sliderItem img').fadeIn();
    */
   
  /* 
   var imgW = $j('.post .imagenes').width();
   var slider = $j('.slider');

   slider.width( imgW );
   

   

   if( $j(window).width() > 768 ) {
     
     var contH = $j('.contenido .texto').height()+ $j('.contenido .links').height() + 30;
     
     slider.height( contH );
     
     slider.children().width( imgW );
     slider.children().height( contH );
     slider.children().find('img').height( contH ); 
     slider.children().find('img').css({width: 'auto'});


     $j('.sliderItem img').hide();
     $j('.sliderItem img').resizecrop({
       width:imgW,
       height:contH,
       vertical:"middle"
     });
     $j('.sliderItem img').fadeIn();   

   } else {
     slider.css('min-height','auto');
     slider.children().css('min-height','auto');
     slider.height( $j(window).height() / 1.5  );

   }

*/   
 }
 
 var resizeTimer;
 
 $j(window).resize(function() {
   clearTimeout(resizeTimer);
   resizeTimer = setTimeout( resize_img, 50);
 });





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


    var cats = $j('#cats');
    
    var iframes = $j('iframe');
    var sliderItem = $j('.slider .sliderItem').last();

    iframes.each(
       function(i)
       {
         var iframe = $j(this).detach();
         var item = sliderItem.clone().html( iframe  );
         $j('.sliderContent').append( item );
       }
     );

    resize_img();

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
