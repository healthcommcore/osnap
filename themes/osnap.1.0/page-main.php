<?php
/*
Template Name: Main Page
*/
?>

<?php 
	// get the wp header
	get_header(); 

	// get all of the Advanced Custom Fields for this page	
	$fields = get_fields();
?>


<div id="content" class="row">

	<!-- SLIDE SHOW -->
	<div id="main-slideshow">
		<ul class="bjqs">
		
			<?php  	
			foreach ($fields['slides'] as $slide) { 	
				// get the permalink for the slide post
				$slide_url = get_permalink( $slide->ID );
				// get all fields for the specific slide post
				$slide_fields = get_fields($slide->ID);
			?>
			
			<li>
				<div class="slide7" >				
					<img src="<?php echo $slide_fields['background_image']; ?>"/>
					<div class="gray-bg"></div>
					<div class="slide7-text">
						<h1><?php echo $slide_fields['common_title']; ?></h1>
						<h2><?php echo $slide_fields['title']; ?></h2>
						<p><?php echo $slide_fields['text']; ?></p>
						<span>
							<a href="<?php echo site_url().$slide_fields['link_url']; ?>"> 
							<?php echo $slide_fields['link_text']; ?></a>
						</span>						
					</div>				
				</div>				
			</li>
			
			<?php  	
			} // end foreach
			?>		
			
		</ul>
	</div>
	
	<!-- BIG BOTTONS TO THE RIGHT OF SLIDE SHOW -->
	<div id="main-bigbuttons">
		<div id="main-bigbutton1">
			<h1><?php echo $fields['bigbutton_1_title'] ?></h1>
			<p><?php echo $fields['bigbutton_1_text'] ?></p>
			<span>
				<a href="<?php echo $fields['bigbutton_1_link_url'] ?>">
					<?php echo $fields['bigbutton_1_link_text'] ?>
				</a>
			</span>
		</div>
		<div id="main-bigbutton2">
			<h1><?php echo $fields['bigbutton_2_title'] ?></h1>
			<p><?php echo $fields['bigbutton_2_text'] ?></p>
			<span>
				<a href="<?php echo $fields['bigbutton_2_link_url'] ?>">
					<?php echo $fields['bigbutton_2_link_text'] ?>
				</a>
			</span>
		</div>	
	</div>
	
	<div class="clear"></div>


	<!-- SPOTLIGHT SECTION -->
	<div id="main-spotlight">
		<h1><?php echo $fields['leftbar_title'] ?></h1>
		<span><?php echo $fields['leftbar_text'] ?></span>
	</div>
	
	<!-- MAIN CONTENT -->
	<div id="main-content" class="frontpage">
		<div id="main-content-title">
			<span><?php echo $fields['content_title'] ?></span>
		</div>
		<div id="main-content-top">
			<span><?php echo $fields['content_top'] ?></span>
		</div>
		<div class="clear"></div>
		
		<div id="main-content-middle">
			<div id="main-content-col1">
				<span><?php echo $fields['content_col1'] ?></span>
			</div>
			<div id="main-content-col2">
				<span><?php echo $fields['content_col2'] ?></span>
			</div>
			<div id="main-content-col3">
				<span><?php echo $fields['content_col3'] ?></span>
			</div>
		</div>
		<div class="clear"></div>
		
		<div id="main-content-bottom">
			<span><?php echo $fields['content_bottom'] ?></span>
		</div>
	</div>

</div>



<script type="text/javascript"> 
	$(document).ready(function(){
		$('#main-slideshow').bjqs({
			'automatic' : true,
			'width' : 660,
			'height' : 250,
			'showMarkers' : true,
			'showControls' : false,
			'centerMarkers' : false,
			'hoverPause': true
		});
	});
</script>

<?php get_footer(); ?>

