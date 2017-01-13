<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 13/01/17
 * Time: 14:45
 */


require("header.php");
$dbFactory = new DBFactory();
$db = $dbFactory->getMysqlConnexionWithPDO();


if(!isLogged()){
    // ------------ User is not logged -------------
    $message = new Alert('danger', true);
    $message->addText('<strong>Whoops</strong>! You can\'t be there.');
    $message->messageToSession();
    header("Location: index.php");
    exit();
}

if(isset($_POST["_method"])) {

} else{
    createPage('file');
}

$directory = 'uploads/';
$fichier = basename($_FILES['profile']['name']);
$taille_maxi = 100000;
$taille = filesize($_FILES['profile']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg');
$extension = strrchr($_FILES['profile']['name'], '.');
//Début des vérifications de sécurité...
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
    $erreur = 'wrong file type';
}
if($taille>$taille_maxi)
{
    $erreur = 'file too big';
}
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
    //On formate le nom du fichier ici...
    $fichier = strtr($fichier,
        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
    if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
    {
        echo 'success !';
    }
    else //Sinon (la fonction renvoie FALSE).
    {
        echo 'try again';
    }
}
else
{
    echo $erreur;
}
?>