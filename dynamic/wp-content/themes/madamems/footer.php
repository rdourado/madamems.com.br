	<hr>
	<footer id="foot">
		<div id="radio">
			<div id="jquery_jplayer_1" class="jp-jplayer"></div>
			<div id="jp_container_1" class="jp-audio">
				<div class="jp-type-playlist">
					<div class="jp-gui jp-interface">
						<ul class="jp-controls">
							<li><a href="javascript:;" class="jp-previous" tabindex="-1">previous</a></li>
							<li><a href="javascript:;" class="jp-play" tabindex="-1">play</a></li>
							<li><a href="javascript:;" class="jp-pause" tabindex="-1">pause</a></li>
							<li><a href="javascript:;" class="jp-next" tabindex="-1">next</a></li>
							<li><a href="javascript:;" class="jp-mute" tabindex="-1" title="mute">mute</a></li>
							<li><a href="javascript:;" class="jp-unmute" tabindex="-1" title="unmute">unmute</a></li>
						</ul>
						<ul class="jp-toggles">
							<li><a href="javascript:;" class="jp-shuffle" tabindex="-1" title="shuffle">shuffle</a></li>
							<li><a href="javascript:;" class="jp-shuffle-off" tabindex="-1" title="shuffle off">shuffle off</a></li>
						</ul>
					</div>
					<div class="jp-playlist">
						<ul>
							<li></li>
						</ul>
					</div>
	                <a href="http://www.gomus.com.br/" class="gomus" target="_blank"></a>
					<div class="jp-no-solution"></div>
				</div>
        	</div>
		</div>

		<div class="fb-like" data-href="http://www.facebook.com/madamemsoficial" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
		<a href="http://www.facebook.com/madamemsoficial" class="fb" target="_blank"><img src="<?php t_url(); ?>/img/icon-fb.png" alt="Facebook" width="25" height="25"></a>
		<img src="<?php t_url(); ?>/img/inverno13.png" alt="Madame Ms Inverno 2013" id="season" width="135" height="40">
		<a href="http://mgstudio.com.br/" id="mg" target="_blank">by MG Studio</a>
	</footer>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=472574189476629";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<!-- WP/ --><?php wp_footer(); ?><!-- /WP -->
</body>
</html>