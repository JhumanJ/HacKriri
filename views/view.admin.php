<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 10/01/17
 * Time: 15:35
 */

global $userManager;
?>

<div class="col-sm-8 col-sm-offset-2 col-xs-12">


    <?php
        Alert::displayMessage();
    ?>

    <h1>Admin Page</h1>

    <h4>User List</h4>
    <table class="table table-hover">
        <tr>
            <th class="text-center">UserName</th>
            <th class="text-center">User Type</th>
            <th class="text-center">Upgrade to Admin</th>
            <th class="text-center">Publish Snippet</th>
            <th class="text-center">Delete</th>
        </tr>
            <?php
                foreach ($userManager->getAll() as $user){
                    ?>
                    <tr>
                        <th class="text-center"><?php echo $user->getUserName(); ?></th>
                        <th class="text-center"><?php echo $user->userType(); ?></th>
                        <th class="text-center">
                            <form method="post" action="admin.user">
                                <input name="_method" type="hidden" value="admin" />
                                <input name="_id" type="hidden" value="<?php echo $user->getId(); ?>" />
                                <button class="btn btn-xs btn-primary" type="submit" <?php if($user->isAdmin())echo'disabled'; ?>><span class="glyphicon glyphicon-star" aria-hidden="true"></span></button>
                            </form>
                        </th>
                        <th class="text-center">
                            <form method="post" action="admin.user">
                                <input name="_method" type="hidden" value="snippet" />
                                <input name="_id" type="hidden" value="<?php echo $user->canPublish(); ?>" />
                                <button class="btn btn-xs btn-<?php if($user->canPublish()){echo'success';}else{echo'danger';} ?>" type="submit" <?php if($user->isAdmin())echo'disabled'; ?>><span class="glyphicon glyphicon-<?php if($user->canPublish()){echo'ok';}else{echo'remove';} ?>" aria-hidden="true"></span></button>
                            </form>
                        </th>
                        <th class="text-center">
                            <form method="post" action="admin.user">
                                <input name="_method" type="hidden" value="delete" />
                                <input name="_id" type="hidden" value="<?php echo $user->getId(); ?>" />
                                <button class="btn btn-xs btn-danger" type="submit"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                            </form>
                        </th>
                    </tr>
                    <?php
                }
            ?>
    </table>




</div>

