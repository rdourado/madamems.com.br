<?php get_header(); ?>

<body>
<div id="theContainer">
	<div id="shadow-effect"></div>
	<?php get_template_part('top'); ?>
    <div id="container_content">
    	<div id="container_posts">
        <!-- Exemplo de post. -->
        <?php if(have_posts()) : the_post(); ?>
        <div class="post-unit">
            <div class="post-date"><?php the_date(); ?></div>
            <div class="post-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></div>
            <div class="post-text"><?php the_content(); ?></div>
        </div>
        <div class="post-social-footer">
        <!-- Social buttons. -->
        <!--Twitter -->
        <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-count="none" style="margin-top:5px !important;">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>&nbsp;&nbsp;&nbsp;
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
        <?php endif; ?>
        <div id="container-comments">
<!-- Comments area. -->
<?php if(have_comments()) : ?>
<h3><?php comments_number('Sem comentários', '1 RESPOSTA', '% RESPOSTAS'); ?></h3>
<div id="comment-wrapper">
<?php wp_list_comments(); ?>
<div class="navigation">
<div class="alignleft"><?php previous_comments_link() ?></div>
<div class="alignright"><?php next_comments_link() ?></div>
</div>
</div>
<?php endif; ?>
<?php if(comments_open()) : ?>
<h3>Envie seu comentário</h3>
<a name="comment-form" style="display:none;"></a>
<div style="background:#eee;" class="padding-5px text-center">
<form action="http://emcartazcultura.com/wp-comments-post.php" method="post" id="commentform" name="commentform">
<div class="input-wrapper"><div class="bg-blue label">Nome</div><input id="author" name="author" type="text" value="" /></div>
<div class="input-wrapper"><div class="bg-pink label">Email</div><input id="email" name="email" type="text" value="" /></div>
<div class="input-wrapper"><div class="bg-orange label">Site/Blog</div><input id="url" name="url" type="text" value="" /></div>
<div class="textarea-wrapper"><div class="bg-soft-gray label">Comentário</div><textarea id="comment" name="comment" value=""></textarea></div>
<div style="width:500px;" class="text-right"><input type="submit" value=" Comentar " class="submit-button" /></div>
<input type="hidden" name="comment_post_ID" value="<?php the_ID(); ?>" id="comment_post_ID" />
<input type="hidden" name="comment_parent" id="comment_parent" value="<?php if(isset($_GET['replytocom'])){echo $_GET['replytocom'];} ?>" />
</form>
</div>
<?php else : // comments are closed ?>
Os comentários para esse artigo estão fechados.
<?php endif; ?>
<!-- comments area. -->
        </div>
        <!-- Exemplo de post. -->
        </div>
        <div id="container_right-bar">
        	<?php get_sidebar(); ?>
        </div>
    </div>
    <div style="clear:both;"></div>
</div>
<div id="ref_endOfPage" style="height:1px;width:100%;"></div>
</body>
</html>