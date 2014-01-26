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
require DOCUMENT_ROOT.'php/basic/head.php';
?>
    
<?php 
require DOCUMENT_ROOT.'php/basic/top.php';
?>
    <?php
    if(isset($_GET["topic"]))
      require DOCUMENT_ROOT.'php/basic/forum/view/topic.php';
    else if(isset($_GET["group"]))
      require DOCUMENT_ROOT.'php/basic/forum/view/group.php';
    else if(isset($_GET["section"]))
      require DOCUMENT_ROOT.'php/basic/forum/view/section.php';
    else if(isset($_GET["user"]))
      require DOCUMENT_ROOT.'php/basic/forum/view/user.php';
    else echo '<h4>请选择浏览类别</h4>';
    ?>
<?php 
require DOCUMENT_ROOT.'php/basic/bottom.php';
?>
