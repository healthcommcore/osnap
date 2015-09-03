<!doctype html>
<!-- This is the main header for OSNAP v1.0 -->

<head>
<meta charset="<?php bloginfo('charset'); ?>">

<?php if(of_get_option('enable_responsive') == '1') { ?>
<!-- Mobile View -->
<meta name="viewport" content="width=device-width">
<?php } ?>

<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
<link rel="Shortcut Icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon">

<!-- load jquery and jquery ui -->
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>

<!-- load basic jquery slider. see http://basic-slider.com/  -->
<link rel="Stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/basic-jquery-slider.css" />
<script src="<?php bloginfo('template_url'); ?>/js/basic-jquery-slider.js"></script>

<!-- bootstrap -->
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/css/bootstrap-combined.min.css" rel="stylesheet">
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/js/bootstrap.min.js"></script>

<!-- load local styles -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style-mobile.css">

<!-- Social -->
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>

<!-- load the WP head-->
<?php wp_head(); ?>

<script type="text/javascript"> 
	var $j = jQuery.noConflict();
	$j(document).ready(function() { 		
		// load superfish top menu
	    $j('.menu').superfish({
	    	delay: 200,
	    	animation: {opacity:'show', height:'show'},
	    	speed: 'fast',
	    	autoArrows: true,
	    	dropShadows: false
	    });			
	}); 
</script>
<script type="text/javascript">
	var $j = jQuery.noConflict();
	$j(window).load(function() { 
		// Call fitVid before FlexSlider initializes, so the proper initial height can be retrieved.
		$j('.flexslider').fitVids().flexslider({
			slideshowSpeed: <?php echo of_get_option('transition_interval'); ?>,
			animationDuration	: 400,
			animation: 'fade',
			video: true,
			useCSS: false,
			animationLoop: true,
			smoothHeight: true
		});
	});
</script>
<script type="text/javascript">
    var $j = jQuery.noConflict();
	$j(document).ready(function() { 
		// find users timezone offset and place into session
        if("<?php echo $timezone; ?>".length==0){
            //var visitortime = new Date();
            //var visitortimezone = "GMT " + -visitortime.getTimezoneOffset()/60;
            //$j.ajax({
            //    type: "GET",
            //    url: "/wp-content/themes/osnap.1.0/timezone.php",
            //    data: 'time='+ visitortimezone,
            //    success: function(){
            //       location.reload();
            //  }
            //});
        }
    });
</script>

<!-- Make Social Buttons Load in Ajax -->
<script type="text/javascript">
	jQuery(document).ajaxComplete(function($) {
		gapi.plusone.go();
		twttr.widgets.load();
		try {
			FB.XFBML.parse();
		}catch(ex){}
	});
</script>


			
</head>

<body <?php body_class(); ?>>

<div id="outerwrapper">
<div id="innerwrapper">

<div id="fb-root"></div>
<script>
/*
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=246727095428680";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
*/
</script>


	<div id="header-wide-container">
		<div id="header">
			<div id="tagline">
				<p>The Out of School Time Nutrition and Physical Activity Initiative</p>
				<p>by the <a href="http://www.hsph.harvard.edu/research/prc/">
				Harvard School of Public Health Prevention Research Center</a></p>
			</div>
			<div id="logo-container">
				<a href="<?php echo home_url(); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/images/banner-logo.gif" height="80" width="375" alt="osnap logo"/>
				</a>
			</div>				
			<div id="nav-container">			
				<div id="navigation">
					<?php if ( function_exists('ot_register_menu') ) { // Check for 3.0+ menus
						wp_nav_menu( array( 
							'theme_location' => 'header-menu', 
							'title_li' => '', 
							'depth' => 4, 
							'container_class' => 'menu' 
							)
						); 
					} else { ?>
						<ul class="menu"><?php wp_list_pages('title_li=&depth=4'); ?></ul>
					<?php } ?>
				</div>			
			</div>	  			
		</div>
	</div>

	
	
	