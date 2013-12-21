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
require 'config.php';
?>
	</head>
	<body>
		<table style="width:100%"><tr>
				<td style="text-align:left;"><p><small><a href="/">主页</a>|<a href="/php/forum/" title="歧论坛">论坛</a>|<a href="/php/left/">留言册</a>|<a href="/php/doc/manual.php">人工服务指南</a></small></p></td>
			<?php
			if($_SESSION["login"]==-1) echo '<td style="text-align:right;"><p><small><a href="/php/user/login/">登录</a>|<a href="/php/user/register/">注册</a></small></p></td>';
			else if(!$mysql=mysql_connect($mysql_hostname,$mysql_username,$mysql_password))
				echo '<td style="text-align:right;"><p><small>错误:不能连接服务器</small></p></td>';
			else
				{
				$str='SELECT Name FROM users WHERE ID='.$_SESSION["login"];
				mysql_select_db($mysql_basic_db, $mysql);
				if (!$result0=mysql_query($str,$mysql))
	  				echo '<td style="text-align:right;"><p><small>错误：服务器内部错误</small></p></td>';
				else
		  			{
					$data0=mysql_fetch_row($result0);
	  				echo '
						<td style="text-align:right;"><p><small><a href="/php/user/config/" title="用户控制中心">'.htmlspecialchars($data0[0]).'</a>|<a href="/php/user/logout/">注销</a></small></p></td>
					';
	  				}
				}
			mysql_close($mysql);
			?>
		</tr></table>
		<hr />
