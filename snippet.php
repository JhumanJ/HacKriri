<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 12/01/17
 * Time: 17:34
 */


require("header.php");
$dbFactory = new DBFactory();
$db = $dbFactory->getMysqlConnexionWithPDO();

//If user is logged, show the logged home page
//Otherwise show the visitor home page

if(isLogged()){

    if (isset($_GET["id"])){
        $snippetManager = new SnippetManager($db);
        $userManager = new UserManager($db);
        $snippet = $snippetManager->find((int)htmlspecialchars($_GET["id"]));
        $author = $userManager->find($snippet->getUserId());
        createPage('snippet');
        exit();
    }else if(isset($_POST["_method"])){
        if($_POST["_method"]=="create"){
            if(isset($_POST["title"]) && $_POST["title"]!=""){
                $title = htmlspecialchars($_POST["title"]);
            }
            if(isset($_POST["content"]) && $_POST["content"]!=""){
                $content = htmlspecialchars($_POST["content"]);
            }
            if(isset($content)&&isset($title)){
                //create snippet
                $snippetManager = new SnippetManager($db);
                $snippet = new Snippet($title,$content);
                $snippetManager->create($snippet);

                $message = new Alert('success', true);
                $message->addText('<strong>Yeah</strong>! Snippet created.');
                $message->messageToSession();
                header('Location: index.php');
                exit();

            } else{
                $message = new Alert('danger', true);
                $message->addText('<strong>Whoops</strong>! Error.');
                $message->messageToSession();
                header('Location: index.php');
                exit();
            }
        } else if($_POST["_method"]=="delete"){

            if(isset($_POST["_id"]) && $_POST["_id"]!=""){
                $snippetManager = new SnippetManager($db);
                $snippet = $snippetManager->find((int)htmlspecialchars($_POST["_id"]));
                $snippetManager->delete($snippet);

                $message = new Alert('success', true);
                $message->addText('<strong>Success</strong>! This snippet is gone for ever.');
                $message->messageToSession();
                header('Location: index.php');
                exit();
            }else {
                $message = new Alert('danger', true);
                $message->addText('<strong>Whoops</strong>! Error.');
                $message->messageToSession();
                header('Location: index.php');
                exit();
            }
        }
        else {
            $message = new Alert('danger', true);
            $message->addText('<strong>Whoops</strong>! Error.');
            $message->messageToSession();
            header('Location: index.php');
            exit();
        }
    }else{
        createPage('snippet.create');
    }

} else {
    $message = new Alert('danger', true);
    $message->addText('<strong>Whoops</strong>! You can\'t be there.');
    $message->messageToSession();
    header('Location: index.php');
    exit();

}