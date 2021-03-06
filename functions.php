
<?php

global $archiveLayout;

/**
 * Functions
 *
 * Core functionality and initial theme setup
 *
 * @package WordPress
 * @subpackage Foundation, for WordPress
 * @since Foundation, for WordPress 4.0
 */

/**
 * Initiate Foundation, for WordPress
 */

if ( ! function_exists( 'foundation_setup' ) ) :

                        function foundation_setup() {

  // Content Width
  if ( ! isset( $content_width ) ) $content_width = 900;

  // Language Translations
  load_theme_textdomain( 'foundation', get_template_directory() . '/languages' );

  // Custom Editor Style Support
  add_editor_style();

  // Support for Featured Images
  add_theme_support( 'post-thumbnails' ); 

  // Automatic Feed Links & Post Formats
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

  // Custom Background
  add_theme_support( 'custom-background', array(
    'default-color' => 'fff',
  ) );

  // Custom Header
  add_theme_support( 'custom-header', array(
    'default-text-color' => '#000',
    'header-text'   => true,
    'height'		=> '200',
    'uploads'       => true,
  ) );

}

add_action( 'after_setup_theme', 'foundation_setup' );

endif;

/**
 * Enqueue Scripts and Styles for Front-End
 */

if ( ! function_exists( 'foundation_assets' ) ) :

                        function foundation_assets() {

  if (!is_admin()) {

    /** 
     * Deregister jQuery in favour of ZeptoJS
     * jQuery will be used as a fallback if ZeptoJS is not compatible
     * @see foundation_compatibility & http://foundation.zurb.com/docs/javascript.html
     */
    //~ wp_deregister_script('jquery');

    // Load JavaScripts
    wp_enqueue_script( 'jquery'); //, get_template_directory_uri() . '/js/foundation.min.js', null, '4.0', true );
    wp_enqueue_script( 'foundation', get_template_directory_uri() . '/js/foundation.min.js', null, '4.0', true );
    wp_enqueue_script( 'modernizr', get_template_directory_uri().'/js/vendor/custom.modernizr.js', null, '2.1.0');
    if ( is_singular() ) wp_enqueue_script( "comment-reply" );

    // Load Stylesheets
    wp_enqueue_style( 'normalize', get_template_directory_uri().'/css/normalize.css' );
    wp_enqueue_style( 'foundation', get_template_directory_uri().'/css/foundation.min.css' );
    wp_enqueue_style( 'app', get_stylesheet_uri(), array('foundation') );

    // Load Google Fonts API
    wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300' );
    
  }

}

add_action( 'wp_enqueue_scripts', 'foundation_assets' );

endif;

/**
 * Initialise Foundation JS
 * @see: http://foundation.zurb.com/docs/javascript.html
 */

if ( ! function_exists( 'foundation_js_init' ) ) :

                        function foundation_js_init () {
  //~ echo '<script>$(document).foundation();</script>';
  echo '<script>jQuery(document).foundation();</script>';

}

add_action('wp_footer', 'foundation_js_init', 50);

endif;

/**
 * ZeptoJS and jQuery Fallback
 * @see: http://foundation.zurb.com/docs/javascript.html
 */

if ( ! function_exists( 'foundation_comptability' ) ) :

                        function foundation_comptability () {

  echo "<script>";
  echo "document.write('<script src=' +";
  echo "('__proto__' in {} ? '" . get_template_directory_uri() . "/js/vendor/zepto" . "' : '" . get_template_directory_uri() . "/js/vendor/jquery" . "') +";
  echo "'.js><\/script>')";
  echo "</script>";

}

add_action('wp_footer', 'foundation_comptability', 10);

endif;

/**
 * Register Navigation Menus
 */

if ( ! function_exists( 'foundation_menus' ) ) :

                        // Register wp_nav_menus
                        function foundation_menus() {

  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu', 'foundation' )
    )
  );
  
}

add_action( 'init', 'foundation_menus' );

endif;

if ( ! function_exists( 'foundation_page_menu' ) ) :

                        function foundation_page_menu() {

  $args = array(
    'sort_column' => 'menu_order, post_title',
    'menu_class'  => 'large-12 columns',
    'include'     => '',
    'exclude'     => '',
    'echo'        => true,
    'show_home'   => false,
    'link_before' => '',
    'link_after'  => ''
  );

  wp_page_menu($args);

}

endif;

/**
 * Navigation Menu Adjustments
 */

// Add class to navigation sub-menu
class foundation_navigation extends Walker_Nav_Menu {

  function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown\">\n";
  }

  function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
    $id_field = $this->db_fields['id'];
    if ( !empty( $children_elements[ $element->$id_field ] ) ) {
      $element->classes[] = 'has-dropdown';
    }
    Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }
}

/**
 * Create pagination
 */

if ( ! function_exists( 'foundation_pagination' ) ) :

                        function foundation_pagination() {

  global $wp_query;

  $big = 999999999;

  $links = paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'prev_next' => true,
    'prev_text' => '&laquo;',
    'next_text' => '&raquo;',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $wp_query->max_num_pages,
    'type' => 'list'
  )
                          );

  $pagination = str_replace('page-numbers','pagination',$links);

  echo $pagination;

}

endif;

/**
 * Register Sidebars
 */

if ( ! function_exists( 'foundation_widgets' ) ) :

                        function foundation_widgets() {

  // Sidebar Right
  register_sidebar( array(
    'id' => 'foundation_sidebar_right',
    'name' => __( 'Sidebar Right', 'foundation' ),
    'description' => __( 'This sidebar is located on the right-hand side of each page.', 'foundation' ),
    'before_widget' => '<div>',
    'after_widget' => '</div>',
    'before_title' => '<h5>',
    'after_title' => '</h5>',
  ) );

  // Sidebar Footer Column One
  register_sidebar( array(
    'id' => 'foundation_sidebar_footer_one',
    'name' => __( 'Sidebar Footer One', 'foundation' ),
    'description' => __( 'This sidebar is located in column one of your theme footer.', 'foundation' ),
    'before_widget' => '<div class="large-3 columns">',
    'after_widget' => '</div>',
    'before_title' => '<h5>',
    'after_title' => '</h5>',
  ) );

  // Sidebar Footer Column small-6 large-2
  register_sidebar( array(
    'id' => 'foundation_sidebar_footer_small-6 large-2',
    'name' => __( 'Sidebar Footer small-6 large-2', 'foundation' ),
    'description' => __( 'This sidebar is located in column small-6 large-2 of your theme footer.', 'foundation' ),
    'before_widget' => '<div class="large-3 columns">',
    'after_widget' => '</div>',
    'before_title' => '<h5>',
    'after_title' => '</h5>',
  ) );

  // Sidebar Footer Column Three
  register_sidebar( array(
    'id' => 'foundation_sidebar_footer_three',
    'name' => __( 'Sidebar Footer Three', 'foundation' ),
    'description' => __( 'This sidebar is located in column three of your theme footer.', 'foundation' ),
    'before_widget' => '<div class="large-3 columns">',
    'after_widget' => '</div>',
    'before_title' => '<h5>',
    'after_title' => '</h5>',
  ) );

  // Sidebar Footer Column Four
  register_sidebar( array(
    'id' => 'foundation_sidebar_footer_four',
    'name' => __( 'Sidebar Footer Four', 'foundation' ),
    'description' => __( 'This sidebar is located in column four of your theme footer.', 'foundation' ),
    'before_widget' => '<div class="large-3 columns">',
    'after_widget' => '</div>',
    'before_title' => '<h5>',
    'after_title' => '</h5>',
  ) );

}

add_action( 'widgets_init', 'foundation_widgets' );

endif;

/**
 * Custom Avatar Classes
 */

if ( ! function_exists( 'foundation_avatar_css' ) ) :

                        function foundation_avatar_css($class) {
  $class = str_replace("class='avatar", "class='author_gravatar left ", $class) ;
  return $class;
}

add_filter('get_avatar','foundation_avatar_css');

endif;

/**
 * Custom Post Excerpt
 */

if ( ! function_exists( 'foundation_excerpt' ) ) :

                        function foundation_excerpt($text) {
  global $post;
  if ( '' == $text ) {
    $text = get_the_content('');
    $text = apply_filters('the_content', $text);
    $text = str_replace('\]\]\>', ']]&gt;', $text);
    $text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
                $text = strip_tags($text, '<p>');
                $excerpt_length = 80;
                $words = explode(' ', $text, $excerpt_length + 1);
                if (count($words)> $excerpt_length) {
                        array_pop($words);
                        array_push($words, '<br><br><a href="'.get_permalink($post->ID) .'" class="button secondary small">' . __('Continue Reading', 'foundation') . '</a>');
                        $text = implode(' ', $words);
                }
        }
        return $text;
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'foundation_excerpt');

endif;

/** 
 * Comments Template
 */

if ( ! function_exists( 'foundation_comment' ) ) :

function foundation_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
  <p><?php _e( 'Pingback:', 'foundation' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'foundation' ), '<span>', '</span>' ); ?></p>
  <?php
  break;
  default :
    global $post;
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment">
      <header>
	<?php
	echo "<span class='th alignleft' style='margin-right:1rem;'>";
	echo get_avatar( $comment, 44 );
	echo "</span>";
	printf( '%2$s %1$s',
	       get_comment_author_link(),
	       ( $comment->user_id === $post->post_author ) ? '<span class="label">' . __( 'Post Author', 'foundation' ) . '</span>' : ''
	       );
	printf( '<br><a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
	       esc_url( get_comment_link( $comment->comment_ID ) ),
	       get_comment_time( 'c' ),
	       sprintf( __( '%1$s at %2$s', 'foundation' ), get_comment_date(), get_comment_time() )
	       );
	?>
      </header>

      <?php if ( '0' == $comment->comment_approved ) : ?>
	<p><?php _e( 'Your comment is awaiting moderation.', 'foundation' ); ?></p>
      <?php endif; ?>

      <section>
	<?php comment_text(); ?>
      </section><!-- .comment-content -->

      <div class="reply">
	<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'foundation' ), 'after' => ' &darr; <br><br>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

      </div>
    </article>
    <?php
    break;
    endswitch;
    }
    endif;

    /**
     * Remove Class from Sticky Post
     */

    if ( ! function_exists( 'foundation_remove_sticky' ) ) :

                            function foundation_remove_sticky($classes) {
      $classes = array_diff($classes, array("sticky"));
      return $classes;
    }

    add_filter('post_class','foundation_remove_sticky');

    endif;

    /**
     * Custom Foundation Title Tag
     * @see http://codex.wordpress.org/Plugin_API/Filter_Reference/wp_title
     */

    function foundation_title( $title, $sep ) {
      global $paged, $page;

      if ( is_feed() )
      return $title;

      // Add the site name.
      $title .= get_bloginfo( 'name' );

      // Add the site description for the home/front page.
      $site_description = get_bloginfo( 'description', 'display' );
      if ( $site_description && ( is_home() || is_front_page() ) )
      $title = "$title $sep $site_description";

      // Add a page number if necessary.
      if ( $paged >= 2 || $page >= 2 )
      $title = "$title $sep " . sprintf( __( 'Page %s', 'foundation' ), max( $paged, $page ) );

      return $title;
    }

    add_filter( 'wp_title', 'foundation_title', 10, 2 );

    /**
     * Retrieve Shortcodes
     * @see: http://fwp.drewsymo.com/shortcodes/
     */

    $foundation_shortcodes = trailingslashit( get_template_directory() ) . 'inc/shortcodes.php';

    if (file_exists($foundation_shortcodes)) {
      require( $foundation_shortcodes );
    }





    /************************************
    VOCAL: 
     ************************************/






    require_once("cpt/proyecto.php");
    require_once("cpt/metabox.php");
    require_once("footilities/funcionesHTML.php");


    
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

      $todos = foo_link( foo_div("todos","button","Proyectos"), site_url() . '/?post_type=proyecto' );
    
      /*
      $tax = taxonomyDropdown('disciplina');
      $tax .= taxonomyDropdown('category');
      */

      $disc = taxonomyDropdown('disciplina');
      $cats .= taxonomyDropdown('category');

      $sel_img = foo_div("","titulo",'Imágenes:');
      /* $sel_imgs = foo_link( '<img id="S" src="'. themeDir() . '/img/imgbtns/s.png"/>', "#"); */
      $sel_imgs .= foo_link( '<img id="M" class="active" src="'. themeDir() . '/img/imgbtns/m.png"/>', "#");
      $sel_imgs .=  foo_link( '<img id="L" src="'. themeDir() . '/img/imgbtns/l.png"/>', "#");
      $sel_img .= foo_div("","imagenes", $sel_imgs );

      $full = foo_link( foo_div("full","button","Pantalla Completa"),"#","toggleFullScreen()");
      
      $menu = foo_div( "checkbox-todos", "small-6 large-2 columns", $todos  );

      /*
      $menu .= foo_div("taxonomias","small-12 large-4 columns", $tax);
       */
      
      $taxs = foo_div( "disciplinas_menu", "taxonomia", $disc );//"taxonomias small-6 large-2 columns", $disc);
      $taxs .= foo_div( "categorias_menu", "taxonomia", $cats );//"taxonomias small-6 large-2 columns", $cats);

      $menu .= foo_div("taxonomias", "large-4 columns", $taxs);
      
      /* $menu .= foo_div("taxonomias","small-6 large-2 columns", taxonomyDropdown('disciplina') );
      $menu .= foo_div("taxonomias","small-6 large-2 columns", taxonomyDropdown('category') ); */

      $menu .= foo_div( "selector_img_size", "large-2 small-6 columns", $sel_img );
      $qtrans = "";
      
      if (function_exists('qtrans_generateLanguageSelectCode') ) {
        ob_start();
        qtrans_generateLanguageSelectCode('text');
        $qtrans = ob_get_clean();        
        
        $menu .= foo_div( "qtrans", "small-6 large-2 columns", $qtrans );
      }
    
      $menu .= foo_div( "boton_fullscreen", "hide-for-small large-2 columns", $full );

      echo foo_div("menu-grande","vocal_menu row", $menu );
    }
    

    
    function vocal_portada_nav() {
      echo foo_div("menu-grande","vocal_menu hide-for-small row",
      

		   foo_div( "", "small-6 large-2 columns",	'' ) .
		            foo_div( "", "small-6 large-2 columns",	'' ) .
		                     foo_div( "", "small-6 large-2 columns",	'' ) .
		                              foo_div( "", "small-6 large-2 columns",	'' ) .
		                                       foo_div( "", "small-6 large-2 columns",	'' ) .
		                                                foo_div( "full_portada", "small-6 large-2 columns",	'<input type="button" value="Pantalla Completa" onclick="toggleFullScreen()">' )
	           );
    }
/*
    function vocal_mobile_nav() {	
	                         echo foo_div("menu-grande","vocal_menu show-for-small row",
		                              foo_div( "", "small-6 large-2 columns",	taxonomyDropdown('disciplina') ) .
		                                                                                         foo_div( "", "small-6 large-2 columns",	taxonomyDropdown('category') ) .
		                                                                                                                                                         foo_div( "", "small-6 large-2 columns",	'<input type="button" value="Go fullscreen" onclick="toggleFullScreen()">' )
	                                      );
                                 }
*/



    function taxonomyDropdown( $tax_name )
    {
      
      if( qtrans_getLanguage()=='es' ) {
	$plural = array( 'category'=>"Categorías",  'disciplina'=>"Disciplinas" );
	$todas = "Todas";// las " . $plural[ $tax_name ];
      }
      else if( qtrans_getLanguage()=='en' ) {
	$plural = array( 'category'=>"Categories",  'disciplina'=>"Disciplines" );
	$todas = "All";// . $plural[ $tax_name ];
      }
      
      $taxs = get_terms( $tax_name, array( "hide_empty" => true, "exclude"=>array(1) ) );
      //~ $result = '<select id="'.$tax_name.'">';
      
      //$opciones .= foo_li( "", "checkbox", '<input type="checkbox" id="'.$todas.'" name="'.$todas.'"><label for="'.$nombre.'">'.$todas.'</label>');
      foreach ($taxs as $tax) {
	$nombre = $tax -> name;
        $opciones .=  foo_li( "", "checkbox", '<input type="checkbox" id="'.$nombre.'" name="'.$nombre.'"><label for="'.$nombre.'">' . $nombre . '</label>' );
      }
      //~ $opciones.= "</select>";
      
      
      
      
      $titulo .= '<div class="button" '
               //. 'data-dropdown="'
	       //. strtolower( $plural[$tax_name] ).'">'
               .'>'
			   . foo_div("","titulo", $plural[ $tax_name ] )
				    . foo_div("","img", foo_img( themeDir() . '/img/flechaAbajo.png' ) )
				                                         . '</div>';
      
      
      //~ $titulo .= ;
      
      $dropdown = $titulo
		. '<div id="' . strtolower( $plural[$tax_name] ) 
                                          . '" class="dropdown">'
				          . $opciones . '</div>';

      $dropdown = foo_div( "", "dropdown_container", $dropdown );
      
      return $dropdown;
      
    }
    add_theme_support( 'post-thumbnails' );







    function filtrar_proyectos(){  
	                         global $post;
	                         //~ 
	                         $categorias = $_POST['categorias'];
	                         $disciplinas = $_POST['disciplinas'];
	                         $img_size = $_POST['img_size'];

	                         $categoriasID = array();
	                         $disciplinasID = array();
	                         $taxQuery = array();

	                         if( count( $categorias ) > 0){
	foreach($categorias as $c ) {
	  $id = get_term_by('name', $c, 'category')->term_id;
	  if($id)
	  array_push($categoriasID, $id  );
	}
	array_push( $taxQuery, 
		   array(
	    'taxonomy' => 'category',
	    'field' => 'id',
	    'terms' => $categoriasID
	  )
		   );
      } 
	                         
	                         if( count( $disciplinas ) > 0){
	foreach($disciplinas as $c ) {
	  $id = get_term_by('name', $c, 'disciplina')->term_id;
	  if($id)
	  array_push($disciplinasID, $id  );
	}
	array_push( $taxQuery, 
		   array(
	    'taxonomy' => 'disciplina',
	    'field' => 'id',
	    'terms' => $disciplinasID
	  )
		   );
      } 

	                         if($taxQuery)
		                 $args = array(
	'post_type' => 'proyecto',
	'tax_query' => $taxQuery
      );
	                         else
		                 $args = array(
	'post_type' => 'proyecto'
      );	
	                         
	                         wp_reset_query();
	                         $query = new WP_Query( $args);
	                         $archiveLayouts = array(
	array(
	  'large'=> 1,
	  'medium'=> 2,
	),
	array(
	  'large'=> 1,
	  'medium'=> 0,
	)
      );


	                         $current_post = 0;
	                         $end = "";


	                         $posts_per_page = $query->found_posts;

	                         while ( $query->have_posts() ) : 
	                                                    $query -> the_post();
		                 $current_post++;
		                 if( $current_post == $posts_per_page){
	$end = " end";
      }
		                 $titulo = get_the_title();
		                 if($img_size == "L")
                                 $img = foo_img( foo_thumb( foo_featImg($post->ID), 600,600*0.77, 40 ) );
		                 if($img_size == "M")
                                 $img = foo_img( foo_thumb( foo_featImg($post->ID), 300,300*0.77, 40 ) );
		                 if($img_size == "S")
                                 $img = foo_img( foo_thumb( foo_featImg($post->ID), 150,150*0.77, 40 ) );
		                 $link = get_permalink();
		                 $proyecto = foo_link($titulo,$link);
		                 $lis .= foo_li( "","", $proyecto );

                                 if( rand(0, 10) < 3 ) {
        $postStr .= foo_article( array(
          'class' => 'proyecto columns' . $end,
          'header'=> '',
          'content'=>''
        ) );
      }


                                 
                                 $postStr .= foo_article( array(
        'class' => 'proyecto columns ' . $img_size . $end,
	'header'=> foo_link(foo_vcenter( foo_h( $titulo, 5) ),$link),
	'content'=> $img
      ) );
	                         endwhile;


	                         //~ $arr2json = array(
		                 //~ "posts" => $postStr,
		                 //~ "lis" => $lis,	
	                         //~ );

	                         //~ header("Content-Type: application/json");
	                         //~ $json = json_encode($arr2json);
	                         die( $postStr );

	                         //~ var_dump(in_array('Todas las Categorías',$categorias) );
	                         //~ die("...");

                                 }
    add_action( 'wp_ajax_nopriv_filtrar_proyectos', 'filtrar_proyectos' );  
    add_action( 'wp_ajax_filtrar_proyectos', 'filtrar_proyectos' );  


    function filtrar_proyectos_menu(){  
	                              global $post;
	                              //~ 
	                              $categorias = $_POST['categorias'];
	                              $disciplinas = $_POST['disciplinas'];
	                              
	                              $categoriasID = array();
	                              $disciplinasID = array();
	                              
	                              $taxQuery = array();
	                              
	                              if( count( $categorias ) > 0){
	foreach($categorias as $c ) {
	  $id = get_term_by('name', $c, 'category')->term_id;
	  if($id)
	  array_push($categoriasID, $id  );
	}
	array_push( $taxQuery, 
		   array(
	    'taxonomy' => 'category',
	    'field' => 'id',
	    'terms' => $categoriasID
	  )
		   );
      } 
	                              
	                              if( count( $disciplinas ) > 0){
	foreach($disciplinas as $c ) {
	  $id = get_term_by('name', $c, 'disciplina')->term_id;
	  if($id)
	  array_push($disciplinasID, $id  );
	}
	array_push( $taxQuery, 
		   array(
	    'taxonomy' => 'disciplina',
	    'field' => 'id',
	    'terms' => $disciplinasID
	  )
		   );
      } 
	                              if($taxQuery)
		                      $args = array(
	'post_type' => 'proyecto',
	'tax_query' => $taxQuery
      );
	                              else
		                      $args = array(
	'post_type' => 'proyecto'
      );	
	                              wp_reset_query();

	                              //$args =array('post_type'=>array('proyecto','exposicion','residencia','eco_bar','publicacion','pabellon'),'order_by'=>'rand','destacada'=>'inicio');
	                              $query = new WP_Query( $args);

	                              while ( $query->have_posts() ) : 
	                                                         $query -> the_post();
		                      $titulo = get_the_title();
		                      $link = get_permalink();

		                      $proyecto = foo_link($titulo,$link);
		                      
		                      $lis .= foo_li( "","", $proyecto );
		                      
		                      

	                              endwhile;

	                              die( $lis );

                                      }
    add_action( 'wp_ajax_nopriv_filtrar_proyectos_menu', 'filtrar_proyectos_menu' );  
    add_action( 'wp_ajax_filtrar_proyectos_menu', 'filtrar_proyectos_menu' );  








    ?>
