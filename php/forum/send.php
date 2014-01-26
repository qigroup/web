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
    <h1>发表内容</h1>
    <?php
    if(!isset($_POST["topic"]))
      echo '<h4>未指定主题，提交失败</h4>';
    else if(!isset($_POST["floor"]))
      echo '<h4>未指定层，提交失败</h4>';
    if($_POST["verifycode"]!=$_SESSION["verifycode".$_POST["random"]]||$_POST["verifycode"]=="")
      echo "<h4>验证码错误，提交失败</h4>";
    else if($_POST["content"]=="")
      echo "<h4>内容为空，提交失败</h4>";
    else
      {
        $mysql=mysql_connect(MYSQL_HOSTNAME,MYSQL_USERNAME,MYSQL_PASSWORD);
        $str='SELECT Count FROM Topic WHERE ID='.$_POST["topic"].' AND Status!=-1';
        mysql_select_db(MYSQL_FORUM_DB,$mysql);
        if(!$result_topic=mysql_query($str,$mysql))
          echo '<h4>主题无效，提交失败</h4>';
        else
          {
            $data_topic=mysql_fetch_row($result_topic);
            if($_POST["floor"]>$data_topic[0])
              echo '<h4>层数错误，提交失败</h4>';
            else
              {
                if($_POST["floor"]==$data_topic[0])
                  {
                    $str='UPDATE Topic SET Count='.($_POST["floor"]+1).' WHERE ID='.$_POST["topic"];
                    mysql_unbuffered_query($str,$mysql);
                  }
                $str='INSERT INTO Topic_'.$_POST["topic"].' (Floor,UserID,Time,Content) VALUES ('.$_POST["floor"].','.$_SESSION["login"].',"'.GetTimestamp().'","'.mysql_real_escape_string($_POST["content"]).'")';
                mysql_unbuffered_query($str,$mysql);
                $str='UPDATE Topic SET LastUpdateTime="'.GetTimestamp().'" WHERE ID='.$_POST["topic"];
                mysql_unbuffered_query($str,$mysql);
                echo '<h4>提交成功</h4>';
              }
          }
        mysql_close($mysql);
      }
    unset($_SESSION["verifycode".$_POST["random"]]);
    ?>
<?php
require DOCUMENT_ROOT.'php/basic/bottom.php';
?>
