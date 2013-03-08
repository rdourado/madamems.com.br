<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Madame Ms - Blog</title>
<link href='http://fonts.googleapis.com/css?family=Quicksand:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$('#shadow-effect').css('height', $('#ref_endOfPage').offset().top + 'px');
	
	// Image carousel widget set up
	$('#flashEffect').fadeTo(1, 0);
	$('#imagePool > img').bind('load', function(){
		$('#flashEffect').fadeTo(1, 1, function(){
			$('#galeryWidget > img').attr('src', $('#imagePool > img').attr('src'));
			$(this).fadeTo(1000, 0, function(){
				setTimeout('changeImage()', 10000);
			});
		});
	});
});

// Image carousel function
function changeImage(){
	var rand = Math.floor(Math.random() * 32) + 1;
	while(('http://madamems.com.br/images/lookbook/thumbs/' + rand + '.jpg') == $('#galeryWidget > img').attr('src')){
		rand = Math.floor(Math.random() * 32) + 1;
	}
	$('#imagePool > img').attr('src', 'http://madamems.com.br/images/lookbook/thumbs/' + rand + '.jpg');
}
</script>

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

</head>