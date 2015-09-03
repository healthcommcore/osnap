<?php
/*
Template Name: Environmental Standards
*/
?>

<?php 
	// get the wp header
	get_header(); 

	// get all of the Advanced Custom Fields for this page	
	$fields = get_fields();
?>

<div id="content" class="row">
<div id="envstandards">

	
	<h4 id="envstandards-supertitle"><?php echo $fields['super-title'] ?></h4>
	<h1 id="envstandards-title"><?php echo $fields['title'] ?></h1>
	<h2 id="envstandards-subtitle"><?php echo $fields['sub-title'] ?></h2>
	<div style="clear: both;"></div>
	
	<div id="envstandards-intro">
	
			<div id="envstandards-intro-left">
				<span><?php echo $fields['intro-left-text'] ?></span>
				<ul>
					<li><a href=<?php echo $fields['intro-link2-url'] ?>><?php echo $fields['intro-link2-text'] ?></a></li>
				</ul>
			</div>
			<div id="envstandards-intro-right">
				<span><?php echo $fields['intro-right-text'] ?></span>
			</div>
			<div style="clear: both;"></div>
			<a name="1"></a>			
	</div>
	<div style="clear: both;"></div>

	<div class="envstandard">
		<div class="es-col1">
			<h2><?php echo $fields['std1-super-title'] ?></h2>
			<h4><?php echo $fields['std1-title'] ?></h4>
		</div>
		<div class="es-col2">
			<img src="<?php echo $fields['std1-image'] ?>" />
		</div>
		<div class="es-col3">
			<span><?php echo $fields['std1-main-text'] ?></span>
		</div>
		<div class="es-col4">
			<h3><?php echo $fields['std1-right-title'] ?></h3>
			<span><?php echo $fields['std1-right-text'] ?></span>
		</div>
		<a name="2"></a>
		<div style="clear: both;"></div>
	</div>
	
	<div class="envstandard">
		<div class="es-col1">
			<h2><?php echo $fields['std2-super-title'] ?></h2>
			<h4><?php echo $fields['std2-title'] ?></h4>
		</div>
		<div class="es-col2">
			<img src="<?php echo $fields['std2-image'] ?>" />
		</div>
		<div class="es-col3">
			<span><?php echo $fields['std2-main-text'] ?></span>
		</div>
		<div class="es-col4">
			<h3><?php echo $fields['std2-right-title'] ?></h3>
			<span><?php echo $fields['std2-right-text'] ?></span>
		</div>
		<a name="3"></a>
		<div style="clear: both;"></div>
	</div>
	
	<div class="envstandard">
		<div class="es-col1">
			<h2><?php echo $fields['std3-super-title'] ?></h2>
			<h4><?php echo $fields['std3-title'] ?></h4>
		</div>
		<div class="es-col2">
			<img src="<?php echo $fields['std3-image'] ?>" />
		</div>
		<div class="es-col3">
			<span><?php echo $fields['std3-main-text'] ?></span>
		</div>
		<div class="es-col4">
			<h3><?php echo $fields['std3-right-title'] ?></h3>
			<span><?php echo $fields['std3-right-text'] ?></span>
		</div>
		<a name="4"></a>
		<div style="clear: both;"></div>
	</div>
	
	<div class="envstandard">
		<div class="es-col1">
			<h2><?php echo $fields['std4-super-title'] ?></h2>
			<h4><?php echo $fields['std4-title'] ?></h4>
		</div>
		<div class="es-col2">
			<img src="<?php echo $fields['std4-image'] ?>" />
		</div>
		<div class="es-col3">
			<span><?php echo $fields['std4-main-text'] ?></span>
		</div>
		<div class="es-col4">
			<h3><?php echo $fields['std4-right-title'] ?></h3>
			<span><?php echo $fields['std4-right-text'] ?></span>
		</div>
		<a name="5"></a>
		<div style="clear: both;"></div>
	</div>
	
	<div class="envstandard">
		<div class="es-col1">
			<h2><?php echo $fields['std5-super-title'] ?></h2>
			<h4><?php echo $fields['std5-title'] ?></h4>
		</div>
		<div class="es-col2">
			<img src="<?php echo $fields['std5-image'] ?>" />
		</div>
		<div class="es-col3">
			<span><?php echo $fields['std5-main-text'] ?></span>
		</div>
		<div class="es-col4">
			<h3><?php echo $fields['std5-right-title'] ?></h3>
			<span><?php echo $fields['std5-right-text'] ?></span>
		</div>
		<a name="6"></a>
		<div style="clear: both;"></div>
	</div>
	
	<div class="envstandard">
		<div class="es-col1">
			<h2><?php echo $fields['std6-super-title'] ?></h2>
			<h4><?php echo $fields['std6-title'] ?></h4>
		</div>
		<div class="es-col2">
			<img src="<?php echo $fields['std6-image'] ?>" />
		</div>
		<div class="es-col3">
			<span><?php echo $fields['std6-main-text'] ?></span>
		</div>
		<div class="es-col4">
			<h3><?php echo $fields['std6-right-title'] ?></h3>
			<span><?php echo $fields['std6-right-text'] ?></span>
		</div>
		<div style="clear: both;"></div>
	</div>
	
	<div class="envstandard">
		<div class="es-col1">
			<h2><?php echo $fields['std7-super-title'] ?></h2>
			<h4><?php echo $fields['std7-title'] ?></h4>
		</div>
		<div class="es-col2">
			<img src="<?php echo $fields['std7-image'] ?>" />
		</div>
		<div class="es-col3">
			<span><?php echo $fields['std7-main-text'] ?></span>
		</div>
		<div class="es-col4">
			<h3><?php echo $fields['std7-right-title'] ?></h3>
			<span><?php echo $fields['std7-right-text'] ?></span>
		</div>
		<a name="7"></a>
		<div style="clear: both;"></div>
	</div>
	
</div>
</div>
	
<?php get_footer(); ?>

