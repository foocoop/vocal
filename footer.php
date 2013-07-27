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
		
		setup_grid();
		
		var dropdowns = $j(".dropdown");
		
		var callback = function(target) { alert( 'You clicked ' + $(target).attr('id')); }

		// Initialize dropdowns:
		dropdowns.dropdown();
		dropdowns.dropdown({callback:callback});
		dropdowns.dropdown({width:'400px', maxHeight:'180px',callback:callback});
		// Force one open:
		dropdowns.dropdown('hide');
								








		
		
		$j("#selector_img_size input").click(function(){
			var img_size = $j(this).attr('value');			
		});
		
		
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
			
		
		}
		
		var cargar_posts = function() {
		
			url = $j("#url").html();
			var ajaxloader = $j("#ajax-loader-div").html();
			//~ $j("#proyectos").html(ajaxloader);
			//~ $j("#menu_proyectos.hide-for-small").html('');
			
			
			var data = {};
			
			data.action = 'filtrar_proyectos';
			data.categorias = categorias;
			data.disciplinas = disciplinas;
			data.img_size = img_size;
			
			$j.ajax({  
				type: 'POST',  
				url: url+'/wp-admin/admin-ajax.php',  
				data: data, 
				success: function(data, textStatus, XMLHttpRequest){  
					$j("#proyectos").html(data);
				},  
				error: function(MLHttpRequest, textStatus, errorThrown){  
					alert(errorThrown);  
				}  
			});  
			
			data.action = 'filtrar_proyectos_menu';
			$j.ajax({  
					type: 'POST',  
					url: url+'/wp-admin/admin-ajax.php',  
					data: data, 
					success: function(data, textStatus, XMLHttpRequest){  
						$j("#menu_proyectos.hide-for-small").html(data);
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
		var selector_img_size = $j("#selector_img_size input");

		var img_size = $j("#selector_img_size .active").attr('value');
		
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
			
			cargar_posts();		
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
			cargar_posts();		

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
			
			cargar_posts();		

		});
		
		
		selector_img_size.click(function(){ 
			var btn = $j(this);
			btn.siblings().removeClass("active");
			btn.addClass("active");
			img_size = btn.attr('value');
			setup_grid();
			cargar_posts();		

		});
		
		
		
		
		
		
			
			
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
	
	var getClosestValues = function(a, x) {
		var lo, hi;
		for (var i = a.length; i--;) {
			if (a[i] <= x && (lo === undefined || lo < a[i])) lo = a[i];
			if (a[i] >= x && (hi === undefined || hi > a[i])) hi = a[i];
		};
		return [lo, hi];
	}
	
	var num_columnas = function( img_size, width ){
		
		var posibles =[ 1, 2, 3, 4, 6, 12 ];
		
		var rangos = [];
		rangos["L"] = [ 1200, 1000, 800, 600 ];
		rangos["M"] = [ 1200, 1075, 950, 825, 700, 575 ];
		rangos["S"] = [ 1100, 1000, 900, 800, 700, 600 ];

		var rango = rangos[img_size];

		if( typeof(rango)!="undefined")	{
			var closest = getClosestValues( rango, width );
			var offset = posibles.length - rango.length;
			console.log(offset);
			col_num = posibles[ offset + rango.indexOf( closest[0]  ) ];
			return col_num;
		} else 
			return 4;
		
		//~ console.log( closest );
		
		
		
	}
		
	function setup_grid() {
		
		var img_size = $j("#selector_img_size .active").attr('value');


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

		newClass = 'large-' + num_columnas( img_size, width );

	
		proyectos.addClass(newClass);
		
		
	
		
	};

	var resizeTimer;
	
	$j(window).resize(function() {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout( setup_grid, 50);
	});

</script>
			
</html>
