<?php 
use app\classes\Crypt;

$name = "jacouille";
$crypt = new Crypt($name);
echo "Nom utilisateur = ".$crypt->s_crypt();

?>