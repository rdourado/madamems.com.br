<!--<div id="container_footer">
<?php //wp_reset_postdata(); ?>
<?php //$footerQuery = new WP_Query('posts_per_page=6'); ?>
	<div id="container_most-read">POSTS MAIS LIDOS:</div><br />
    <div id="post-footer-center">
    <?php //while($footerQuery->have_posts()) : $footerQuery->the_post();
		//$images = get_children('post_type=attachment&post_mime_type=image&post_parent=' . $post->ID);
		//$curImg;
		//foreach($images as $imageID => $imagePost){
		//	$curImg = wp_get_attachment_image($imageID, 'thumbnail', false);
		//	$curImg = str_replace('height="150"', 'height="160"', $curImg);
		//	$curImg = str_replace('width="150"', 'width="120"', $curImg);
		//}
	?>
		<div class="post-thumb"><a href="<?php //the_permalink(); ?>"><?php //echo $curImg; ?></a></div>
    <?php //endwhile; ?>
    	<div style="clear:both;"></div>
    </div>
<?php //wp_reset_postdata(); ?>
</div>-->

<!-- New Analytics -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36297154-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>