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
?>