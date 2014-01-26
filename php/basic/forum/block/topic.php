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
            <tr><th style="width:55%;"><h4 style="text-align:left;">最新动态</h4></th></tr>
            <tr><td colspan="2"><hr /></td></tr>
            <?php
            $mysql=mysql_connect(MYSQL_HOSTNAME,MYSQL_USERNAME,MYSQL_PASSWORD);
            $str='SELECT ID,GroupID,SectionID,Name,LastUpdateTime From Topic WHERE Status!=-1 '.$str_add.' ORDER BY LastUpdateTime DESC';
            mysql_select_db(MYSQL_FORUM_DB,$mysql);
            $result_topic=mysql_query($str,$mysql);
            for($i=0;($data_topic=mysql_fetch_row($result_topic))&&$i<10;$i++)
              {
                $str='SELECT Name From DiscussionGroup WHERE ID='.$data_topic[1];
                $result_group=mysql_query($str,$mysql);
                $data_group=mysql_fetch_row($result_group);
                $str='SELECT Name From Section WHERE ID='.$data_topic[2];
                $result_section=mysql_query($str,$mysql);
                $data_section=mysql_fetch_row($result_section);
                echo '
                  <tr>
                    <td><p style="max-height:4em;overflow-x:auto;"><a href="view.php?topic='.$data_topic[0].'">'.htmlspecialchars($data_topic[3]).'</a></p></td>
                    <td><div style="max-height:4em;overflow-x:auto;">
                      <p>'.$data_topic[4].'</p>
                      <p>讨论组：<a href="view.php?group='.$data_topic[1].'">'.htmlspecialchars($data_group[0]).'</a></p>
                      <p>版块：<a href="view.php?section='.$data_topic[2].'">'.htmlspecialchars($data_section[0]).'</a></p>
                    </div></td>
                  </tr>
                  <tr><td colspan="2"><hr /></td></tr>
                ';
              }
            mysql_close($mysql);
            ?>
          </table></td></tr>