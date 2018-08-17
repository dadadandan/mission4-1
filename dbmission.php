<?php
$dsn="データベース";
$user="ユーザー名";
$password="パスワード";
$pdo=new PDO($dsn,$user,$password,array(
PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

$sql1="CREATE TABLE IF NOT EXISTS dbmission4"
."("
."id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,"

."PRIMARY KEY(id),"
."name char(32),"
."comment TEXT,"
."date TEXT,"
."pass TEXT"
.");";
$stmt=$pdo->query($sql1);


$sql2="SHOW TABLES";
$result2=$pdo->query($sql2);
foreach($result2 as $row){
echo$row[0];
echo"<br>";
}
unset($row);
echo"<hr>";

$sql3="SHOW CREATE TABLE dbmission4";
$result3=$pdo->query($sql3);
foreach($result3 as $row){
print_r($row);
}
unset($row);
echo"<hr>";


$name = "$_POST[name]";
$comment = "$_POST[comment]";
$date = date("Y/m/d H:i:s");
$delete = "$_POST[sakujo]";
$edit = "$_POST[henshuu]";
$pas1 = "$_POST[pass1]";
$pas2 = "$_POST[pass2]";
$pas3 = "$_POST[pass3]";
$name2="$_POST[name2]";
$comment2="$_POST[comment2]";

if(!empty($comment) and (!empty($pas1))){

$sql4=$pdo->prepare("INSERT INTO dbmission4(name,comment,date,pass)VALUES(:name,:comment,:date,:pass)");
$sql4->bindParam(':name',$name,PDO::PARAM_STR);
$sql4->bindParam(':comment',$comment,PDO::PARAM_STR);
$sql4->bindParam(':date',$date,PDO::PARAM_STR);
$sql4->bindParam(':pass',$pas1,PDO::PARAM_STR);
$sql4->execute();
}

if(!empty($delete)){
$sql6="SELECT*FROM dbmission4";
$result6=$pdo->query($sql6);
foreach($result6 as $row6){
if($row6['id'] == $delete){
if($row6['pass'] == $pas2){
$id="$delete";
$sql7="delete from dbmission4 where id=$id";
$result7=$pdo->query($sql7);
}
else{
echo'パスワードが違います';
}
}
}
}
if(!empty($edit)){
$sql8="SELECT*FROM dbmission4";
$result8=$pdo->query($sql8);
foreach($result8 as $row8){
if($row8['id'] == $edit){、
if($row8['pass'] == $pas3){
$id="$edit";
$nm="$name2";
$kome="$comment2";
$sql9="update dbmission4 set name='$nm',comment='$kome'where id=$id";
$result9=$pdo->query($sql9);
}
else{
echo'パスワードが違います';
}
}
}
}

?>



<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset = "UTF-8">
<title> mission 4 </title>
</head>
<body>
<form action = "mission 4.php", method = "post">

<p>名前<br>
<input type = "text" name = "name" placeholder="名前">
<p>コメント<br>
<input type = "text" name = "comment" placeholder="コメント">
<input ype = "text" name = "pass1" placeholder="パスワード">
<input type = "submit" value = "送信">
<br/>


<form action = "mission 4.php", method = "post">
<p>削除対象番号<br>
<input type = "text" name = "sakujo" placeholder="削除対象番号">
<input ype = "text" name = "pass2" placeholder="パスワード">
<input type = "submit" value = "送信">
<p>編集対象番号<br>
<input type = "text" name = "henshuu" placeholder="編集対象番号">
<input ype = "text" name = "pass3" placeholder="パスワード">
<input type = "text" name = "name2" placeholder="名前2">
<input type = "text" name = "comment2" placeholder="コメント2">
<input type = "submit" value = "送信">
</form>
</body>
</html>


<?php

$sql5="SELECT*FROM dbmission4 ORDER BY id";
$result5=$pdo->query($sql5);
foreach($result5 as $row5){
echo$row5['id'].',';
echo$row5['name'].',';
echo$row5['comment'].',';
echo$row5['date'].',';
echo$row5['pass'].'<br>';
}

?>
