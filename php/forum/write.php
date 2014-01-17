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
require $document_root.'php/basic/javascript/refresh.php';
?>
<?php
require $document_root.'php/basic/top.php';
?>
		<h1>发表内容</h1>
		<div><form action="send.php" method="post">
			<p class="TCenter">
				<textarea rows="20" cols="80" name="content" ></textarea>
				<?php
					foreach(array_keys($_GET) as $get_name)
						echo '<input type="hidden" name="'.htmlspecialchars($get_name).'" value="'.htmlspecialchars($_GET[$get_name]).'" />';
				?>
			</p>
			<p class="TCenter">
				验证码：<input type="text" name="verifycode" />
				<?php EchoVerifyCode(); ?>
			</p>
			<p class="TCenter"><input type="submit" value="提交" /></p>
		</form></div>
<?php
require $document_root.'php/basic/bottom.php';
?>
