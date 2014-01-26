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
require 'php/basic/config.php';
?>
<?php 
require DOCUMENT_ROOT.'php/basic/head.php';
?>
<?php 
require DOCUMENT_ROOT.'php/basic/top.php';
?>
    <h4>
    <?php
    if($_POST["verifycode"]!=$_SESSION["verifycode".$_POST["random"]]||$_POST["verifycode"]=="")
      echo "验证码错误，提交失败";
    else if($_POST["left"]=="")
      echo "内容为空，提交失败";
    else
      {
        $mysql=mysql_connect(MYSQL_HOSTNAME,MYSQL_USERNAME,MYSQL_PASSWORD);
        $left=$_POST["left"];
        $leftname=$_POST["leftname"];
        $str='INSERT INTO leftdata (UserID,Name,Time,Content) VALUES ('.$_SESSION["login"].',"'.mysql_real_escape_string($_POST["leftname"]).'","'.GetTimestamp().'","'.mysql_real_escape_string($_POST["left"]).'")';
        mysql_select_db(MYSQL_BASIC_DB,$mysql);
        mysql_unbuffered_query($str,$mysql)
        echo "提交成功";
      }
    mysql_close($mysql);
    unset($_SESSION["verifycode".$_POST["random"]]);
    ?>
    </h4>
<?php 
require DOCUMENT_ROOT.'php/basic/bottom.php';
?>
