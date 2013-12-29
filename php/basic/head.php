<?php
/*  Copyright 2012-2013 Qi Group
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
require 'config.php';
?>
<?php
require $document_root."php/basic/function.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<?php
session_start();
if(!isset($_SESSION["login"]))
	$_SESSION["login"]=-1;
else 
	{
	$_SESSION["login"]--;
	$_SESSION["login"]++;
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta name="keywords" content="XX,Qi,歧" />
		<link rel="icon" href="/images/Qi_25.png" />
		<link rel="shortcut icon" href="/images/Qi_25.png" />
		<link rel="bookmark" href="/images/Qi_25.png" />
		<title><?php echo (isset($title)? "歧-".$title:"歧")?></title>
		<style type="text/css">
			h1,h2,h3,h4,h5,h6
				{
				text-align:center;
				}
			.TCenter
				{
				text-align:center;
				}
			hr
				{
				color:#F3F3F3;
				}
			td p
				{
				margin:0;
				}
			.close
				{
				margin:0;
				}
			td
				{
				vertical-align:top;
				}
			table
				{
				table-layout:fixed;
				word-wrap:break-word;
				}
			.border
				{
				border:2px solid;
				border-radius:2em;
				padding:2em;
				}
		</style>
