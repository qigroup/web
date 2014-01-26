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
function random($length)
  {
  $num="0.";
  for($i=0;$i<$length;$i++)
    {
    $num.=mt_rand(0,9);
    }
  return $num;
  }

function passwdcrypt($password)
  {
  return hash("sha512",$password);
  }

function GetGroupName($groupid)
{
  switch($groupid)
    {
    case 0:
      $groupname="超级管理员";
      break;
    case 1:
      $groupname="高级管理员";
      break;
    case 10:
      $groupname="中级管理员";
      break;
    case 100:
      $groupname="未激活用户";
      break;
    case 1000:
      $groupname="普通用户";
      break;
    default:
      $groupname="未定义用户";
    }
  return $groupname;
}

function EchoVerifyCode()
{
  $random=random(17);
  echo '
    <input type="hidden" name="random" id="random" value="'.$random.'" />
    <img id="verifycode" src="/images/verifycode.php?id='.$random.'" alt="验证码" onclick="refresh()" style="border:0;width:69px;height:30px" />
    <small>（区分大小写）</small>
  ';
}

function GetTimestamp()
{
  $time=time();
  $timestamp=date("YmdHis",$time);
  return $timestamp;
}

function EchoPageIndex($current_page,$total_pages,$echo_pages,$url)
{
  $page=($current_page-$echo_pages/2>1)? ($current_page-$echo_pages/2):1;
  for($d0=0;$page<=$total_pages&&$d0<$echo_pages;$d0++,$page++)
    {
      if($page!=$current_page)
        echo '<a href="'.$url.'page='.$page.'">['.$page.']</a>';
      else
        echo '['.$page.']';
    }
}
?>