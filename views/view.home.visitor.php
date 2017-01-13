<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 29/01/16
 * Time: 12:39
 */

global $userManager;
global $snippetManager;
?>

    <div class="container">

        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-sm-12">

            <?php
                Alert::displayMessage();
            ?>

            <h1 class="text-center"> HacKriri </h1>

            <form action="index" method="post" id="loginForm">

                <div class="form-group">
                    <label for="userName">User name:</label>
                    <input type="text" class="form-control" placeholder="User Name" name="userName" required>
                </div>

                <div class="form-group">
                    <label for="passWord">Password:</label>
                    <input type="password" class="form-control" placeholder="Password" name="passWord" required>
                </div>

                <input type="hidden" name="login" value="111">

                <button type="submit" class="btn btn-primary center-block">Login</button>
                <br>
                <a href="register.php"><p class="text-center">Click Here to register</p></a>

            </form>

            <h4>User List</h4>
            <table class="table table-hover">
                <tr>
                    <th class="text-center">UserName</th>
                    <th class="text-center">Last Snippet Created</th>
                    <th class="text-center">Link to Profile</th>
                </tr>
                <?php
                foreach ($userManager->getAll() as $user){
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $user->getUserName(); ?></td>
                        <td class="text-center"><a href="snippet?id=<?php echo $snippetManager->lastSnippet($user)->getId(); ?>"><?php echo $snippetManager->lastSnippet($user)->getTitle() ?></a></td>
                        <td class="text-center">
                            <form method="GET" action="profile.php">
                                <input name="user" type="hidden" value="<?php echo $user->getUserName(); ?>" />
                                <button class="btn btn-xs btn-primary" type="submit"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></button>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>


        </div>
    </div>
