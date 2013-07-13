<?php
/* Bones Proyecto Type Example
This page walks you through creating 
a Proyecto type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a seperate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/


// let's create the function for the custom type
function proyecto() { 
	// creating (registering) the custom type 
	register_post_type( 'proyecto', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this Proyecto
		array('labels' => array(
			'name' => __('Proyectos', 'Proyecto general name'), /* This is the Title of the Group */
			'singular_name' => __('Proyecto', 'Proyecto singular name'), /* This is the individual type */
			'add_new' => __('Add New', 'proyecto type item'), /* The add new menu item */
			'add_new_item' => __('Añadir Proyecto'), /* Add New Display Title */
			'edit' => __( 'Edit' ), /* Edit Dialog */
			'edit_item' => __('Editar Proyectos'), /* Edit Display Title */
			'new_item' => __('Proyecto Nuevo'), /* New Display Title */
			'view_item' => __('Ver Proyecto'), /* View Display Title */
			'search_items' => __('Buscar Proyecto'), /* Search Custom Type Title */ 
			'not_found' =>  __('Nothing found in the Database.'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( '' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the Proyecto type menu */
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'sticky'),
			'has_archive' => true	 	) /* end of options */
	); /* end of register Proyecto */
	
	/* this ads your post categories to your Proyecto type */
	register_taxonomy_for_object_type('category', 'proyecto');
	/* this ads your post tags to your Proyecto type */
	//~ register_taxonomy_for_object_type('post_tag', 'proyecto');
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'proyecto');
	
	
	//~ function add_links_metabox() {
	    //~ add_meta_box('proyecto_link', 'Link Externo', 'proyecto_link', 'proyecto');
	//~ }
//~ 

	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add Disciplina (these act like categories)
    register_taxonomy( 'disciplina', 
    	array('proyecto'), /* if you change the name of register_post_type( 'proyecto', then you have to change this */
    	array('hierarchical' => true,     /* if this is true it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Disciplina' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Disciplina' ), /* single taxonomy name */
    			'search_items' =>  __( 'Buscar Disciplina' ), /* search title for taxomony */
    			'all_items' => __( 'Todas las Disciplinas' ), /* all title for taxonomies */
    			'parent_item' => __( 'Disciplina Superior' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Disciplina Superior:' ), /* parent taxonomy title */
    			'edit_item' => __( 'Editar Disciplina' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Actualizar Disciplina' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Añadir Disciplinas' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'Nombre de disciplina nueva' ) /* name title for taxonomy */
    		),
    		'show_ui' => true,
    		'query_var' => true,
    	)
    );   
    
	

?>
