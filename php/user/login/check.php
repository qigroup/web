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
session_start();
$output=0;
if($_POST["verifycode"]!=$_SESSION["verifycode".$_POST["random"]]||$_POST["verifycode"]=="")
	$output=1;
else if(!$mysql=mysql_connect($mysql_hostname,$mysql_username,$mysql_password))
	$output=2;
else
	{
	$str='SELECT ID,Password,UserGroup FROM users WHERE Name="'.addslashes($_POST["username"]).'"';
	mysql_select_db($mysql_basic_db, $mysql);
	if(!$result0=mysql_query($str,$mysql))
		$output=3;
	else 
		{
		$data0=mysql_fetch_row($result0);
		if(passwdcrypt($_POST["password"])!=$data0[1])
			$output=4;
		else if($data0[2]==100)
			$output=5;
		else
			{
			$_SESSION["login"]=$data0[0];
			$time=time();
			$time=date("YmdHis",$time);
			$str='UPDATE users SET LastLoginTime="'.$time.'" WHERE ID='.$data0[0];
			mysql_query($str,$mysql);
			}
		}
	}
mysql_close($mysql);
unset($_SESSION["verifycode".$_POST["random"]]);
?>
<?php 
require $document_root.'php/basic/top.php';
?>
		<h4>
		<?php
		if($output==0)
			echo "登录成功";
		else if($output==1)
			echo "验证码错误，登录失败";
		else if($output==2)
			echo "错误:不能连接服务器";
		else if($output==3)
			echo "错误：服务器内部错误";
		else if($output==4)
			echo "用户名或密码错误，登录失败";
		else echo "用户未激活，登录失败";
		?>
		</h4>
<?php 
require $document_root.'php/basic/bottom.php';
?>
