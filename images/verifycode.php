<?php
/*  Copyright 2012-2014 Qi Group     This file is a part of Qi Web.
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<?php
require '../php/basic/config.php';
?>
<?php
/*num个数字  显示大小为size   边宽width   边高height*/
$num=4;$size=20; 
if(!isset($width))
  $width=$num*$size*4/5+9;
if(!isset($height))
  $height=$size+10;
if(empty($_GET["id"])||isset($_SESSION["verifycode".$_GET["id"]]))
  {
  $img=imagecreatetruecolor($width,$height);
  //颜色
  $back_color=imagecolorallocate($img,255,255,255);
  $boer_color=imagecolorallocate($img,0,0,0);
  $text_color=imagecolorallocate($img,mt_rand(0,200),mt_rand(0,120),mt_rand(0,120));
  //背景
  imagefilledrectangle($img,0,0,$width,$height,$back_color);
  //框
  imagerectangle($img,0,0,$width-1,$height-1,$boer_color);
  @imagefttext($img,$size-4,0,5,$size+3,$text_color,DOCUMENT_ROOT.'fonts/FreeMonoBold.ttf',"WRONG");
  header("Cache-Control:max-age=1,s-maxage=1,no-cache,must-revalidate");
  header("Content-type:image/png;charset=utf-8");
  imagepng($img);
  imagedestroy($img);
  }
else
  {
  //去掉了01Ol等
  $chs="23456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVW";
  $code ='';
  for($i=0;$i<$num;$i++)
    $code.=$chs[mt_rand(0,strlen($chs)-1)];
  //生成
  $img=imagecreatetruecolor($width,$height);
  //颜色
  $back_color=imagecolorallocate($img,255,255,255);
  $boer_color=imagecolorallocate($img,0,0,0);
  $text_color=imagecolorallocate($img,mt_rand(0,200),mt_rand(0,120),mt_rand(0,120));
  //背景
  imagefilledrectangle($img,0,0,$width,$height,$back_color);
  //框
  imagerectangle($img,0,0,$width-1,$height-1,$boer_color);
  //弧
  for($i=0;$i<50;$i++)
    {
    $font_color=imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
    imagearc($img,mt_rand(-($width-1),$width-1),mt_rand(-($height-1),$height-1),mt_rand(30,($width-1)* 2),mt_rand(20,($height-1)*2),mt_rand(0,360),mt_rand(0,360),$font_color);
    }
  //点
  for($i=0;$i<800;$i++)
    {
    $font_color=imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
    imagesetpixel($img,mt_rand(0,$width),mt_rand(0,$height),$font_color);
    }
  //输出
  @imagefttext($img,$size,0,5,$size+3,$text_color,DOCUMENT_ROOT.'fonts/FreeMonoBold.ttf',$code);
  header("Cache-Control:max-age=1,s-maxage=1,no-cache,must-revalidate");
  header("Content-type:image/png;charset=utf-8");
  imagepng($img);
  imagedestroy($img);
  session_start();
  $_SESSION["verifycode".$_GET["id"]]=$code;
  }
?>
