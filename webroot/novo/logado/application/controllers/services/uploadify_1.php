<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
Uploadify v2.1.0
Release Date: August 24, 2009

Copyright (c) 2009 Ronnie Garcia, Travis Nickels

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/


class Uploadify extends CI_Controller
{
    function __construct()
    {
	parent::__construct();
    }

    function upload()
    {
        if (!empty($_FILES))
        {
            $tempFile   = $_FILES['Filedata']['tmp_name'];
            $name       = $_FILES['Filedata']['name'];
            $type       = $_FILES['Filedata']['type'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';

            $extension = strrchr($name, ".");
            $randomname = md5(rand() * time());
            $compiledname = $randomname . $extension;
            $targetFile =  $targetPath . $compiledname;

            move_uploaded_file($tempFile, $targetFile);

            //$this->createThumbnail($targetFile, 185, "_sidebar", $extension);

	    echo $randomname;
        } else {
            echo false;
        }
    }

    function createThumbnail($targetFile, $thumbWidth, $sufix, $ext)
    {
        list($width, $height) = getimagesize($targetFile);
        $ratio = $thumbWidth / $width;
        $thumbHeight = $height * $ratio;

        switch ($ext)
        {
            case ".jpg":
                $srcImg = imagecreatefromjpeg($targetFile);
                break;
            case ".png":
                $srcImg = imagecreatefrompng($targetFile);
                break;
            case ".gif":
                $srcImg = imagecreatefromgif($targetFile);
                break;
        }

        $thumbImg = imagecreatetruecolor($thumbWidth, $thumbHeight);
        imagecopyresampled($thumbImg, $srcImg, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);
        $thumbname = substr($targetFile, 0, -4) . $sufix . $ext;
        imagejpeg($thumbImg, $thumbname);
    }
    
}
?>