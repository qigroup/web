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
if(!$mysql=mysql_connect($mysql_hostname,$mysql_username,$mysql_password))
	echo '<h4>错误:不能连接服务器</h4>';
else
	{
	$str='SELECT Name,Count From Topic WHERE ID='.$_GET["topic"];
	mysql_select_db($mysql_forum_db, $mysql);
	if (!$result0=mysql_query($str,$mysql))
	 	echo '<h4>错误：服务器内部错误</h4>';
	else
		{
		if(!$data0=mysql_fetch_row($result0))
			echo '<h1>主题不存在</h1>';
		else echo '<h1>'.htmlspecialchars($data0[0]).'</h1>';
		}
	}
mysql_close($mysql);
?>
		<table class="border" style="margin:0 auto;width:60em;">
			<tr>
				<th style="width:30%;border-right:solid 1px #D0D0D0;"><h3>用户信息</h3></th>
				<th style="width:70%;"><h3>发表内容</h3></th>
			</tr>
						<?php
							if(!$mysql=mysql_connect($mysql_hostname,$mysql_username,$mysql_password))
							echo '
								<tr><th colspan="2"><h4>错误:不能连接服务器</h4></th></tr>
								<tr><td colspan="2"><hr /></td></tr>
							';
						else
							{
							for($i0=0;$i0<$data0[1];$i0++)
								{
								$str='SELECT UserID,Content,Time From Topic_'.$_GET["topic"].' WHERE Status!=-1 AND Floor='.$i0.' ORDER BY ID';
								mysql_select_db($mysql_forum_db, $mysql);
								if (!$result1=mysql_query($str,$mysql))
		 	 						echo '
										<tr><th colspan="2"><h4>错误：服务器内部错误</h4></th></tr>
										<tr><td colspan="2"><hr /></td></tr>
									';
								else
									{
									if(!$data1=mysql_fetch_row($result1))
 	 									echo '
											<tr><th colspan="2"><h4>该层为空</h4></th></tr>
											<tr><td colspan="2"><hr /></td></tr>
										';
									else
										{
										$str='SELECT Name,UserGroup From users WHERE ID='.$data1[0];
										mysql_select_db($mysql_basic_db, $mysql);
										if (!$result2=mysql_query($str,$mysql))
 	 										echo '
												<tr><th><h4>错误：服务器内部错误</h4></th></tr>
											';
										else
											{
											$data2=mysql_fetch_row($result2);
											echo '
												<tr><td colspan="2"><a name="f'.$i0.'"><hr /></a></td></tr>
												<tr>
													<td style="border-right:solid 1px #D0D0D0;">
														<p><a href="/php/forum/view.php?user='.$data1[0].'">'.htmlspecialchars($data2[0]).'</a></p>
														<p>'.GetGroupName($data2[1]).'</p>
													</td>
											';
											}
										echo '
												<td>
													<p style="white-space:pre;">'.htmlspecialchars($data1[1]).'</p>
													<p style="text-align:right;"><small>'.$i0.'层0亚层</small></p>
													<p style="text-align:right;"><small>'.$data1[2].'</small></p>
													<hr />
													<table style="width:100%;">
														<tr>
															<th style="width:40%;border-right:solid 1px #D0D0D0;"><h4 class="close">用户信息</h4></th>
															<th style="width:60%;"><h4 class="close">发表内容</h4></th>
														</tr>
										';
										for($i1=1;$data1=mysql_fetch_row($result1);$i1++)
											{
												$str='SELECT Name,UserGroup From users WHERE ID='.$data1[0];
												mysql_select_db($mysql_basic_db, $mysql);
												$result2=mysql_query($str,$mysql);
												$data2=mysql_fetch_row($result2);
												echo '
													<tr><td colspan="2"><a name="f'.$i0.'g'.$i1.'"><hr /></a></td></tr>
													<tr>
														<td style="border-right:solid 1px #D0D0D0;">
															<p><a href="/php/forum/view.php?user='.$data1[0].'">'.htmlspecialchars($data2[0]).'</a></p>
															<p>'.GetGroupName($data2[1]).'</p>
														</td>
														<td>
															<p style="white-space:pre;">'.htmlspecialchars($data1[1]).'</p>
															<p style="text-align:right;"><small>'.$i0.'层'.$i1.'亚层</small></p>
															<p style="text-align:right;"><small>'.$data1[2].'</small></p>
														</td>
													</tr>
												';
											}
										echo '
														<tr><td colspan="2"><hr /></td></tr>
														<tr><td colspan="2"><h4 style="text-align:right;" class="close"><a href="write.php?topic='.$_GET["topic"].'&floor='.$i0.'">回复</a></h4></td></tr>
													</table>
												</td>
											</tr>
										';
										}
									}
								}
							}
						mysql_close($mysql);
						echo '
							<tr><td colspan="2"><hr /></td></tr>
							<tr><td colspan="2"><h2><a href="write.php?topic='.$_GET["topic"].'&floor='.$i0.'">回复</a></h2></td></tr>';
						?>
			<tr><td colspan="2"><hr /></td></tr>
		</table>
