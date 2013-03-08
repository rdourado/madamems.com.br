<?php get_header(); ?>
<body>
<div id="theContainer">
	<div id="shadow-effect"></div>
    <?php get_template_part('top'); ?>
    <div id="container_content">
    	<div id="container_posts">
        <!-- Exemplo de post. -->
        <?php while(have_posts()) : the_post(); ?>
        <div class="post-unit">
            <div class="post-date"><?php echo get_the_date(); ?></div>
            <div class="post-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></div>
            <div class="post-text"><?php the_content(); ?></div>
            
            
            <div class="post-social-footer">
        <!-- Social buttons. -->
        <!-- Post coment form. -->
        <a href="<?php the_permalink(); ?>#comment-form" style="background:#b74b4b;color:#fff;font-size:16px;padding:3px 5px 3px 5px;"><i>COMENTE AQUI!</i></a>&nbsp;&nbsp;&nbsp;
		<!-- Facebook share button. -->
        <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php echo get_the_title(); ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/facebook-share-button.jpg" /></a>&nbsp;&nbsp;&nbsp;
		<!-- Facebook Like button. -->
        <iframe src="//www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;send=false&amp;layout=button_count&amp;width=90&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=20&amp;appId=221143591274370" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:20px; display:inline" allowTransparency="true"></iframe>&nbsp;&nbsp;&nbsp;
        <!-- Social buttons. -->
        </div>
        <div class="post-tags"><b>TAGS</b>: 
		<?php
			$numberOfTags = sizeof(wp_get_post_tags($post->ID));
			$tagsCount = 1;
        	foreach(wp_get_post_tags($post->ID) as $tag){
				echo '<a href="http://talitakume.com.br/blog/tag/' . $tag->slug . '">' . $tag->name . '</a>';
				if($numberOfTags > $tagsCount) echo ', ';
				$tagsCount++;
			}
		?>
        </div>
            
            
        </div>
        
        <?php endwhile; ?>
        </div>
        <div id="container_right-bar">
        	<?php get_sidebar(); ?>
        </div>
        <div id="container_pagination"><?php wp_pagenavi(); ?></div>
    </div>
    <div style="clear:both;">&nbsp;</div>
</div>
<div id="ref_endOfPage" style="height:1px;width:100%;"></div>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-32740037-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>