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
require '../../../basic/config.php';
?>
<?php 
require DOCUMENT_ROOT.'php/basic/head.php';
?>
    
<?php 
require DOCUMENT_ROOT.'php/basic/top.php';
?>
    <?php
    if($_POST["verifycode"]!=$_SESSION["verifycode".$_POST["random"]]||$_POST["verifycode"]=="")
      echo '<h4>验证码错误，修改失败</h4>';
    else if($_SESSION["login"]==-1)
      echo '<h4>用户未登录，修改失败</h4>';
    else if($_POST["old-password"]==""||$_POST["password"]=="")
      echo '<h4>密码为空，修改失败</h4>';
    else if($_POST["password"]!=$_POST["re-password"])
      echo '<h4>密码不匹配，修改失败</h4>';
    else
      {
        $mysql=mysql_connect(MYSQL_HOSTNAME,MYSQL_USERNAME,MYSQL_PASSWORD);
        $str='SELECT Password FROM users WHERE ID='.$_SESSION["login"];
        mysql_select_db(MYSQL_BASIC_DB,$mysql);
        $result_users=mysql_query($str,$mysql);
        $data_users=mysql_fetch_row($result_users);
        if(passwdcrypt($_POST["password"])!=$data_users[0])
          echo '<h4>密码错误，修改失败</h4>';
        else
          {
            $str='UPDATE users SET Password="'.passwdcrypt($_POST["password"]).'" WHERE ID='.$_SESSION["login"];
            mysql_select_db(MYSQL_BASIC_DB,$mysql);
            mysql_unbuffered_query($str,$mysql);
            echo '<h4>密码修改成功</h4>';
          }
      }
    mysql_close($mysql);
    unset($_SESSION["verifycode".$_POST["random"]]);
    ?>
<?php 
require DOCUMENT_ROOT.'php/basic/bottom.php';
?>
