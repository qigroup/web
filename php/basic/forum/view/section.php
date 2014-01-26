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
    <h1>歧论坛</h1>
    <table style="margin:0 auto;width:65em;">
      <tr>
        <td style="width:60%;"><table style="width:100%;">
          <tr><td>
          <?php
          $mysql=mysql_connect(MYSQL_HOSTNAME,MYSQL_USERNAME,MYSQL_PASSWORD);
          $str='SELECT Name From Section WHERE ID='.mysql_real_escape_string($_GET["section"]);
          mysql_select_db(MYSQL_FORUM_DB,$mysql);
          if(!$result_section=mysql_query($str,$mysql))
            echo '<h3>版块不存在</h3>';
          else if(!$data_section=mysql_fetch_row($result_section))
            echo '<h3>版块不存在</h3>';
          else echo '<h3>'.htmlspecialchars($data_section[0]).'</h3>';
          mysql_close($mysql);
          ?>
          </td></tr>
          <?php
          $str_add='AND SectionID='.mysql_real_escape_string($_GET["section"]);
          require DOCUMENT_ROOT.'php/basic/forum/block/topic.php';
          ?>
          <?php
          require DOCUMENT_ROOT.'php/basic/forum/block/group.php';
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
