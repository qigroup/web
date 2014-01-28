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
            <tr><th><h4 style="text-align:left;">用户资料</h4></th></tr>
            <?php
            if($_SESSION["login"]==-1)
              echo '<tr><th><h4>您还未登录，请先登录</h4></th></tr>';
            else
              {
                $mysql=mysql_connect(MYSQL_HOSTNAME,MYSQL_USERNAME,MYSQL_PASSWORD);
                $str='SELECT Name,RegisterTime,LastLoginTime,UserGroup,RealName,Email From users WHERE ID='.$_SESSION["login"];
                mysql_select_db(MYSQL_BASIC_DB,$mysql);
                $result_users=mysql_query($str,$mysql);
                $data_users=mysql_fetch_row($result_users);
                echo '
                  <tr><td><p>用户名：'.htmlspecialchars($data_users[0]).'</p></td></tr>
                  <tr><td><p>真实姓名：'.htmlspecialchars($data_users[4]).'</p></td></tr>
                  <tr><td><p>用户类型：'.GetGroupName($data_users[3]).'</p></td></tr>
                  <tr><td><p>注册时间：'.$data_users[1].'</p></td></tr>
                  <tr><td><p>最后一次登录时间：'.$data_users[2].'</p></td></tr>
                  <tr><td><p>邮箱：'.htmlspecialchars($data_users[5]).'</p></td></tr>
                ';
                mysql_close($mysql);
              }
            ?>
          </table></td></tr>