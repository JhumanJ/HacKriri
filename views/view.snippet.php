<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 12/01/17
 * Time: 18:55
 */
global $snippet;
global $author;
?>

<div class="col-sm-8 col-sm-offset-2 col-xs-12">


    <?php
    Alert::displayMessage();
    ?>

    <h1><?php echo $snippet->getTitle(); ?></h1>

    <p><?php echo $snippet->getContent();?></p>
    <p><b>Published the <?php echo $snippet->getPublishDate();?> by </b><a href="profile?user=<?php echo $author->getUserName();?>"><?php echo $author->getUserName();?></a></p>