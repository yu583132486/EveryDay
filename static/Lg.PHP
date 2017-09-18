<?php
$host = '127.0.0.1';
$dbuser = 'root';
$dbpwd = 'root';
$db = 'nhdz';

$cont = new mysqli ($host,$dbuser,$dbpwd,$db);
if($cont -> connect_error) {
    die("链接失败：" . $cont -> connect_error);
};
$telp = $_REQUEST['telp'];
$pwd = $_REQUEST['pwd'];
$sql = "select * from user where telp= '".$telp."' and pwd = '".$pwd."'";

if ($result = $cont ->query($sql)){
    if($result -> num_rows) {
    	echo '成功';
    }
    else {
    	echo "用户名或密码错误";
    }
}
else {
	echo "查询语句错误" .$cont -> error;
}
$cont -> close();

?>
