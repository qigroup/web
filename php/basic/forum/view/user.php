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
		<table style="margin:0 auto;border:2px solid;border-radius:2em;padding:2em 10em;">
			<tr><th><h1>查看用户资料</h1></th></tr>
			<?php
				if(!$mysql=mysql_connect($mysql_hostname,$mysql_username,$mysql_password))
				echo '<tr><th><h3>错误:不能连接服务器</h3></th></tr>';
			else
				{
				$str='SELECT Name,RegisterTime,UserGroup From users WHERE ID='.$_GET["user"];
				mysql_select_db($mysql_basic_db, $mysql);
				if(!$result0=mysql_query($str,$mysql))
		 	 		echo '<tr><th><h3>错误：服务器内部错误</h3></th></tr>';
				else
					{
					if($data0=mysql_fetch_row($result0))
						{
						echo '
							<tr><td><p>用户名：'.htmlspecialchars($data0[0]).'</p></td></tr>
							<tr><td><p>用户类型：'.GetGroupName($data0[2]).'</p></td></tr>
							<tr><td><p>注册时间：'.$data0[1].'</p></td></tr>
						';
						}
					else echo '<tr><th><h3>此用户不存在</h3></th></tr>';
					}
				}
			mysql_close($mysql);
			?>
		</table>
