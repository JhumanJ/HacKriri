<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 11/01/17
 * Time: 15:59
 */


global $user;
?>

<div class="col-sm-8 col-sm-offset-2 col-xs-12">


    <?php
    Alert::displayMessage();
    ?>

    <h1>Modify profile: <?php echo $user->getUserName();?></h1>


    <div class="container-fluid">

            <?php
                //If a message is set, display it
                Alert::displayMessage();
            ?>

            <form action="admin.user" method="post">

                <div class="form-group">
                    <label for="firstName">User Name:</label>
                    <input disabled type="text" class="form-control" placeholder="User Name" name="userName" required value="<?php echo $user->getUserName(); ?>">
                </div>

                <div class="form-group">
                    <label for="firstName">IMG url:</label>
                    <input type="text" class="form-control" placeholder="IMG url" name="imgURL"  value="<?php echo $user->getImgURL(); ?>">
                </div>

                <div class="form-group">
                    <label for="firstName">Home Page url:</label>
                    <input type="text" class="form-control" placeholder="Home Page url" name="homePageURL"  value="<?php echo $user->getHomePageURL(); ?>">
                </div>

                <div class="form-group">
                    <label for="firstName">Profile Colour (hexadecimal code):</label>
                    <input type="text" class="form-control" placeholder="Profile Colour" name="profileColour"  value="<?php echo $user->getProfileColour(); ?>">
                </div>

                <div class="form-group">
                    <label for="firstName">Description:</label>
                    <textarea type="text" class="form-control" placeholder="Description" name="description" ><?php echo $user->getDescription(); ?></textarea>
                </div>

                <input type="hidden" name="_method" value="update">
                <input type="hidden" name="_id" value="<?php echo $user->getId(); ?>">

                <input type="hidden" name="csrf" value="<?php echo $_SESSION["token"]; ?>">

                <button id="submitBtn" class="btn btn-primary center-block" type="submit">Update <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
                </button>
            </form>

    </div>

</div>

