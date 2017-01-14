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
    if($_POST["_method"]=="upload"){

        $types = array('.png', '.gif', '.jpg', '.jpeg');
        $type = strrchr($_FILES['fileToUpload']['name'], '.');
        if(1) {
            $sizeMax = 100000;
            $size = filesize($_FILES['fileToUpload']['tmp_name']);
            if($sizeMax>$size){
                $path = 'storage/'.user()->getId().'/';
                if (!file_exists ( $path )){
                    mkdir($path);
                }
                $filename = strtr(basename($_FILES['fileToUpload']['name']), 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                $filename = preg_replace('/([^.a-z0-9]+)/i', '-', $filename);
                if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $path.$filename))
                {
                    $message = new Alert('success', true);
                    $message->addText('<strong>Yes</strong>! we saved your thing.');
                    $message->messageToSession();
                    header("Location: file.php");
                }else{
                    $message = new Alert('danger', true);
                    $message->addText('<strong>Whoops</strong>! Something wrong happened.');
                    $message->messageToSession();
                    header("Location: file.php");
                }
            }else{
                $message = new Alert('danger', true);
                $message->addText('<strong>Whoops</strong>! File size too big.');
                $message->messageToSession();
                header("Location: file.php");
            }
        }else{
            $message = new Alert('danger', true);
            $message->addText('<strong>Whoops</strong>! Wrong type of file.');
            $message->messageToSession();
            header("Location: file.php");
        }
    }else {
        $message = new Alert('danger', true);
        $message->addText('<strong>Whoops</strong>! Error.');
        $message->messageToSession();
        header("Location: file.php");
    }
} else{
    createPage('file');
}
//
//$directory = 'uploads/';
//$fichier = basename($_FILES['profile']['name']);
//$taille_maxi = 100000;
//$taille = filesize($_FILES['profile']['tmp_name']);
//$extensions = array('.png', '.gif', '.jpg', '.jpeg');
//$extension = strrchr($_FILES['profile']['name'], '.');
////Début des vérifications de sécurité...
//if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
//{
//    $erreur = 'wrong file type';
//}
//if($taille>$taille_maxi)
//{
//    $erreur = 'file too big';
//}
//if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
//{
//    //On formate le nom du fichier ici...
//    $fichier = strtr($fichier,
//        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
//        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
//    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
//    if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
//    {
//        echo 'success !';
//    }
//    else //Sinon (la fonction renvoie FALSE).
//    {
//        echo 'try again';
//    }
//}
//else
//{
//    echo $erreur;
//}
//?>