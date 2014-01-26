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
  </head>
  <body class="close">
    <table style="width:100%"><tr>
        <td style="text-align:left;"><p><small><a href="/">主页</a>|<a href="/php/forum/" title="歧论坛">论坛</a>|<a href="/php/left/">留言册</a>|<a href="/php/doc/manual.php">人工服务指南</a></small></p></td>
      <?php
      if($_SESSION["login"]==-1)
        echo '<td style="text-align:right;"><p><small><a href="/php/user/login/">登录</a>|<a href="/php/user/register/">注册</a></small></p></td>';
      else
        {
          $mysql=mysql_connect(MYSQL_HOSTNAME,MYSQL_USERNAME,MYSQL_PASSWORD);
          $str='SELECT Name FROM users WHERE ID='.$_SESSION["login"];
          mysql_select_db(MYSQL_BASIC_DB,$mysql);
          $result_users=mysql_query($str,$mysql);
          $data_users=mysql_fetch_row($result_users);
          echo '
            <td style="text-align:right;"><p><small><a href="/php/user/config/" title="用户控制中心">'.htmlspecialchars($data_users[0]).'</a>|<a href="/php/user/logout/">注销</a></small></p></td>
          ';
        }
      mysql_close($mysql);
      ?>
    </tr></table>
    <hr style="margin-left:0;margin-right:0;margin-top:0;" />
