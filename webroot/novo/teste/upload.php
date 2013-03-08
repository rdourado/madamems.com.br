<?php
$tempFile = $_FILES['file']['tmp_name'];
$name = $_FILES['file']['name'];
$type = $_FILES['file']['type'];
$targetPath = $_SERVER['DOCUMENT_ROOT'] . 'novo/logado/library/uploads/';
$extension = strrchr($name, ".");
$randomname = md5(rand() * time());
$compiledname = $randomname . $extension;
$targetFile =  strtolower($targetPath . $compiledname);
move_uploaded_file($tempFile, $targetFile);
echo $targetFile;
?>