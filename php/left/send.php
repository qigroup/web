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
require 'php/basic/config.php';
?>
<?php 
require $document_root.'php/basic/head.php';
?>
<?php 
require $document_root.'php/basic/top.php';
?>
		<h4>
		<?php
		if($_POST["verifycode"]!=$_SESSION["verifycode".$_POST["random"]]||$_POST["verifycode"]=="")
			echo "验证码错误，提交失败";
		else if($_POST["left"]=="")
			echo "内容为空，提交失败";
		else if(!$mysql=mysql_connect($mysql_hostname,$mysql_username,$mysql_password))
			echo "错误:不能连接服务器";
		else
			{
			$time=time();
			$time=date("YmdHis",$time);
			$left=$_POST["left"];
			$leftname=$_POST["leftname"];
			$str='INSERT INTO leftdata (UserID,Name,Time,Content) VALUES ('.$_SESSION["login"].',"'.addslashes($leftname).'","'.$time.'","'.addslashes($left).'")';
			mysql_select_db($mysql_basic_db, $mysql);
			if (!mysql_query($str,$mysql))
		 	 	echo "错误：服务器内部错误";
			else echo "提交成功";
			}
		mysql_close($mysql);
		unset($_SESSION["verifycode".$_POST["random"]]);
		?>
		</h4>
<?php 
require $document_root.'php/basic/bottom.php';
?>
