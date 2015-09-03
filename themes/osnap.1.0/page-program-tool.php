<?php
/*
Template Name: Program Obsv.Tool
*/
?>

<?php 
	// get the wp header
	get_header(); 

	// get all of the Advanced Custom Fields for this page	
	$fields = get_fields();
?>



<div id="content" class="row">

	<!-- load the left sidebar widgets -->
	<div class="sidebar left">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Tools Left') ) : ?>    	
		<div class="widget"></div>		
	<?php endif; ?>	
	</div>

	<!-- main content area -->
	<div id="tool-container">
		
		<h2><?php echo $fields['title'] ?></h2>
		<?php if($fields['subtitle']) {
			echo "<h4>".$fields['subtitle']."</h4>";
		}?>	
		
		<!-- get survey in an iframe -->	
		<iframe name="ifr" id="ifr" src="/clients/osnap/survey/index.php/survey/index/sid/512324/lang/en" scrolling="no" frameborder="0"></iframe>
		
		<div id="tool-loading">
			<div id="tool-loading-inner">
				<h3>Loading Program Observation Tool</h3>
				<img src="<?php bloginfo('template_url'); ?>/images/horizontal_loading.gif" /><br/>
			</div>
		</div>
		
	</div>
	
</div>


<script>

	$(function() {
		showLoadingImage('ifr');
	});
	
	// function to show loading image for slow loading elements
	function showLoadingImage(mySlowElement){
		var slowElement = document.getElementById(mySlowElement);
		var loadingDisplay = document.getElementById('tool-loading').style;
		loadingDisplay.display = 'block';
		
		if (slowElement.onload == null) {
			slowElement.onload = function() {
				loadingDisplay.display = 'none';
				resizeIframeToFit();
			};
		}
		return true;
	}
	
	// function to resize iframe
	function resizeIframeToFit(){	
		
		var iframe = document.getElementById('ifr').contentWindow;
		var iHeight = $("#ifr").contents().find('.outerframe').height();
		var newHeight = parseInt(iHeight)+50;
		
		//**set height  
		document.getElementById('ifr').height = newHeight;
		
		// make clicking radio buttons trigger a resize
		$("#ifr").contents().find(".radio").click(function() {resizeIframeToFit();});		
	}	
	
	
</script>


<?php get_footer(); ?>

