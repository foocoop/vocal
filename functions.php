<?php

require_once("cpt/proyecto.php");
require_once("utilidades/funcionesHTML.php");













function remove_menus () {
global $menu;
	$restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'),/*__('Pages'), __('Appearance'),*/ __('Tools'),/* __('Users'), __('Settings'),*/ __('Comments'), __('Plugins'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}
add_action('admin_menu', 'remove_menus');


	
function vocal_main_nav() {
	echo foo_div("menu-grande","vocal_menu hide-for-small row",
		foo_div( "", "two columns",	'<label><input type="checkbox" value="Todos">Todos los proyectos</label>' ) .
		foo_div( "", "two columns",	taxonomyDropdown('disciplina') ) .
		foo_div( "", "two columns",	taxonomyDropdown('category') ) .
		foo_div( "", "two columns",	'' ) .
		foo_div( "imagenes", "two columns",
			'Imágenes: ' .
			'<input type="button" value="S" onclick="cargar_posts()">' .
			'<input type="button" value="M" onclick="cargar_posts()">' .
			'<input type="button" value="L" onclick="cargar_posts()">' 
		) .		
		foo_div( "", "two columns",	'<input type="button" value="Go fullscreen" onclick="toggleFullScreen()">' )
	);
}

function vocal_mobile_nav() {	
	echo foo_div("menu-grande","vocal_menu show-for-small row",
		foo_div( "", "two columns",	taxonomyDropdown('disciplina') ) .
		foo_div( "", "two columns",	taxonomyDropdown('category') ) .
		foo_div( "", "two columns",	'<input type="button" value="Go fullscreen" onclick="toggleFullScreen()">' )
	);
}




function taxonomyDropdown( $tax_name )
{
	
	if( qtrans_getLanguage()=='es' ) {
		$plural = array( 'category'=>"Categorías",  'disciplina'=>"Disciplinas" );
		$todas = "Todas las " . $plural[ $tax_name ];
	}
	else if( qtrans_getLanguage()=='en' ) {
		$plural = array( 'category'=>"Categories",  'disciplina'=>"Disciplines" );
		$todas = "All " . $plural[ $tax_name ];
	}
	
	$taxs = get_terms( $tax_name, array( "hide_empty" => 0 ) );
	$result = '<select id="'.$tax_name.'">';
	
	$result .= '<option value="'.$todas.'">'.$todas."</option>";
	foreach ($taxs as $tax) {
		$nombre = $tax -> name;
		$result .= "<option value=".$nombre.">".$nombre."</option>";
	}
	$result.= "</select>";
	return $result;
}



add_theme_support( 'post-thumbnails' );




?>
