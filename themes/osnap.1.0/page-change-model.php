<?php
/*
Template Name: Change Model
*/
?>

<?php 
	// get the wp header
	get_header(); 

	// get all of the Advanced Custom Fields for this page	
	$fields = get_fields();
?>

<div id="content" class="row">
<div id="changemodel">

	<div id="div1" class="targetDiv changemodel-graphic"><img src="<?php echo $fields['cm1-img'] ?>" /></div>
	<div id="div2" class="targetDiv changemodel-graphic"><img src="<?php echo $fields['cm2-img'] ?>" /></div>
	<div id="div3" class="targetDiv changemodel-graphic"><img src="<?php echo $fields['cm3-img'] ?>" /></div>
	<div id="div4" class="targetDiv changemodel-graphic"><img src="<?php echo $fields['cm4-img'] ?>" /></div>
	<div id="div5" class="targetDiv changemodel-graphic"><img src="<?php echo $fields['cm5-img'] ?>" /></div>
	<div id="div6" class="targetDiv changemodel-graphic"><img src="<?php echo $fields['cm6-img'] ?>" /></div>
	<div id="div7" class="targetDiv changemodel-graphic"><img src="<?php echo $fields['cm7-img'] ?>" /></div>
	
	<h1 id="changemodel-title"><?php echo $fields['title'] ?></h1>
	
	<span id="changemodel-intro"><?php echo $fields['intro-text'] ?></span>	
	
	<div id="changemodel-main">	
	
		<div id="accordion">
			<h3 class="no-border-top showSingle" data-target="1">
			<a href="#" class="showSingle" data-target="1"><?php echo $fields['cm1-title'] ?></a></h3>
			<div><?php echo $fields['cm1-text'] ?></div>
			
			<h3 class="showSingle" data-target="2"><a href="#" class="showSingle" data-target="2"><?php echo $fields['cm2-title'] ?></a></h3>
			<div><?php echo $fields['cm2-text'] ?></div>
			
			<h3 class="showSingle" data-target="3"><a href="#" class="showSingle" data-target="3"><?php echo $fields['cm3-title'] ?></a></h3>
			<div><?php echo $fields['cm3-text'] ?></div>
			
			<h3 class="showSingle" data-target="4"><a href="#" class="showSingle" data-target="4"><?php echo $fields['cm4-title'] ?></a></h3>
			<div><?php echo $fields['cm4-text'] ?></div>
			
			<h3 class="showSingle" data-target="5"><a href="#" class="showSingle" data-target="5"><?php echo $fields['cm5-title'] ?></a></h3>
			<div><?php echo $fields['cm5-text'] ?></div>
			
			<h3 class="showSingle" data-target="6"><a href="#" class="showSingle" data-target="6"><?php echo $fields['cm6-title'] ?></a></h3>
			<div><?php echo $fields['cm6-text'] ?></div>
			
			<h3 class="showSingle" data-target="7"><a href="#" class="showSingle" data-target="7"><?php echo $fields['cm7-title'] ?></a></h3>
			<div><?php echo $fields['cm7-text'] ?></div>
		</div>

	</div>
	
</div>
</div>

<script>
	$(function() {
		// big accordion
		$( "#accordion" ).accordion({heightStyle: "content"});
		
		// change the chart based on which accordion div is clicked
		$('.showSingle').on('click', function () {
			$(this).addClass('selected').siblings().removeClass('selected');
			$('.targetDiv').hide();
			$('#div' + $(this).data('target')).show();
		});
		$('.showSingle').first().click();
	
	});
</script>
	
<?php get_footer(); ?>

