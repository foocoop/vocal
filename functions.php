<?php
/*
Author: Foostoodio
*/

function makeDiv($id="",$class="", $content="", $link=""){
	$str = '<div';
		if($id!="") { 		$str .= ' id="'.$id.'"';	}
		if($class!="") { 	$str .= ' class="'.$class.'"'; }

	$str .= '>';

		if($link!="") { 	$str .= '<a href="'.$link.'">';	}
		if($content!="") { 	$str .= $content;	}
		if($link!="") {		$str .= '</a>';	}
	
  $str .= '</div>';
	
	return $str;
}



function makeUl($id="",$class="", $content="", $link=""){
  $str = '<ul';
    if($id!="") {     $str .= ' id="'.$id.'"';  }
    if($class!="") {  $str .= ' class="'.$class.'"'; }

  $str .= '>';

    if($link!="") {   $str .= '<a href="'.$link.'">'; }
    if($content!="") {  $str .= $content; }
    if($link!="") {   $str .= '</a>'; }
  $str .= '</ul>';
  
  return $str;
}
      


function makeLi($id="",$class="", $content="", $link=""){
  $str = '<li';
    if($id!="") {     $str .= ' id="'.$id.'"';  }
    if($class!="") {  $str .= ' class="'.$class.'"'; }

  $str .= '>';

    if($link!="") {   $str .= '<a href="'.$link.'">'; }
    if($content!="") {  $str .= $content; }
    if($link!="") {   $str .= '</a>'; }
  $str .= '</li>';
  
  return $str;
}
      


function makeImg($src=""){
	if($src!="") {
  		$str = '<img src="'.$src.'">';
	}

	return $str;
}

function startDiv($id="",$class=""){
  $str = '<div';
    if($id!="") {     $str .= ' id="'.$id.'"';  }
    if($class!="") {  $str .= ' class="'.$class.'"'; }

  $str .= '>';
  
  return $str;
}



function closeDiv(){
  $str .= '</div>';
  
  return $str;
}


function makeTextDiv($content="", $link="", $align="justify"){
	
		if($link!="") { 	$str .= '<a href="'.$link.'">';	}
		if($content!="") { 	
			$str .= '<div class="text_table"><div class="text_container"><div class="vcenter_text '.$align.'">';
				$str .= $content;
			$str .= '</div></div></div>';
		}
		if($link!="") {		$str .= '</a>';	}
	
	return $str;
}


function makeTitleDiv($content="", $link="", $align="justify"){
  
    if($link!="") {   $str .= '<a href="'.$link.'">'; }
    if($content!="") {  
      $str .= makeDiv("","div_titulo",
                makeDiv("","text_table",
                  makeDiv("","text_container",
                      makeDiv("","vcenter_text ".$align,$content )
                  )
                )
              );
    }
    if($link!="") {   $str .= '</a>'; }
  
  return $str;
}


function makeBannerDiv($content="", $link="", $align="justify"){
  
    if($link!="") {   $str .= '<a href="'.$link.'">'; }
    if($content!="") {  
      $str .= makeDiv("","div_banner",
                makeDiv("","text_table",
                  makeDiv("","text_container",
                      makeDiv("","vcenter_text ".$align,$content )
                  )
                )
              );
    }
    if($link!="") {   $str .= '</a>'; }
  
  return $str;
}

function makeScrollDiv($content){
  $str .= '<div class="scroll_hide"><div class="scroller">';
    $str .= $content;
  $str .= '</div></div>';
  
  return $str;
}


function makeLink($content="",$url="",$onclick=""){
	if($url=="") $url = "#";
  $str = "";
  $str = '<a href="'.$url.'"';


  if($onclick!="") {    
    $str .= ' onclick="'.$onclick.'"';
  }

  $str .= '>';

  $str .= $content;

  $str .= '</a>';

  return $str;

}

function get_images( $eventoID, $size = 'thumbnail') {
  
  $photos = get_children( array('post_parent' => $eventoID, 'post_status' => 'null', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC') );
  
  $results = array();

  if ($photos) {
    foreach ($photos as $photo) {
      // get the correct image html for the selected size
      $results[] = wp_get_attachment_image_src($photo->ID, $size);
    }
  }

  return $results;
}

function disciplineDropdown()
{
  $taxs = get_categories();
  $result = "<select>";
  foreach ($taxs as $tax) {
    $result.="<option value=".$tax.">".$tax."</option>";
  }
  $result.= "</select>";
  return $result;
}

function categoryDropdown()
{
  $taxonomias = get_taxonomies(array('name'=>'disciplinas'));
  $result = "<select>";
  foreach ($taxonomias as $tax) {
    $result.="<option value=".$tax.">".$tax."</option>";
  }
  $result.= "</select>";
  return $result;
}

function disciplinas_init() {
  // create a new taxonomy
  register_taxonomy(
    'disciplinas',
    'post',
    array(
      'label' => __( 'Disciplinas' ),
      'rewrite' => array( 'slug' => 'disciplina' )
    )
  );
}
add_action( 'init', 'disciplinas_init' );

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'proyecto',
    array(
      'labels' => array(
        'name' => __( 'Proyectos' ),
        'singular_name' => __( 'Proyecto' )
      ),
    'public' => true,
    'has_archive' => true,
    )
  );
  add_post_type_support('proyecto',array('title','editor','excerpt','thumbnail','custom-fields'));
}

add_theme_support( 'post-thumbnails' );
?>