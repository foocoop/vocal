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
}
echo foo_div("texto_portada","content portada large-5  columns", $echo);

endif;
?>
<?php get_footer(); ?>


<script type="text/javascript">
 //~ var $j = jQuery.noConflict();
 
 content = $('.content');
 //~ imgs = content.find('a img');
 //~ alert(imgs);
 //~ imgs.remove();
 //~ imgs.parent().remove();
 //~ 
 content.show();

 $(function() {

   var win = $(window),
   fullscreen = $('#fullscreen'),
   image = fullscreen.find('img'),
   imageWidth = image.width(),
   imageHeight = image.height(),
   imageRatio = imageWidth / imageHeight;

   function resizeImage() {
     var winWidth = win.width(),
     winHeight = win.height(),
     winRatio = winWidth / winHeight;
     
     if(winRatio > imageRatio) {
       image.css({
	 width: winWidth,
	 height: Math.round(winWidth / imageRatio)
       });
     } else {
       image.css({
	 width: Math.round(winHeight * imageRatio),
	 height: winHeight
       });
     }
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
</script>

</html>
