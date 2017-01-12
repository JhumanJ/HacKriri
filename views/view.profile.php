<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 11/01/17
 * Time: 18:45
 */

global $user;
?>


<div class="col-sm-8 col-sm-offset-2 col-xs-12">


    <?php
        Alert::displayMessage();
    ?>

    <h1><?php echo $user->getUserName();?>'s profile</h1>

    <?php
    if (isLogged() && user()->getId()==$user->getId()){
        ?>
        <form method="post" action="profile">
            <input name="_method" type="hidden" value="modify" />
            <input name="_id" type="hidden" value="<?php echo $user->getId(); ?>" />
            <button class="btn btn-xs btn-primary" type="submit">Edit my profile</button>
        </form>
        <br>
        <?php
    }
    ?>

    <div class="container-fluid">
        <img style="width: 200px;" class="img-circle img-center" src="<?php echo $user->getImgURL() ?>">
        <p><b>User Name</b>: <?php echo $user->getUserName() ?></p>
        <p><b>Description</b>:<span style="color:#<?php echo $user->getProfileColour() ?>;"> <?php echo $user->getDescription() ?></span></p>
        <p><b>URL</b>: <a href="<?php echo $user->getHomePageURL() ?>" target="_blank"><?php echo $user->getHomePageURL() ?></a></p>

    </div>

    



</div>

