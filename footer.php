			<footer role="contentinfo">
			
					<div class="twelve columns">

						<div class="row">

							<nav class="ten columns clearfix">
								<?php bones_footer_links(); ?>
							</nav>

							<p class="attribution two columns"><a href="http://google.com" id="link" title="VOCAL">VOCAL</a></p>

						</div>

					</div>
					
			</footer> <!-- end footer -->
		
		</div> <!-- end #container -->
		
		<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		
		<?php wp_footer(); // js scripts are inserted using this function ?>

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
	});
	
	
	function clearClasses(object){
		
		object.removeClass('one');
		object.removeClass('two');
		object.removeClass('three');
		object.removeClass('four');
		object.removeClass('six');
		object.removeClass('twelve');
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
			newClass = 'one';
		else if(width>1050&&width<1200)  
			newClass = 'two';
		else if(width>900&&width<1050)  
			newClass = 'three';
		else if(width>750&&width<=900)  
			newClass = 'four';			
		else if(width>=500&&width<750)  
			newClass = 'six';
		else if(width<500)  
			newClass = 'large-12';

//~ alert(width);

			//~ 
		proyectos.addClass(newClass);
		//~ 
	};

	var resizeTimer;
	
	$j(window).resize(function() {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout( setupGrid, 50);
	});

</script>
			
</html>
