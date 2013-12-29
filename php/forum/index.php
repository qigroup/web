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
$title="歧论坛";
require $document_root.'php/basic/head.php';
?>
		
<?php 
require $document_root.'php/basic/top.php';
?>
		<h1>歧论坛</h1>
		<table style="margin:0 auto;width:65em;">
			<tr>
				<td style="width:60%;"><table style="width:100%;">
					<tr><td><table class="border" style="width:100%;">
						<tr><th><h4 style="text-align:left;">热点话题</h4></th></tr>
						<tr><td>开发中。。。。。。</td></tr>
					</table></td></tr>
					<tr><td><table class="border" style="width:100%;">
						<tr><th style="width:55%;"><h4 style="text-align:left;">最新动态</h4></th></tr>
						<tr><td colspan="2"><hr /></td></tr>
						<?php
						if(!$mysql=mysql_connect($mysql_hostname,$mysql_username,$mysql_password))
							echo '
								<tr><th><h4>错误:不能连接服务器</h4></th></tr>
								<tr><td colspan="2"><hr /></td></tr>
							';
						else
							{
							$str='SELECT ID,GroupID,Name,LastUpdateTime From Topic WHERE Status!=-1 ORDER BY LastUpdateTime DESC';
							mysql_select_db($mysql_forum_db, $mysql);
							if (!$result0=mysql_query($str,$mysql))
		 	 					echo '
									<tr><th><h4>错误：服务器内部错误</h4></th></tr>
									<tr><td colspan="2"><hr /></td></tr>
								';
							else
								{
								for($i=0;($data0=mysql_fetch_row($result0))&&$i<10;$i++)
									{
									$str='SELECT Name,SectionID From DiscussionGroup WHERE ID='.$data0[1];
									if (!$result1=mysql_query($str,$mysql))
		 	 							echo '
											<tr><th><h4>错误：服务器内部错误</h4></th></tr>
											<tr><td colspan="2"><hr /></td></tr>
										';
									else
										{
										$data1=mysql_fetch_row($result1);
										$str='SELECT Name From Section WHERE ID='.$data1[1];
										if (!$result2=mysql_query($str,$mysql))
		 	 								echo '
												<tr><th><h4>错误：服务器内部错误</h4></th></tr>
												<tr><td colspan="2"><hr /></td></tr>
											';
										else
											{
											$data2=mysql_fetch_row($result2);
											echo '
												<tr>
													<td><p style="max-height:4em;overflow-x:auto;"><a href="view.php?topic='.$data0[0].'">'.htmlspecialchars($data0[2]).'</a></p></td>
													<td><div style="max-height:4em;overflow-x:auto;">
														<p>'.$data0[3].'</p>
														<p>讨论组：<a href="view.php?group='.$data0[1].'">'.htmlspecialchars($data1[0]).'</a></p>
														<p>版块：<a href="view.php?section='.$data1[1].'">'.htmlspecialchars($data2[0]).'</a></p>
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
				</table></td>
				<td style="width:40%;"><table style="width:100%;">
					<tr><td><table class="border" style="width:100%;">
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
					<tr><td><table class="border" style="width:100%;">
						<tr><th style="width:40%;"><h4 style="text-align:left;">讨论版块</h4></th></tr>
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
								mysql_select_db($mysql_basic_db, $mysql);
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
													<td><p style="max-height:3em;overflow-x:auto;"><a href="view.php?section='.$data0[0].'">'.htmlspecialchars($data0[1]).'</a></p></td>
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
<?php 
require $document_root.'php/basic/bottom.php';
?>
