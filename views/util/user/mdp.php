<?php 
use app\classes\Crypt;

$mdp = "gros";
$crypt = new Crypt($mdp);
echo "Mot de passe = ".$crypt->crypt();

?>