<?php
/*
Template Name: Portada
 */

get_header(); 

if(have_posts() ) : the_post;

$page = get_page_by_title( 'Portada' );
$content = foo_filter($post->post_content,'content');
$images="";
$imagenes = foo_imgs( $post->ID , 'full' );

//~ foreach ($imagenes as $imagen) {
//~ $images.=foo_img($imagen[0]);
//~ }

if(count($imagenes)>0) {
  $imgurl = NULL;
  while ( $imgurl == NULL ) {
    $index = array_rand( $imagenes );
    $imgurl = $imagenes[ $index ];
  }

  $image = foo_img( $imgurl );
}

$content = foo_strip(foo_strip($content,'img'),'a');

if( qtrans_getLanguage() == "es" )
$texto = "Ir al sitio";
else if( qtrans_getLanguage() == "en" )
$texto = "Go to Site";	

$flecha = foo_img( themeDir() . "/img/flecha.png" );

$linkSitio = foo_div(  "entrar", "", foo_div("","flecha", $flecha) . $texto, get_post_type_archive_link("proyecto"));
$echo .= foo_div( "", "", $content .  $linkSitio );

if($image) {
  echo foo_div("","fullscreen",$image);
  echo foo_div("","fullscreen_hidden",$image);
}

$echo = foo_div("texto_portada","content portada large-5  small-10 columns", $echo);

echo $echo; 

endif;


get_footer(); ?>


<script type="text/javascript">

 jQuery(document).ready(function($){
   
   content = $('.content');
   content.show();


   var img = $('.fullscreen img');

   var imgW, imgH;
   
   img.attr( "src", img.attr("src") )
                       .load(function() {
     imgW = this.width;   // Note: $(this).width() will not
     imgH = this.height; // work for in memory images.
     resizeImage();
   });
   
   
   var resizeImage = function() {
     console.log("rsz");

     
     var win = $(window);
     var viewport = {
       width   : win.width(),
       height : win.height()
     };
     
     var ratio     = imgH / imgW ;
     
     var imgHeight, imgWidth;
     
     
     if(  viewport.width >= viewport.height ) {
       
       imgWidth = viewport.width;
       imgHeight = Math.floor(viewport.width * ratio);


       if( imgHeight >= viewport.height ) {
         marginTop = ( imgHeight - viewport.height ) / 2;
         marginTop *= -1;
       } else {
         imgHeight = viewport.height;
         imgWidth = viewport.height / ratio; 
         marginTop = 0;
       }
       marginLeft = 0; 
     }
     else {
       
       imgWidth = viewport.height / ratio; 
       imgHeight = viewport.height;
       marginTop = 0;
       marginLeft = 0;
       
       if( imgWidth >= viewport.width ) {
         marginLeft = ( imgWidth - viewport.width ) / 2;
         marginLeft *= -1;
       } else {
         imgWidth = viewport.width;
         imgHeight = Math.floor(viewport.width * ratio);
         marginLeft = 0;
       }
     }
     

     img.css({
       width     : imgWidth,
       height    : imgHeight,
       marginTop : marginTop,
       marginLeft : marginLeft
       //marginTop : (imgHeight > viewport.height) ? Math.floor((imgHeight - viewport.height) / 2 * -1) : 0
     }); 

     
   }


   $(window).resize(function () {
     resizeImage();

   });
   resizeImage();


   img.fadeIn();

   resizeImage();


   $j('#menu-grande > div').css({opacity:0 });
   $j('#menu-grande #qtrans').css({opacity:1});
   $j('#menu-grande #boton_fullscreen').css({opacity:1});
   
 });
 
</script>

</html>
