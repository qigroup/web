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
require '../basic/config.php';
?>
<?php
require $document_root.'php/basic/head.php';
?>
<?php
require $document_root.'php/basic/top.php';
?>
		<h1>发表内容</h1>
		<h2>开发中。。。</h2>
		<?php
		if(!isset($_POST["topic"]))
			echo '<h4>未指定主题，提交失败</h4>';
		else if(!isset($_POST["floor"]))
			echo '<h4>未指定层，提交失败</h4>';
		if($_POST["verifycode"]!=$_SESSION["verifycode".$_POST["random"]]||$_POST["verifycode"]=="")
			echo "<h4>验证码错误，提交失败</h4>";
		else if($_POST["content"]=="")
			echo "<h4>内容为空，提交失败</h4>";
		else
			{
				$mysql=mysql_connect($mysql_hostname,$mysql_username,$mysql_password);
				$str='SELECT Count FROM Topic WHERE ID='.$_POST["topic"].' AND Status!=-1';
				mysql_select_db($mysql_forum_db, $mysql);
				if(!$result0=mysql_query($str,$mysql))
					echo '<h4>主题无效，提交失败</h4>';
				else
					{
						$data0=mysql_fetch_row($result0);
						if($_POST["floor"]>$data0[0]+1)
							echo '<h4>层数错误，提交失败</h4>';
						else
							{
								if($_POST["floor"]==$data0[0]+1)
									{
										$str='UPDATE Topic SET Count='.$_POST["floor"].' WHERE ID='.$_POST["topic"];
										mysql_query($str,$mysql);
									}
								$str='INSERT INTO Topic_'.$_POST["topic"].' (Floor,UserID,Time,Content) VALUES ('.$_POST["floor"].','.$_SESSION["login"].',"'.GetTimestamp().'","'.addslashes($_POST["content"]).'")';
								mysql_query($str,$mysql);
								echo '<h4>提交成功</h4>';
							}
					}
				mysql_close($mysql);
			}
		unset($_SESSION["verifycode".$_POST["random"]]);
		?>
<?php
require $document_root.'php/basic/bottom.php';
?>
