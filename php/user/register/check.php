<?php
/*  Copyright 2012-2013 Qi Group
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
require $document_root.'php/basic/head.php';
?>
<?php 
require $document_root.'php/basic/top.php';
?>
		<?php
		if($_POST["verifycode"]!=$_SESSION["verifycode".$_POST["random"]]||$_POST["verifycode"]=="")
			echo '<h4>验证码错误，注册失败</h4>';
		else if($_POST["username"]=="")
			echo '<h4>用户名为空，注册失败</h4>';
		else if($_POST["password"]=="")
			echo '<h4>密码为空，注册失败</h4>';
		else if($_POST["password"]!=$_POST["re-password"])
			echo '<h4>密码不匹配，注册失败</h4>';
		else if(!ereg("^[a-zA-Z0-9_\-]+@[a-zA-Z0-9_\-]+(\.[a-zA-Z0-9_\-]+)+$",$_POST["email"]))
			echo '<h4>邮箱格式错误，注册失败</h4>';
		else if(!$mysql=mysql_connect("localhost","XX_web","xx"))
			echo '<h4>错误:不能连接服务器</h4>';
		else
			{
			$str='SELECT ID FROM users WHERE Name="'.addslashes($_POST["username"]).'"';
			mysql_select_db("XX_web", $mysql);
			if (!$result0=mysql_query($str,$mysql))
				echo '<h4>错误：服务器内部错误</h4>';
			else
				{
				if($data0=mysql_fetch_row($result0))
					echo '<h4>用户已存在，注册失败</h4>';
				else
					{
					$time=time();
					$time=date("YmdHis",$time);
					$str='INSERT INTO users (Name,Password,RegisterTime,RealName,Email) VALUES ("'.addslashes($_POST["username"]).'","'.passwdcrypt($_POST["password"]).'","'.$time.'","'.addslashes($_POST["realname"]).'","'.addslashes($_POST["email"]).'");';
					if(!mysql_query($str,$mysql))
						echo '<h4>错误：服务器内部错误</h4>';
					else
						{
						$str="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	    					for($i=0;$i<20;$i++) 
	        					$code.=$str[mt_rand(0,61)];
						$_SESSION["activationcode"]=$code;
						$_SESSION["username"]=$_POST["username"];
						$subject = "用户激活";
						$message = "欢迎您成为我们网站的用户，您的用户需要激活以使用。激活码为:".$code."。如果您并不期望受到本邮件，请忽略。\n\n\n\n\n\t此邮件为服务器自动发出，请勿回复。";
						$headers = "XX@qigroup.xicp.net";
						if(!mail($_POST["email"],$subject,$message,$headers))
							echo '
								<h4>激活邮件发送失败，请在激活页面中重新发送</h4>
								<p class="TCenter"><a href="/php/user/activation/">用户激活</a></p>
							';
						else echo '
							<h4>激活邮件已发出，请在4小时内激活</h4>
							<p class="TCenter"><a href="/php/user/activation/">用户激活</a></p>
						';
						}
					}
				}
			}
		mysql_close($mysql);
		unset($_SESSION["verifycode".$_POST["random"]]);
		?>
<?php 
require $document_root.'php/basic/bottom.php';
?>
