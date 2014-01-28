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
require '../../basic/config.php';
?>
<?php 
require DOCUMENT_ROOT.'php/basic/head.php';
?>
<?php
$output=0;
if($_POST["verifycode"]!=$_SESSION["verifycode".$_POST["random"]]||$_POST["verifycode"]=="")
  $output=1;
else
  {
    $mysql=mysql_connect(MYSQL_HOSTNAME,MYSQL_USERNAME,MYSQL_PASSWORD);
    $str='SELECT ID,Password,UserGroup FROM users WHERE Name="'.mysql_real_escape_string($_POST["username"],$mysql).'"';
    mysql_select_db(MYSQL_BASIC_DB,$mysql);
    $result_users=mysql_query($str,$mysql);
    $data_users=mysql_fetch_row($result_users);
    if(passwdcrypt($_POST["password"])!=$data_users[1])
      $output=2;
    else if($data_users[2]==100)
      $output=3;
    else
      {
        $_SESSION["login"]=$data_users[0];
        $str='UPDATE users SET LastLoginTime="'.GetTimestamp().'" WHERE ID='.$data_users[0];
        mysql_unbuffered_query($str,$mysql);
      }
    mysql_close($mysql);
  }
unset($_SESSION["verifycode".$_POST["random"]]);
?>
<?php 
require DOCUMENT_ROOT.'php/basic/top.php';
?>
    <h4>
    <?php
    switch($output)
      {
      case 0:
        echo "登录成功";
        break;
      case 1:
        echo "验证码错误，登录失败";
        break;
      case 2:
        echo "用户名或密码错误，登录失败";
        break;
      case 3:
        echo "用户未激活，登录失败";
        break;
      }
    ?>
    </h4>
<?php 
require DOCUMENT_ROOT.'php/basic/bottom.php';
?>
