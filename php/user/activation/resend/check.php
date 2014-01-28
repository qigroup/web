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
      echo '<h4>验证码错误，发送失败</h4>';
    else
      {
        $mysql=mysql_connect(MYSQL_HOSTNAME,MYSQL_USERNAME,MYSQL_PASSWORD);
        $str='SELECT Password,Email FROM users WHERE Name="'.mysql_real_escape_string($_POST["username"],$mysql).'"';
        mysql_select_db(MYSQL_BASIC_DB,$mysql);
        $result_users=mysql_query($str,$mysql);
        $data_users=mysql_fetch_row($result_users);
        if(passwdcrypt($_POST["password"])!=$data_users[0])
          echo '<h4>密码错误，发送失败</h4>';
        else
          {
            $str="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            for($i=0;$i<20;$i++)
              $code.=$str[mt_rand(0,61)];
            $_SESSION["activation"]=$code;
            $subject = "用户激活";
            $message = "欢迎您成为我们网站的用户，您的用户需要激活以使用。激活码为:".$code."。如果您并不期望受到本邮件，请忽略。\n\n\n\n\n\t此邮件为服务器自动发出，请勿回复。";
            $headers = "From:".EMAIL_SENDER."@".EMAIL_HOSTNAME;
            if(!mail($data_users[1],$subject,$message,$headers))
              echo '
                <h4>激活邮件发送失败，请在激活页面中重新发送</h4>
                <p class="PCenter"><a href="/php/user/activation/">用户激活</a></p>
              ';
            else
              echo '
                <h4>激活邮件已发出，请在4小时内激活</h4>
                <p class="PCenter"><a href="/php/user/activation/">用户激活</a></p>
              ';
          }
        mysql_close($mysql);
      }
    unset($_SESSION["verifycode".$_POST["random"]]);
    ?>
<?php 
require DOCUMENT_ROOT.'php/basic/bottom.php';
?>
