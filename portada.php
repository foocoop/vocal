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

 jQuery(document).ready(function($){
   
   content = $('.content');
   content.show();


   var img = $('.fullscreen img');

   var imgW, imgH;
   
 img.attr( "src", img.attr("src") )
                     .load(function() {
   imgW = this.width;   // Note: $(this).width() will not
   imgH = this.height; // work for in memory images.
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
     }
     else {
       imgWidth = viewport.height / ratio; 
       imgHeight = viewport.height;
     }
     

     img.css({
     width     : imgWidth,
     height    : imgHeight,
     //marginTop : (imgHeight > viewport.height) ? Math.floor((imgHeight - viewport.height) / 2 * -1) : 0
     }); 

     
   }


 $(window).resize(function () {
   resizeImage();

 });
 resizeImage();


 img.fadeIn();



   
 
 });
 
</script>

</html>
