<?php
try
{
$db = new PDO('mysql:host=localhost;dbname=phpblog;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $exception)
{
die( 'Erreur : ' . $exception->getMessage() );

}



?>
