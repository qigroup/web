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
		<table style="margin:0 auto;border:2px solid;border-radius:2em;padding:2em 10em;">
			<tr><th colspan="2"><h1>用户控制中心</h1></th></tr>
			<?php
			if($_SESSION["login"]==-1)
				echo '<tr><th><h4>您还未登录，请先登录</h4></th></tr>';
			else if(!$mysql=mysql_connect($mysql_hostname,$mysql_username,$mysql_password))
				echo '<tr><th><h4>错误:不能连接服务器</h4></th></tr>';
			else
				{
				$str='SELECT Name,RegisterTime,LastLoginTime,UserGroup,RealName,Email From users WHERE ID='.$_SESSION["login"];
				mysql_select_db($mysql_basic_db, $mysql);
				if (!$result0=mysql_query($str,$mysql))
		 	 		echo '<tr><th><h4>错误：服务器内部错误</h4></th></tr>';
				else
					{
					$data0=mysql_fetch_row($result0);
					echo '
						<tr>
							<td style="padding-right:10em;"><table>
								<tr><th><h3>基本信息</h3></th></tr>
								<tr><td><p>用户名：'.htmlspecialchars($data0[0]).'</p></td></tr>
								<tr><td><p>真实姓名：'.htmlspecialchars($data0[4]).'</p></td></tr>
								<tr><td><p>用户类型：'.GetGroupName($data0[3]).'</p></td></tr>
								<tr><td><p>注册时间：'.$data0[1].'</p></td></tr>
								<tr><td><p>最后一次登录时间：'.$data0[2].'</p></td></tr>
								<tr><td><p>邮箱：'.htmlspecialchars($data0[5]).'</p></td></tr>
							</table></td>
							<td><table style="text-align:right;">
								<tr><th><h3>用户配置</h3></th></tr>
								<tr><td><p><a href="password/">修改密码</a></p></td></tr>
								<tr><td><p><a href="/php/user/activation/">用户激活</a></p></td></tr>
							</table></td>
						</tr>
					';
					}
				}
			mysql_close($mysql);
			?>
		</table>
<?php 
require $document_root.'php/basic/bottom.php';
?>
