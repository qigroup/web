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
    <table class="border" style="margin:0 auto;">
      <tr><th><h1>查看用户资料</h1></th></tr>
      <?php
      $mysql=mysql_connect(MYSQL_HOSTNAME,MYSQL_USERNAME,MYSQL_PASSWORD);
      if(!is_numeric($_GET["user"]))
        $user=-1;
      else
        $user=(int)$_GET["user"];
      $str='SELECT Name,RegisterTime,UserGroup From users WHERE ID='.$user;
      mysql_select_db(MYSQL_BASIC_DB,$mysql);
      $result_users=mysql_query($str,$mysql);
      if($data_users=mysql_fetch_row($result_users))
        {
          echo '
            <tr><td><p>用户名：'.htmlspecialchars($data_users[0]).'</p></td></tr>
            <tr><td><p>用户类型：'.GetGroupName($data_users[2]).'</p></td></tr>
            <tr><td><p>注册时间：'.$data_users[1].'</p></td></tr>
          ';
        }
      else
        echo '<tr><th><h3>此用户不存在</h3></th></tr>';
      mysql_close($mysql);
      ?>
    </table>
