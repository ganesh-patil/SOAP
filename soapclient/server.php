<?php


function create($user) {
    $link = mysql_connect('localhost', 'root', 'webonise6186');

    if (!$link) {
        return 0;
    }
    $db_selected=mysql_select_db('soapserver',$link);
    if (!$db_selected) {
        return 0;
    }
    $username=$user['username'];
    $password=$user['password'];
    $token=mt_rand(50,100);
    $query="INSERT  INTO users  SET username='$username',password='$password' ,token=$token ";
    $result=mysql_query($query);
    return mysql_insert_id();
}

function login($userDetails) {
    $link = mysql_connect('localhost', 'root', 'webonise6186');

    if (!$link) {
        return "could not connect";
    }
    $db_selected=mysql_select_db('soapserver',$link);
    if (!$db_selected) {
        return "Not able to select database";
    }
    $username=$userDetails['username'];
    $password=$userDetails['password'];
    $query="SELECT * FROM  users WHERE username= '$username' AND password= '$password' ";
    $result=mysql_query($query);
    $new=array();
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
        $new=$row[3];
    }
    return $new;
}

function update($userDetails) {
    $link = mysql_connect('localhost', 'root', 'webonise6186');

    if (!$link) {
        return 0;
    }
    $db_selected=mysql_select_db('soapserver',$link);
    if (!$db_selected) {
        return 0;
    }
    $token=$userDetails['token']['token'];
    $username=$userDetails['user']['username'];
    $password=$userDetails['user']['password'];
    $query="UPDATE users  SET username='$username' ,password='$password' WHERE token= $token ";
    $result=mysql_query($query);
    return $result;
}
function delete($token) {
    $link = mysql_connect('localhost', 'root', 'webonise6186');

    if (!$link) {
        return 0;
    }
    $db_selected=mysql_select_db('soapserver',$link);
    if (!$db_selected) {
        return 0;
    }
    $query="DELETE  FROM users  WHERE token= '$token'";
    $result=mysql_query($query);
    return $result;
}

$server = new SoapServer("myxml.wsdl");
$server->addFunction(array("login","create","update","delete"));
$server->handle();


?>