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
require $document_root.'php/basic/javascript/refresh.php';
?>
<?php 
require $document_root.'php/basic/top.php';
?>
		<form action="check.php" method="post">
			<table style="text-align:right;margin:0 auto;border:2px solid;border-radius:2em;padding:2em 10em;">
				<tr><th><h1>用户激活</h1></th></tr>
				<tr><td><p>用户名：<input type="text" name="username" /></p></td></tr>
				<tr><td><p>密码：<input type="password" name="password" /></p></td></tr>
				<tr><td><p>
					激活码：<input type="text" name="activationcode" />
				</p></td></tr>
				<tr><td><p><small>（若未收到邮件，请<a href="re-send/">重新发送</a>或<a href="/php/doc/manual.php">人工激活</a>。）</small></p></td></tr>
					<tr><td><p>验证码：<input type="text" name="verifycode" /></p></td></tr>
				<tr><td><p>
					<?php EchoVerifyCode(); ?>
				</p></td></tr>
				<tr><td><p class="TCenter"><input type="submit" value="激活" /></p></td></tr>
			</table>
		</form>
		<script type="text/javascript">refresh();</script>
<?php 
require $document_root.'php/basic/bottom.php';
?>
