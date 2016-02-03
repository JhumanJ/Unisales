<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 29/01/16
 * Time: 12:40
 */?>



<div class="container">

    <?php

        //If user connects for the first time
        if ($user->getUserStatus()==2) {
            $message = new Alert("success",false);
            $message->addText('<p>Welcome '.$user->getFirstName().'!</p><p>Before your registration is fully completed, we need few more details...</p>');
            $message->show();
        }

    ?>



</div>
