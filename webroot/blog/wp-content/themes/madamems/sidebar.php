<div class="widget-container">
<div class="widget-header">VEJA O <a href="http://madamems.com.br/lookbook.htm#inverno_2012" target="_blank" style="color:#fff;text-decoration:underline;">LOOKBOOK</a></div>

<?php $randImageNumber = rand(1, 32);?>
<div id="galeryWidget">
<div id="flashEffect" style="background:#fff;height:100%;left:0;position:absolute;top:0;width:100%;"></div>
<div id="imagePool" style="display:none;"><img src="http://madamems.com.br/images/lookbook/thumbs/<?php echo $randImageNumber ?>.jpg" width="290" /></div>
<img src="http://madamems.com.br/images/lookbook/thumbs/<?php echo $randImageNumber ?>.jpg" width="290" />
</div>
</div>

<div class="widget-container">
<div class="widget-header">TAGS</div>
<div class="tags-widget">
<?php
foreach(ctc() as $tag){
	$curSize = rand(14, 28);
	$start = strpos($tag, '>');
	$tag = substr($tag, $start + 1);
	$tag = str_replace('</a>', '', $tag);
		echo '<a href="http://madamems.com.br/blog/tag/' . $tag . '" style="font-size:' . $curSize . 'px;">' . $tag . '</a> ';
	}
?>
</div>
</div>

<div class="widget-container">
<div class="widget-header">FACEBOOK</div>
<!-- Facebook social plugin. STARTING -->
<iframe src="//www.facebook.com/plugins/likebox.php?href=http://www.facebook.com/madamemsoficial&amp;width=300&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=false&amp;appId=221143591274370" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:290px; height:258px; margin-top:6px;" allowTransparency="true"></iframe>
<!-- Facebook Social plugin. END -->
</div>
   
<div class="widget-container">         
<div class="widget-header">POSTS MAIS LIDOS</div>
<div id="more-read-posts"><br />
<?php wp_reset_postdata(); ?>
<?php $footerQuery = new WP_Query('posts_per_page=3'); ?>
<?php while($footerQuery->have_posts()) : $footerQuery->the_post();
$images = get_children('post_type=attachment&post_mime_type=image&post_parent=' . $post->ID);
$curImg;
foreach($images as $imageID => $imagePost){
	$curImg = wp_get_attachment_image($imageID, 'thumbnail', false);
	$curImg = str_replace('height="150"', 'height="75"', $curImg);
	$curImg = str_replace('width="150"', 'width="75"', $curImg);
	if(strpos($curImg, 'width') === false){
		$curImg = str_replace('/>', 'width="75" />', $curImg);
	}
	if(strpos($curImg, 'height') === false){
		$curImg = str_replace('width="75"', 'height="75" width="75"', $curImg);
	}
}
?>
<div class="post-thumb"><a href="<?php the_permalink(); ?>"><?php echo $curImg; ?></a></div>
<div class="post-excerpt">
<?php the_excerpt(); ?>
<a href="<?php the_permalink(); ?>" style="color:#beb49c;">LEIA MAIS +</a>
</div>
<div style="clear:both;"></div><br />
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
</div>
</div>

<div class="widget-container">
<div class="widget-header">PLAY LIST MADAME MS</div>
<iframe width="300" height="335" src=" http://www.gomus.com.br/web/madamems/ " frameborder="0" allowfullscreen=""></iframe>
</div>