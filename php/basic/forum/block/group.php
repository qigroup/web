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
          <tr><td><table class="border" style="width:100%;">
            <tr><th style="width:55%;"><h4 style="text-align:left;">讨论组</h4></th></tr>
            <tr><td colspan="2"><hr /></td></tr>
            <?php
            $mysql=mysql_connect(MYSQL_HOSTNAME,MYSQL_USERNAME,MYSQL_PASSWORD);
            $str='SELECT ID,Name,Manager,LastUpdateTime From DiscussionGroup WHERE Status!=-1 AND SectionID='.mysql_real_escape_string($_GET["section"]).' ORDER BY LastUpdateTime DESC';
            mysql_select_db(MYSQL_FORUM_DB,$mysql);
            $result_group=mysql_query($str,$mysql);
            mysql_select_db(MYSQL_BASIC_DB,$mysql);
            for($i=0;($data_group=mysql_fetch_row($result_group))&&$i<10;$i++)
              {
                $str='SELECT Name From users WHERE ID='.$data_group[2];
                $result_users=mysql_query($str,$mysql);
                $data_users=mysql_fetch_row($result_users);
                echo '
                  <tr>
                    <td><p style="max-height:3em;overflow-x:auto;"><a href="view.php?group='.$data_group[0].'">'.htmlspecialchars($data_group[1]).'</a></p></td>
                    <td><div style="max-height:3em;overflow-x:auto;">
                      <p>'.$data_group[3].'</p>
                      <p>管理员：<a href="view.php?user='.$data_group[2].'">'.htmlspecialchars($data_users[0]).'</a></p>
                    </div></td>
                  </tr>
                  <tr><td colspan="2"><hr /></td></tr>
                ';
              }
            mysql_close($mysql);
            ?>
          </table></td></tr>