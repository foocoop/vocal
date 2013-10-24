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
echo foo_div("texto_portada","content portada large-5  small-10 columns", $echo);

endif;
?>
<?php get_footer(); ?>


<script type="text/javascript">
 //~ var $j = jQuery.noConflict();

 //~ imgs = content.find('a img');
 //~ alert(imgs);
 //~ imgs.remove();
 //~ imgs.parent().remove();
 //~ 
 jQuery(document).ready(function($){
   $(function() {

     content = $('.content');
     content.show();
     var win = $(window),
     fullscreen = $('#fullscreen'),
     image = fullscreen.find('img'),
     imageWidth = image.width(),
     imageHeight = image.height(),
     imageRatio = imageWidth / imageHeight;

     function resizeImage() {

       
       var img =  $('.fullscreen img');
       var doc_width = $j(window).width();
       var doc_height = $j(window).height();
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

       img.fadeIn();


     }

     win.bind({
       load: function() {
         resizeImage();
       },
       resize: function() {
         resizeImage();
       }
     });

   });

 });
 
</script>

</html>
