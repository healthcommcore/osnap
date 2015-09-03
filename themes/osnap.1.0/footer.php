<div style="clear:both;"></div>

</div> <!-- close container -->



<div class="footer">

	
	
	<div class="row">
		<div class="footerleft">       
			<!-- <h4>Stay connected to OSNAP!</h4> -->
			<div id="prc">
				<div class="prc-logo">
					<a href="http://www.cdc.gov/prc/" target="_blank">
					<img src="<?php bloginfo('template_url'); ?>/images/PRC-green-and-white200.jpg"  width="120"/>
					</a>
				</div>
				<div class="prc-text">
					This work was supported by Prevention Research Center cooperative agreement number 1U48DP001946 from the Centers for Disease Control and Prevention, including the Nutrition and Obesity Policy Research and Evaluation Network, as well as support from the Donald and Sue Pritzker Nutrition and Fitness Initiative and the Robert Wood Johnson Foundation (#66284).
				</div>
			</div>
		</div>
		<div class="footerright">
			
			
			<div class="social">
				<!--
				<div class="bigsocialbutton">
					<a href=""><img src="<?php bloginfo('template_url'); ?>/images/Facebook.png"/></a>
				</div>
				<div class="bigsocialbutton">
					<a href=""><img src="<?php bloginfo('template_url'); ?>/images/Twitter.png"/></a>
				</div>
				<div class="bigsocialbutton">
					<a href=""><img src="<?php bloginfo('template_url'); ?>/images/YouTube.png"/></a>
				</div>
				-->
            	<div class="like_btn">
            	  	<div class="fb-like" href="<?php echo urlencode(get_permalink($post->ID)); ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
            	</div>
            	<div class="tweet_btn">
            		<a href="http://twitter.com/share" class="twitter-share-button"
            		data-url="<?php the_permalink(); ?>"
            		data-via="<?php echo of_get_option('twitter_user'); ?>"
            		data-text="<?php the_title(); ?>"
            		data-related=""
            		data-count="horizontal"><?php _e("Tweet", 'organicthemes'); ?></a>
            	</div>
            	<div class="plus_btn">
            		<g:plusone size="medium" href="<?php the_permalink(); ?>"></g:plusone>
            	</div>
            </div>
			
		</div>
	</div>
	<div class="row">
		<div class="footerbottom">       
			<p></p>
		</div>
	</div>
	
</div> 

<?php wp_footer(); ?>


</div><!--innerwrapper-->
</div><!--outerwrapper-->

<!-- google analytics -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-42575634-1']);
  _gaq.push(['_setDomainName', 'osnap.org']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<!-- end google analytics -->

</body>
</html>