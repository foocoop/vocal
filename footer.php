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

	//~ $ = jQuery.noConflict();
	
	$(document).ready(function(){	
			setupGrid();
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
		var width = $(window).width();
			//~ alert(width);	
			
		var new_width = width*0.97;
		var principal = $('#principal').width( new_width );
		
		principal.children().width(new_width);
		var proyectos = $('#proyectos .proyecto');
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
		
	};

	var resizeTimer;
	
	$(window).resize(function() {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout( setupGrid, 50);
	});

</script>
			
</html>
