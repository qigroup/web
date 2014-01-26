<?php
/*  Copyright 2012-2014 Qi Group     This file is a part of Qi Web.
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
require 'php/basic/config.php';
?>
<?php 
$title="主页";
require  DOCUMENT_ROOT.'php/basic/head.php';
?>
<?php 
require DOCUMENT_ROOT.'php/basic/top.php';
?>
    <h1><big>
      <span style="color:#6688FF;">欢迎来到</span>
      <span style="color:#FFFF00;">歧研发小组</span>
    </big></h1>
    <table class="border" style="margin:0 auto;">
      <tr>
        <td style="padding-right:10em;"><table border="1">
          <tr><th colspan="2"><h2>作品展示</h2></th></tr>
          <tr>
            <th><h4 class="close">序号</h4></th>
            <th><h4 class="close">名称</h4></th>
          </tr>
          <tr>
            <td><p>000</p></td>
            <td><p><?php echo '<a href="'.SOURCE_ROOT.'qi/">歧（Qi） Beta1.01</a>'; ?></p></td>
          </tr>
        </table></td>
        <td>
          <h2><a href="http://github.com/qigroup/" >Github</a></h2>
          <h2><a href="ftp://www.xiexun.eu.org/" >ftp</a></h2>
          <h2><a href="http://www.xiexun.eu.org:1998/browserquest/" >BrowserQuest</a></h2>
        </td>
      </tr>
    </table>
<?php 
require DOCUMENT_ROOT.'php/basic/bottom.php';
?>
