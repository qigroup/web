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
$topic=mysql_real_escape_string($_GET["topic"]);
$mysql=mysql_connect(MYSQL_HOSTNAME,MYSQL_USERNAME,MYSQL_PASSWORD);
$str='SELECT Name,Count From Topic WHERE ID='.$topic;
mysql_select_db(MYSQL_FORUM_DB,$mysql);
if(!$result_topic=mysql_query($str,$mysql))
  echo '<h4>主题不存在</h4>';
else
  {
    if(!$data_topic=mysql_fetch_row($result_topic))
      echo '<h4>主题不存在</h4>';
    else
      echo '<h1>'.htmlspecialchars($data_topic[0]).'</h1>';
  }
mysql_close($mysql);
?>
    <table class="border" style="margin:0 auto;width:60em;">
      <tr>
        <th style="width:30%;border-right:solid 1px #D0D0D0;"><h3>用户信息</h3></th>
        <th style="width:70%;"><h3>发表内容</h3></th>
      </tr>
      <?php
      $floors_per_page=10;
      $echo_pages=10;
      if(!is_numeric($_GET["page"]))
        $page=1;
      else
        $page=(int)$_GET["page"];
      $mysql=mysql_connect(MYSQL_HOSTNAME,MYSQL_USERNAME,MYSQL_PASSWORD);
      for($i0=($page-1)*$floors_per_page;$i0>=0&&$i0<$data0[1]&&$i0<$page*$floors_per_page;$i0++)
        {
          $str='SELECT UserID,Content,Time From Topic_'.$topic.' WHERE Status!=-1 AND Floor='.$i0.' ORDER BY ID';
          mysql_select_db(MYSQL_FORUM_DB,$mysql);
          $result_topic_ID=mysql_query($str,$mysql);
          if(!$data_topic_ID=mysql_fetch_row($result_topic_ID))
            echo '
              <tr><td colspan="2"><hr /></td></tr>
              <tr><th colspan="2"><h4>该层为空</h4></th></tr>
            ';
          else
            {
              $str='SELECT Name,UserGroup From users WHERE ID='.$data_topic_ID[0];
              mysql_select_db(MYSQL_BASIC_DB,$mysql);
              $result_users=mysql_query($str,$mysql);
              $data_users=mysql_fetch_row($result_users);
              echo '
                <tr><td colspan="2"><hr /><a id="f'.$i0.'"></a></td></tr>
                <tr>
                  <td style="border-right:solid 1px #D0D0D0;">
                    <p><a href="/php/forum/view.php?user='.$data_topic_ID[0].'">'.htmlspecialchars($data_users[0]).'</a></p>
                    <p>'.GetGroupName($data_users[1]).'</p>
                  </td>
              ';
            }
          echo '
            <td>
              <p style="white-space:pre;">'.htmlspecialchars($data_topic_ID[1]).'</p>
              <p style="text-align:right;"><small>'.$i0.'层0亚层</small></p>
              <p style="text-align:right;"><small>'.$data_topic_ID[2].'</small></p>
              <hr />
              <table style="width:100%;">
                <tr>
                  <th style="width:40%;border-right:solid 1px #D0D0D0;"><h4 class="close">用户信息</h4></th>
                  <th style="width:60%;"><h4 class="close">发表内容</h4></th>
                </tr>
          ';
          for($i1=1;$data_topic_ID=mysql_fetch_row($result_topic_ID);$i1++)
            {
              $str='SELECT Name,UserGroup From users WHERE ID='.$data_topic_ID[0];
              mysql_select_db(MYSQL_BASIC_DB,$mysql);
              $result_users=mysql_query($str,$mysql);
              $data_users=mysql_fetch_row($result_users);
              echo '
                <tr><td colspan="2"><hr /><a id="f'.$i0.'g'.$i1.'"></a></td></tr>
                <tr>
                  <td style="border-right:solid 1px #D0D0D0;">
                    <p><a href="/php/forum/view.php?user='.$data_topic_ID[0].'">'.htmlspecialchars($data_users[0]).'</a></p>
                    <p>'.GetGroupName($data_users[1]).'</p>
                  </td>
                  <td>
                    <p style="white-space:pre;">'.htmlspecialchars($data_topic_ID[1]).'</p>
                    <p style="text-align:right;"><small>'.$i0.'层'.$i1.'亚层</small></p>
                    <p style="text-align:right;"><small>'.$data_topic_ID[2].'</small></p>
                  </td>
                </tr>
              ';
            }
          echo '
                  <tr><td colspan="2"><hr /></td></tr>
                  <tr><td colspan="2"><h4 style="text-align:right;" class="close"><a href="write.php?topic='.$topic.'&amp;floor='.$i0.'">回复</a></h4></td></tr>
                </table>
              </td>
            </tr>
          ';
        }
      mysql_close($mysql);
      echo '
        <tr><td colspan="2"><hr /></td></tr>
        <tr><td colspan="2"><p><small>页数：';
      EchoPageIndex($page,(int)(($data0[1]-1)/$floors_per_page+1),$echo_pages,'view.php?topic='.$topic.'&amp;');
      echo '</small></p></td></tr>';
      echo '
        <tr><td colspan="2"><hr /></td></tr>
        <tr><td colspan="2"><h2><a href="write.php?topic='.$topic.'&amp;floor='.$data_topic[1].'">回复</a></h2></td></tr>';
      ?>
      <tr><td colspan="2"><hr /></td></tr>
    </table>
