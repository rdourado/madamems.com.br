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
            <div class="post-title" style="text-transform:none"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></div>
            <div class="post-text"><?php the_content(); ?></div>
        </div>
        <?php endif; ?>
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