<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 29/01/16
 * Time: 12:02
 */?>

<!-- A bit of jquery just to check the form -->


<script>
    $(document).ready(function() {

        $("#submitBtn").click(function () {

            var $form = $("#registerForm");
            var $inputs = $("#registerForm :input");
            var submitBool = true;

            //Check that no fiels are empty
            $inputs.each(function () {
                if (isEmpty($(this).val()) || !checkLenght($(this).val(),3,25)) {
                    submitBool = false;
                    console.log("Error input");

                    $(this).addClass("hasError");
                } else {
                    $(this).removeClass("hasError");
                    $(this).addClass("hasNoError");
                }

            })

            if ($("#passWord").val()!=$("#passWordConfirm").val()) {
                submitBool = false;
                $("#passWordConfirm").removeClass("hasNoError");
                $("#passWordConfirm").addClass("hasError");
                console.log('PassWord not equal');
            }

            console.log(submitBool);

            if (submitBool) {
                $form.submit();
            }


        })

    });
</script>
<div class="container-fluid">
    <div class="col-md-offset-3 col-md-6 col-sm-8 col-sm-offset-2 col-xs-12 container-fluid">

        <?php
            //If a message is set, display it
            Alert::displayMessage();

            //Retrive correct fields if exists
            if (isset($_SESSION['correctFields'])) {
                $correctFields = $_SESSION['correctFields'];
                unset($_SESSION['correctFields']);
            }
        ?>

        <h1>HacKriri</h1>
        <form action="register.php" method="post" id="registerForm">

            <div class="form-group">
                <label for="firstName">UserName:</label>
                <input type="text" class="form-control" placeholder="First Name" name="userName" required <?php
                    if (isset($correctFields) && isset($correctFields['firstName'])) {
                        echo 'value="'.$correctFields['firstName'].'""';
                    }
                ?>>
            </div>

            <div class="form-group">
                <label for="passWord">Password:</label>
                <input id="passWord" type="password" class="form-control" placeholder="Password" name="passWord" required>
            </div>

            <div class="form-group">
                <label for="passWordConfirm">Confirm password:</label>
                <input id="passWordConfirm" type="password" class="form-control" placeholder="Password" name="passWordConfirm" required>
            </div>
            <input type="hidden" name="csrf" value="<?php echo $_SESSION["token"]; ?>">

            <input type="hidden" name="register" value="111">

            <button id="submitBtn" class="btn btn-primary center-block">Register</button>

        </form>


    </div>
</div>

