<?php
$mysql_server_name='localhost';

$mysql_username='root';

$mysql_password='123456';

$mysql_database='mydb';

$conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ; //�������ݿ�

mysql_query("set names 'utf8'");

mysql_select_db($mysql_database); //�����ݿ�


