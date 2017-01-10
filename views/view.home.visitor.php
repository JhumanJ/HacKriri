<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 29/01/16
 * Time: 12:39
 */ ?>

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


        </div>
    </div>
