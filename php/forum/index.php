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
require '../basic/config.php';
?>
<?php 
$title="歧论坛";
require DOCUMENT_ROOT.'php/basic/head.php';
?>
    
<?php 
require DOCUMENT_ROOT.'php/basic/top.php';
?>
    <h1>歧论坛</h1>
    <table style="margin:0 auto;width:65em;">
      <tr>
        <td style="width:60%;"><table style="width:100%;">
          <tr><td><table class="border" style="width:100%;">
            <tr><th><h4 style="text-align:left;">热点话题</h4></th></tr>
            <tr><td>开发中。。。。。。</td></tr>
          </table></td></tr>
          <?php
          $str_add='';
          require DOCUMENT_ROOT.'php/basic/forum/block/topic.php';
          ?>
        </table></td>
        <td style="width:40%;"><table style="width:100%;">
          <?php
          require DOCUMENT_ROOT.'php/basic/forum/block/user.php';
          ?>
          <?php
          require DOCUMENT_ROOT.'php/basic/forum/block/section.php';
          ?>
        </table></td>
      </tr>
    </table>
<?php 
require DOCUMENT_ROOT.'php/basic/bottom.php';
?>
