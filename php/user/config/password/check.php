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
require '../../../basic/config.php';
?>
<?php 
require $document_root.'php/basic/head.php';
?>
		
<?php 
require $document_root.'php/basic/top.php';
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
		else if(!$mysql=mysql_connect($mysql_hostname,$mysql_username,$mysql_password))
			echo '<h4>错误:不能连接服务器</h4>';
		else
			{
			$str='SELECT Password FROM users WHERE ID='.$_SESSION["login"];
			mysql_select_db($mysql_basic_db, $mysql);
			if (!$result0=mysql_query($str,$mysql))
				echo '<h4>错误：服务器内部错误</h4>';
			else
				{
				$data0=mysql_fetch_row($result0);
				if(passwdcrypt($_POST["password"])!=$data0[0])
					echo '<h4>密码错误，修改失败</h4>';
				else
					{
					$str='UPDATE users SET Password="'.passwdcrypt($_POST["password"]).'" WHERE ID='.$_SESSION["login"];
					mysql_select_db($mysql_basic_db, $mysql);
					if(!$result1=mysql_query($str,$mysql))
						echo '<h4>错误：服务器内部错误</h4>';
					else echo '<h4>密码修改成功</h4>';
					}
				}
			}
		mysql_close($mysql);
		unset($_SESSION["verifycode".$_POST["random"]]);
		?>
<?php 
require $document_root.'php/basic/bottom.php';
?>
