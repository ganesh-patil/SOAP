<?php
$soap = new SoapClient("myxml.wsdl");
$user= array('username'=>'new_user','password'=>'new_ganesh');
try {
    if( $soap->create($user) !=0){
        echo "\n Creation successful \n";
    }
    else {
        echo "\n Creation error \n";
        return;
    }
//    echo "<pre>";
    $token=$soap->login($user);
  if($token !=0 ){
      echo "\n Logged in successfully \n";
  }
    else {
        echo "\n login error\n ";
   }
    $userDetails= array('username'=>'new_user1','password'=>'new_ganesh1');
    $userToken= array('token'=>$token);
    $user['user']=$userDetails;
    $user['token']=$userToken;
   if($soap->update($user) !=0 ){
       echo "\n profile update successful  \n";
   }
    else{
        echo "\n profile update error \n ";
    }

    if($soap->delete($token) !=0){
        echo "\n profile deleted successfully ";
    }
    else{
        echo "\n deletion error \n";
    }
}
catch (Exception $e){
    var_dump($e->getMessage);
}