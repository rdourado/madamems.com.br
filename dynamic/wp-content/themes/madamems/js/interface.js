function ready(){

	//
	// Menu
	//

	try{
		$('#menu>li:not(.menu-blog)>a,#logo a,#body .entry-menu>li>a').unbind('click').click(function(e){
			e.preventDefault();
			var href = $(this).attr('href');
			$.ajax({
				url: href,
				type: 'get',
				data: {ajax:'1'},
				dataType: 'json',
				cache: false
			}).done(function(data){
				data.slug = String(data.slug).substr(0,4) == 'look' ? 'lookbook' : data.slug;
				$('body').removeClass().addClass(data.slug);
				$('#body').replaceWith(data.post_content);
				$('#menu>li').removeClass('current-menu-item');
				$('html,body').scrollTop(0);
				ready();
			});
		});
	}catch(e){}

	//
	// Anchor
	//

	try{
		$('#highlight .anchor').unbind('click').click(function(e){
			e.preventDefault();
			$('body,html').animate({ scrollTop: $($(this).attr('href')).offset().top - 69 }, 'slow');
		});
	}catch(e){}

	//
	// Mask
	//

	try{
		$('#np2,#cf2_field_9').mask('99/99/9999');
		$('#cf2_field_7').mask('999.999.999-99');
		$('#cf2_field_4,#cf2_field_5').mask('(99) 9999-9999?9');
	}catch(e){}

	//
	// Lojas
	//

	try{
		$('#cidade').val('rio-de-janeiro').change(function(){
			$('.stores>div').hide();
			$('#'+$(this).val()).show();
		}).trigger('change');
	}catch(e){}

	//
	// Lookbook
	//

	function titleFormat(title, currentArray, currentIndex, currentOpts) {
		var html = $('.lookbook-list>li:eq('+currentIndex+') img').attr('alt');
		html = '<h3><span>Referências</span></h3><div>' + html.split(',').join('<br>') + '</div>';
		return '<div id="fancybox-title-over">' + html + '</div>';
	}
	$('.fancybox','#body').attr('rel', 'lookbook').fancybox({
		hideOnContentClick: false,
		padding: 0,
		margin: 0,
		titlePosition: 'over',
		titleFormat: titleFormat,
		overlayColor: '#FFF',
		overlayOpacity: 1
	});
	$('.fancybox.active','#body').trigger('click');

	//
	// Full Slider
	//

	try{
		var $list = $('.campaign-list:first'),
			$fullImgs = $list.find('img:not(.ignore)');
			fullCurrent = 0,
			fullW = $(window).width();
		$list.wrap('<div id="fullslider-viewport"></div>').css({ 
			'float': 'left', 
			'position': 'relative' 
		});
		$('#fullslider-viewport').css({
			'overflow': 'hidden',
			'position': 'relative',
			'width': '100%'
		}).prepend('<a href="#" class="slider-prev"></a><a href="#" class="slider-next"></a>');
		$('.slider-next','#fullslider-viewport').click(function(e){
			e.preventDefault();
			if (fullCurrent < $fullImgs.length - 1) {
				fullCurrent++;
				$list.animate({ left:-fullCurrent*fullW }, 'normal');
			}
		});
		$('.slider-prev','#fullslider-viewport').click(function(e){
			e.preventDefault();
			if (fullCurrent > 0) {
				fullCurrent--;
				$list.animate({ left:-fullCurrent*fullW }, 'normal');
			}
		});
		$(window).resize(function(){
			fullW = $(window).width();
			if (fullW < 980) fullW = 980;
			$list.find('>li').width(fullW).css({ float: 'left' });
			$list.width(fullW * $list.find('img:not(.ignore)').length);
		}).trigger('resize');
	}catch(e){}

	//
	// Slider
	//

	try{
		$('.slider', '#body').each(function(){
			var $this = $(this), 
				sizes = [], 
				wid = 0,
				show = parseInt($this.attr('data-show')),
				margin = parseInt($('li', this).show().css('float', 'left').first().css('marginRight'));
			if (!show) show = 1;
			$('img', this).each(function(){
				var $this = $(this);
				sizes.push({w: $this.width() + margin, h: $this.height()});
				wid += sizes[sizes.length - 1].w;
			});
			$this.data('sizes', sizes).data('current', 0).width(wid);
			$this.data('show', show).data('margin', margin);
			$this.css({padding:0, position:'relative'});
			$this.wrap('<div class="slider-container"></div>');
		});
		$('.slider-container').wrap('<div class="slider-wrap"></div>').css({
			overflow: 'hidden',
			height:   '100%',
			width:    '100%'
		});
		$('.slider-wrap').each(function(){
			var $this 	= $(this),
				$slider = $this.find('>.slider-container>.slider'),
				sizes 	= $slider.data('sizes'),
				margin 	= $slider.data('margin'),
				show 	= $slider.data('show');
			
			var w = 0, h = 0;
			for (var i = 0; i < show; i++) {
				w += sizes[i].w ? sizes[i].w : 0;
				h = sizes[i].h > h ? sizes[i].h : h;
			}
			w -= margin;
			
			$this.css({
				marginLeft:  'auto',
				marginRight: 'auto',
				position: 	 'relative',
				height: 	 h,
				width: 		 w
			}).prepend('<a href="" class="slider-prev"></a><a href="" class="slider-next"></a>');
		});
		//$('.slider-prev').hide();
		$('.slider-prev,.slider-next','.slider-wrap').unbind('click').click(function(e){
			e.preventDefault();
			var $this 		= $(this),
				$wrap 		= $this.parent(),
				is_prev 	= $this.hasClass('slider-prev'),
				$container 	= is_prev ? $this.next().next() : $this.next(),
				$slider 	= $container.find('>.slider');
				sizes 		= $slider.data('sizes'),
				current 	= $slider.data('current'),
				margin 		= $slider.data('margin'),
				show 		= $slider.data('show'),
				diff 		= sizes.length % show;
			
			if (is_prev) current = current - show >= 0 ? current - show : 0;
			else current = current + show <= sizes.length - diff ? current + show : sizes.length - diff;
			
			//current <= 0 ? $('.slider-prev', $wrap).fadeOut() : $('.slider-prev', $wrap).fadeIn();
			//current >= sizes.length - 1 ? $('.slider-next', $wrap).fadeOut() : $('.slider-next', $wrap).fadeIn();
			
			if (current != $slider.data('current') && current < sizes.length) {

				var w = 0, h = 0, l = 0, r = 0;
				for (var i = current; i < current + show; i++) {
					w += sizes[i] ? sizes[i].w : 0;
					h = (sizes[i] && sizes[i].h) > h ? sizes[i].h : h;
					l += sizes[i-show] ? sizes[i-show].w : 0;
					r += sizes[i] ? sizes[i].w : 0;
				}

				$slider.data('current', current).animate({
					left: is_prev ? '+='+r : '-='+l
				}, 'slow');
				$wrap.animate({
					width: w - margin,
					height: h
				}, 'slow').css('overflow', 'visible');

			}
		});
		$('body').unbind('keydown').keydown(function(e){
			var keyCode = e.keyCode || e.which,
				arrow = {left: 37, up: 38, right: 39, down: 40};
			if (keyCode == arrow.left)
				$('.slider-prev').trigger('click');
			else if (keyCode == arrow.right)
				$('.slider-next').trigger('click');
		});
	}catch(e){}

};
$(document).ready(ready);

/* Newsletter */
if (typeof newsletter_check !== "function") {
window.newsletter_check = function (f) {
	var re = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-]{1,})+\.)+([a-zA-Z0-9]{2,})+$/;
	if (!re.test(f.elements["ne"].value)) {
		alert("Digite um e-mail válido, por favor.");
		return false;
	}
	if (f.elements["nn"] && (f.elements["nn"].value == "" || f.elements["nn"].value == f.elements["nn"].defaultValue)) {
		alert("Digite seu nome, por favor.");
		return false;
	}
	if (f.elements["ny"] && !f.elements["ny"].checked) {
		alert("You must accept the privacy statement");
		return false;
	}
	return true;
}
}

/* Radio */
$(function() {
	if(window._gomus) {
		new jPlayerPlaylist({
			jPlayer: "#jquery_jplayer_1",
			cssSelectorAncestor: "#jp_container_1"
		}, _gomus.songs, {
			swfPath: "http://www.jplayer.org/latest/js",
			supplied: "mp3",
			wmode: "window"
		});
	} else {
		//erro
		$("#player").remove();
		$("#player-container").remove();
	} 
});
