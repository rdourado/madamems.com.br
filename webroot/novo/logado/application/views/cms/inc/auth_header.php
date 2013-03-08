<!DOCTYPE html>
<html dir="ltr" lang="pt-br">
<head>
	<title><?=$page_title;?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta name="author" content="<?=DEFAULT_AUTHOR;?>" />
	<meta name="title" content="<?=$page_title;?>" />
	<meta name="keywords" content="<?=DEFAULT_KEYWORDS;?>" />
	<meta name="description" content="<?=$page_description;?>" />

	<!-- Javascript libraries -->
	<script src="<?=base_url();?>library/js/jquery-1.7.1.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>library/js/cms/main.js" type="text/javascript"></script>
	<?php
	/*
	* Local javascript definition
	*/
	if( isset ($local_js) )
	{
		echo "<script src=\"" . base_url() . "library/js/" . $local_js . "\"  type=\"text/javascript\"></script>\n";
	}
	?>
	<!-- Javascript libraries -->

	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="apple-touch-icon" href="" />

	<!-- Stylesheets -->
	<link href="<?=base_url();?>library/css/cms/default.css" rel="stylesheet" type="text/css" />
	<?php
	/*
	* Local css definition
	*/
	if( isset ($local_css) )
	{
		echo "<link href=\"" . base_url() . "library/css/" . $local_css . "\" rel=\"stylesheet\" type=\"text/css\" />\n";
	}
	?>
	<!-- Stylesheets -->
</head>
<body>
    <div id="notification">Notification Message</div>