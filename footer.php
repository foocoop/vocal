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
	
	
	var disciplinas = [];
	var categorias = [];
	var img_size;

	var setup_checkboxes = function() {
		
		var checkboxes = $j(':checkbox');

		checkboxes.iCheck({
			checkboxClass: 'icheckbox_vocal',
			increaseArea: '0%' // optional
		});
		
		var disciplinasCheckboxes = $j("#disciplinas li input[type=checkbox]");
		var categoriasCheckboxes = $j("#categorías li input[type=checkbox]");
		var todosCheckbox = $j("#checkbox-todos input");
		var selector_img_size = $j("#selector_img_size input");



		
		categoriasCheckboxes.on('ifChecked', function(){ 
			var name = $j(this).attr('name');
			if( name == "Todas las Categorías" || name == "All Categories" ) {
				categorias=[];
				$j(this).parent().parent().siblings().each(function(i){
					$j(this).iCheck('check');
					var new_name = $j(this).attr('name');
					categorias.push(new_name);
				});
			}
			categorias.push( name );		
			cargar_posts();		
		});
		categoriasCheckboxes.on('ifUnchecked', function(){ 
			var name = $j(this).attr('name');
			var index = categorias.indexOf( name );
			categorias.splice( index, 1 );
			cargar_posts();		
		});

		
		disciplinasCheckboxes.on('ifChecked', function(){ 
			var name = $j(this).attr('name');
			if( name == "Todas las Disciplinas" || name == "All Disciplines" ) {
				disciplinas=[];			
				$j(this).parent().parent().siblings().each(function(i){
					$j(this).iCheck('check');
					var new_name = $j(this).attr('name');
					disciplinas.push(new_name);
				});
			}
			disciplinas.push( name );		
			cargar_posts();		
		});
		disciplinasCheckboxes.on('ifUnchecked', function(){ 
			var name = $j(this).attr('name');
			var index = disciplinas.indexOf( name );
			disciplinas.splice( index, 1 );
			cargar_posts();		
		});
		
		
		todosCheckbox.on('ifChecked', function(){ 
			var name = $j(this).attr('name');
				
			categorias=[];
			
			categoriasCheckboxes.each(function(i){
				//~ $j(this).iCheck('check');
				var name = $j(this).attr('name');
				categorias.push(name);
			});
		
			$disciplinas = [];				

			disciplinasCheckboxes.each(function(i){
				//~ $j(this).iCheck('check');
				var name = $j(this).attr('name');
				disciplinas.push(name);
			});

			cargar_posts();		
		});
		
		
		selector_img_size.click(function(){ 
			var btn = $j(this);
			btn.siblings().removeClass("active");
			btn.addClass("active");
			img_size = btn.attr('value');
			cargar_posts();		
			//~ setup_grid();

		});
		
		
		
		$j(".taxonomias.button").click(function(){
			$j(this).next().show();
		});
		
	
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
				setup_grid();
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
	
	function setup_grid() {
		
		var img_size = $j("#selector_img_size .active").attr('value');


		var width = $j(window).width();
			//~ alert(width);	
			
		var new_width = width*0.97;
		var principal = $j('#principal').width( new_width );
		
		principal.children().width(new_width);
		var proyectos = $j('#proyectos .proyecto');
		var large_class;
		clearClasses(proyectos);
//~ 
//~ 
		var possible =[ 12, 6, 4, 3, 2, 1 ];
		var segments = [ 896, 1024, 1152, 1280, 1368, 1496 ];
		var sizes = [];
		
		sizes["L"] = { options : [ 6, 4, 3 ], 	small_cols : 6 }
		sizes["M"] = { options : [ 4, 3, 2 ],	small_cols : 4 }
		sizes["S"] = { options : [ 3, 2, 1 ], 	small_cols : 3 }

		var size = sizes[ img_size ];
		
		if( typeof( size )!="undefined")	{

			if ( width > segments[ size.options.length - 1 ]) {
				col_num = size.options[ size.options.length - 1 ];
			} else if ( width < segments[ 0 ] ) {
				col_num = size.options[ 0 ];
			}
			else {
				var closest = getClosestValues( segments, width )[0];
				var index;
				if( typeof(closest) == "undefined" ){
					closest = 0;
				}
				var index_segment = segments.indexOf( closest  );

				var index;
				if( index_segment < 0 )
					index = 0;
				else if ( index_segment > size.options.length )
					index = size.options.length - 1;
				else 
					index = index_segment;
				
				col_num = size.options[ index ];
				

			}
			
			large_class = 'large-' + col_num;
			small_class = 'small-' + size.small_cols;
			
			proyectos.addClass( large_class );
			proyectos.addClass( small_class );
			
		} 
		
		

		
		//~ console.log( checkboxes );
		
	};

	var resizeTimer;
	
	$j(window).resize(function() {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout( setup_grid, 50);
	});



				
	$j(document).ready(function(){	
		
		img_size = $j("#selector_img_size .active").attr('value');
		
		setup_grid();
		setup_checkboxes();
	
		$j('.icheckbox_vocal img').attr('width','10px');
		
		$j("#selector_img_size input").click(function(){
			var img_size = $j(this).attr('value');			
		});
		
		//~ $j('.dropdown li label').click(function(e){ e.stopPropagation(); });
		
	}); 
	
	
</script>
			
</html>
