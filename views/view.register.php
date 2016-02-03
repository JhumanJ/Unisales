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

        <h1>Unisales | Register</h1>
        <form action="register" method="post" id="registerForm">

            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" class="form-control" placeholder="First Name" name="firstName" required <?php
                    if (isset($correctFields) && isset($correctFields['firstName'])) {
                        echo 'value="'.$correctFields['firstName'].'""';
                    }
                ?>>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" class="form-control" placeholder="Last Name" name="lastName" required <?php
                if (isset($correctFields) && isset($correctFields['lastName'])) {
                    echo 'value="'.$correctFields['lastName'].'""';
                    }
                ?>>
            </div>

            <div class="form-group">
                <label for="university">University:</label>
                <select class="form-control" name="university" required>
                    <option value="UCL">UCL (University College London)</option>
                    <option disabled>Coming soon to your university</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Email" aria-describedby="basic-addon2" name="email" required <?php
                    if (isset($correctFields) && isset($correctFields['email'])) {
                        echo 'value="'.$correctFields['email'].'""';
                    }
                    ?>>
                    <span class="input-group-addon" id="basic-addon2">@ucl.ac.uk</span>
                </div>
            </div>

            <div class="form-group">
                <label for="passWord">Password:</label>
                <input id="passWord" type="password" class="form-control" placeholder="Password" name="passWord" required>
            </div>

            <div class="form-group">
                <label for="passWordConfirm">Confirm password:</label>
                <input id="passWordConfirm" type="password" class="form-control" placeholder="Password" name="passWordConfirm" required>
            </div>

            <input type="hidden" name="register" value="111">

        </form>

        <button id="submitBtn" class="btn btn-primary center-block">Register</button>

    </div>
</div>

