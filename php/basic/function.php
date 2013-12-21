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
?>