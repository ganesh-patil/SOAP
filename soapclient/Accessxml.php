<?php
$soap = new SoapClient("myxml.wsdl");
echo $soap->getPuzzle("1");
?>

