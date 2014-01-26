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
require '/var/www/php/basic/head.php';
?>
		
<?php 
require '/var/www/php/basic/top.php';
?>


CREATE TABLE T_ID(_yafloor) ( ID bigint NOT NULL AUTO_INCREMENT,  Content blob NULL DEFAULT NULL, Info blob NULL DEFAULT NULL, Status int NULL DEFAULT 0,  BeginTime timestamp NULL DEFAULT NULL, LastUpdateTime timestamp NULL DEFAULT NULL,Count bigint NULL,PRIMARY KEY (ID) );
<?php 
require '/var/www/php/basic/bottom.php';
?>
