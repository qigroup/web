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
$title="留言册";
require $document_root.'php/basic/head.php';
require $document_root.'php/basic/javascript/refresh.php';
?>
<?php 
require $document_root.'php/basic/top.php';
?>
		<h1>留言</h1>
		<div><form action="send.php" method="post">
			<p class="TCenter"><textarea rows="20" cols="80" name="left" ></textarea></p>
			<p class="TCenter">
				姓名：<input type="text" name="leftname" />
				|
				验证码：<input type="text" name="verifycode" />
				<?php EchoVerifyCode(); ?>
			</p>
			<p class="TCenter"><input type="submit" value="提交" /></p>
		</form></div>
		<script type="text/javascript">refresh();</script>
<?php 
require $document_root.'php/basic/bottom.php';
?>
