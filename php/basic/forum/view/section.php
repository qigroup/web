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
		<h1>歧论坛</h1>
		<table style="margin:0 auto;">
			<tr>
				<td><table>
					<tr><td>
					<?php
					if(!$mysql=mysql_connect($mysql_hostname,$mysql_username,$mysql_password))
						echo '<h3>错误:不能连接服务器</h3>';
					else
						{
						$str='SELECT Name From Section WHERE ID='.$_GET["section"];
						mysql_select_db($mysql_forum_db, $mysql);
						if (!$result0=mysql_query($str,$mysql))
	 	 						echo '<h3>错误：服务器内部错误</h3>';
						else
							{
							if(!$data0=mysql_fetch_row($result0))
								echo '<h3>版块不存在</h3>';
							else echo '<h3>'.htmlspecialchars($data0[0]).'</h3>';
							}
						}
					mysql_close($mysql);
					?>
					</td></tr>
					<tr><td><table style="border:2px solid;border-radius:2em;padding:2em;width:40em;">
						<tr><th style="width:22em;"><h4 style="text-align:left;">最新动态</h4></th></tr>
						<tr><td colspan="2"><hr /></td></tr>
						<?php
						if(!$mysql=mysql_connect($mysql_hostname,$mysql_username,$mysql_password))
							echo '<tr><th colspan="2"><h4>错误:不能连接服务器</h4></th></tr>';
						else
							{
							$str='SELECT ID,GroupID,Name,LastUpdateTime From Topic WHERE Status!=-1 ORDER BY LastUpdateTime DESC';
							mysql_select_db($mysql_forum_db, $mysql);
							if (!$result1=mysql_query($str,$mysql))
		 	 					echo '
									<tr><th colspan="2"><h4>错误：服务器内部错误</h4></th></tr>
									<tr><td colspan="2"><hr /></td></tr>
								';
							else
								{
								for($i=0;($data1=mysql_fetch_row($result1))&&$i<10;$i++)
									{
									$str='SELECT Name,SectionID From DiscussionGroup WHERE ID='.$data1[1];
									if (!$result2=mysql_query($str,$mysql))
 	 									echo '
											<tr><th colspan="2"><h4>错误：服务器内部错误</h4></th></tr>
											<tr><td colspan="2"><hr /></td></tr>
										';
									else
										{
										$data2=mysql_fetch_row($result2);
										if($data2[1]==$_GET["section"])
											{
											echo '
												<tr>
													<td><p style="max-height:4em;overflow-x:auto;"><a href="view.php?topic='.$data1[0].'">'.htmlspecialchars($data1[2]).'</a></p></td>
													<td><div style="max-height:4em;overflow-x:auto;">
														<p>'.$data1[3].'</p>
														<p>讨论组：<a href="view.php?group='.$data1[1].'">'.htmlspecialchars($data2[0]).'</a></p>
														<p>版块：<a href="view.php?section='.$data2[1].'">'.htmlspecialchars($data0[0]).'</a></p>
													</div></td>
												</tr>
												<tr><td colspan="2"><hr /></td></tr>
											';
											}
										}
									}
								}
							}
						mysql_close($mysql);
						?>
					</table></td></tr>
					<tr><td><table style="border:2px solid;border-radius:2em;padding:2em;width:40em;">
						<tr><th style="width:22em;"><h4 style="text-align:left;">讨论组</h4></th></tr>
						<tr><td colspan="2"><hr /></td></tr>
						<?php
						if(!$mysql=mysql_connect($mysql_hostname,$mysql_username,$mysql_password))
							echo '<tr><th colspan="2"><h4>错误:不能连接服务器</h4></th></tr>';
						else
							{
							$str='SELECT ID,Name,Manager,LastUpdateTime From DiscussionGroup WHERE Status!=-1 AND SectionID='.$_GET["section"].' ORDER BY LastUpdateTime DESC';
							mysql_select_db($mysql_forum_db, $mysql);
							if (!$result1=mysql_query($str,$mysql))
		 	 					echo '<tr><th colspan="2"><h4>错误：服务器内部错误</h4></th></tr>';
							else
								{
								mysql_select_db($mysql_basic_db, $mysql);
								for($i=0;($data1=mysql_fetch_row($result1))&&$i<10;$i++)
									{
									$str='SELECT Name From users WHERE ID='.$data1[2];
									if (!$result2=mysql_query($str,$mysql))
		 	 							echo '<tr><th colspan="2"><h4>错误：服务器内部错误</h4></th></tr>';
									else
										{
										$data2=mysql_fetch_row($result2);
										echo '
											<tr>
												<td><p style="max-height:3em;overflow-x:auto;"><a href="view.php?group='.$data1[0].'">'.htmlspecialchars($data1[1]).'</a></p></td>
												<td><div style="max-height:3em;overflow-x:auto;">
													<p>'.$data1[3].'</p>
													<p>管理员：<a href="view.php?user='.$data1[2].'">'.htmlspecialchars($data2[0]).'</a></p>
												</div></td>
											</tr>
											<tr><td colspan="2"><hr /></td></tr>
										';
										}
									}
								}
							}
						mysql_close($mysql);
						?>
					</table></td></tr>
				</table></td>
				<td><table>
					<tr><td><table style="border:2px solid;border-radius:2em;padding:2em;width:25em;">
						<tr><th><h4 style="text-align:left;">用户资料</h4></th></tr>
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
									<tr><td><p>用户名：'.htmlspecialchars($data0[0]).'</p></td></tr>
									<tr><td><p>真实姓名：'.htmlspecialchars($data0[4]).'</p></td></tr>
									<tr><td><p>用户类型：'.GetGroupName($data0[3]).'</p></td></tr>
									<tr><td><p>注册时间：'.$data0[1].'</p></td></tr>
									<tr><td><p>最后一次登录时间：'.$data0[2].'</p></td></tr>
									<tr><td><p>邮箱：'.htmlspecialchars($data0[5]).'</p></td></tr>
								';
								}
							}
						mysql_close($mysql);
						?>
					</table></td></tr>
					<tr><td><table style="border:2px solid;border-radius:2em;padding:2em;width:25em;">
						<tr><th style="width:11em;"><h4 style="text-align:left;">讨论版块</h4></th></tr>
						<tr><td colspan="2"><hr /></td></tr>
						<?php
						if(!$mysql=mysql_connect($mysql_hostname,$mysql_username,$mysql_password))
							echo '<tr><th><h4>错误:不能连接服务器</h4></th></tr>';
						else
							{
							$str='SELECT ID,Name,Manager,LastUpdateTime From Section WHERE Status!=-1 ORDER BY LastUpdateTime DESC';
							mysql_select_db($mysql_forum_db, $mysql);
							if (!$result0=mysql_query($str,$mysql))
		 	 					echo '<tr><th><h4>错误：服务器内部错误</h4></th></tr>';
							else
								{
								mysql_select_db("XX_web", $mysql);
								for(;$data0=mysql_fetch_row($result0);)
									{
									$str='SELECT Name From users WHERE ID='.$data0[2];
									if (!$result1=mysql_query($str,$mysql))
		 	 							echo '
											<tr><th><h4>错误：服务器内部错误</h4></th></tr>
											<tr><td colspan="2"><hr /></td></tr>
										';
									else
										{
										$data1=mysql_fetch_row($result1);
										echo '
												<tr>
													<td><p style="max-height:3em;overflow-x:auto;"><a href="view.php?section='.$data0[0].'">'.$data0[1].'</a></p></td>
													<td><div style="max-height:3em;overflow-x:auto;">
														<p>'.$data0[3].'</p>
														<p>管理员：<a href="view.php?user='.$data0[2].'">'.htmlspecialchars($data1[0]).'</a></p>
													</div></td>
												</tr>
												<tr><td colspan="2"><hr /></td></tr>
										';
										}
									}
								}
							}
						mysql_close($mysql);
						?>
					</table></td></tr>
				</table></td>
			</tr>
		</table>
