<?php
/**
 * Footer
 *
 * Displays content shown in the footer section
 *
 * @package WordPress
 * @subpackage Foundation, for WordPress
 * @since Foundation, for WordPress 4.0
 */
?>

</div> <!-- #content -->

<!-- End Page -->

<!-- Footer -->
<footer class="row">


</footer>
<!-- End Footer -->

<?php wp_footer(); ?>

</body>


<script type="text/javascript">

	function toggleFullScreen() {
		if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
		(!document.mozFullScreen && !document.webkitIsFullScreen)) {
			if (document.documentElement.requestFullScreen) {  
			document.documentElement.requestFullScreen();  
			} else if (document.documentElement.mozRequestFullScreen) {  
			document.documentElement.mozRequestFullScreen();  
			} else if (document.documentElement.webkitRequestFullScreen) {  
			document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
			}  
		} else {  
			if (document.cancelFullScreen) {  
			document.cancelFullScreen();  
			} else if (document.mozCancelFullScreen) {  
			document.mozCancelFullScreen();  
			} else if (document.webkitCancelFullScreen) {  
			document.webkitCancelFullScreen();  
			}  
		}  
	} 

	$j = jQuery.noConflict();
	
	$j(document).ready(function(){	
		
		setupGrid();
		
		var dropdowns = $j(".dropdown");
		
		var callback = function(target) { alert( 'You clicked ' + $(target).attr('id')); }

		// Initialize dropdowns:
		dropdowns.dropdown();
		dropdowns.dropdown({callback:callback});
		dropdowns.dropdown({width:'400px', maxHeight:'180px',callback:callback});
		// Force one open:
		dropdowns.dropdown('show');


					
	});
	//~ 
	
	function clearClasses(object){
		
		object.removeClass('large-1');
		object.removeClass('large-2');
		object.removeClass('large-3');
		object.removeClass('large-4');
		object.removeClass('large-6');
		object.removeClass('large-12');
	}
		
	function setupGrid() {
		var width = $j(window).width();
			//~ alert(width);	
			
		var new_width = width*0.97;
		var principal = $j('#principal').width( new_width );
		
		principal.children().width(new_width);
		var proyectos = $j('#proyectos .proyecto');
		var newClass;
		clearClasses(proyectos);
//~ 
//~ 
		if(width>=1200)
			newClass = 'large-1';
		else if(width>1050&&width<1200)  
			newClass = 'large-2';
		else if(width>900&&width<1050)  
			newClass = 'large-3';
		else if(width>750&&width<=900)  
			newClass = 'large-4';			
		else if(width>=600&&width<750)  
			newClass = 'large-6';
		else if(width<600)  
			newClass = 'large-12';
			
		proyectos.addClass(newClass);
		
		
		
		
		
		
		
		/*
		CHECKBOXES MENU:
		*/
		
		
		var menuCheckbox = function( object, array ) {
			
			
			var name = object.attr('name');
			var checked = object.is(':checked');
			
			if( checked )
				array.push( name ) ;
			else {
				var index = array.indexOf( name );
				array.splice( index, 1 );
			}
			
			
			var url = $j("#url").html();
			var ajaxloader = $j("#ajax-loader").html();
			
			$j("#proyectos").html(ajaxloader);
			
			
			var data = {};
			
			data.action = 'filtrar_proyectos';
			data.categorias = categorias;
			data.disciplinas = disciplinas;
			
			//~ var post_type  = $j( this ).text();
			$j.ajax({  
				type: 'POST',  
				url: url+'/wp-admin/admin-ajax.php',  
				data: data,  
				success: function(data, textStatus, XMLHttpRequest){  
					console.log(data);

					$j("#proyectos").html(data.posts);
					$j("#menu_proyectos.hide-for-small").html(data.lis);
					
							//~ echo foo_div("menu_proyectos","small-6 large-2 columns show-for-small",foo_dropdown( $post->id, "opcion", $proyectos));
					//~ setupLis();
				},  
				error: function(MLHttpRequest, textStatus, errorThrown){  
					alert(errorThrown);  
				}  
			});  
			
		}
		
		
		var disciplinas = [];
		var categorias = [];
		
		var disciplinasCheckboxes = $j("#disciplinas li input[type=checkbox]");
		var categoriasCheckboxes = $j("#categorías li input[type=checkbox]");
		var todosCheckbox = $j("#checkbox-todos input");
		
		categoriasCheckboxes.click(function(){ 
			var name = $j(this).attr('name');
			var checked = $j(this).is(':checked');
			
			if( checked && ( name == "Todas las Categorías" || name == "All Categories" ) ) {
				
				categorias=[];
				
				$j(this).parent().siblings().find('input').each(function(i){
					$j(this).prop('checked',true);
					var name = $j(this).attr('name');
					categorias.push(name);
				});
				
			}
			menuCheckbox( $j(this) , categorias );				
		});
		
		disciplinasCheckboxes.click(function(){ 
			var name = $j(this).attr('name');
			var checked = $j(this).is(':checked');
			
			if( checked && ( name == "Todas las Disciplinas" || name == "All Disciplines" ) ){
				$disciplinas = [];				

				$j(this).parent().siblings().find('input').each(function(i){
					$j(this).prop('checked',true);
					var name = $j(this).attr('name');
					disciplinas.push(name);
				});

			}

			
			menuCheckbox( $j(this) , disciplinas );				

		});
		
		todosCheckbox.click(function(){ 
			var name = $j(this).attr('name');
			var checked = $j(this).is(':checked');

			if(checked) {
				
				categorias=[];
				
				categoriasCheckboxes.each(function(i){
					$j(this).prop('checked',true);
					var name = $j(this).attr('name');
					categorias.push(name);
				});
			
				$disciplinas = [];				

				disciplinasCheckboxes.each(function(i){
					$j(this).prop('checked',true);
					var name = $j(this).attr('name');
					disciplinas.push(name);
				});

			}
			
			menuCheckbox( $j(this) , disciplinas );				

		});
		
		
		
		
		
		
		
	};

	var resizeTimer;
	
	$j(window).resize(function() {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout( setupGrid, 50);
	});

</script>
			
</html>
