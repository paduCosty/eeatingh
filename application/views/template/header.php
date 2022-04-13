<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        <?php require_once("public/script/mail_validation.js");?>
    </script>

</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <form>
            <div class="navbar-header"><a class="navbar-brand " href="<?php echo base_url(); ?>">Eeatingh</a>
            </div>
            <?php if ($this->session->userdata('isUserLoggedIn')) { ?>
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo base_url(); ?>add_product"> Add Product </a></li>
                    <li><a href="<?php echo base_url(); ?>product_list"> Product List </a></li>
                </ul>
            <?php } ?>
            <ul class="nav navbar-nav navbar-right">

                <?php if (!$this->session->userdata('isUserLoggedIn')) { ?>
                    <li><a href="<?php echo base_url(); ?>users/registration"><span
                                    class="glyphicon glyphicon-user"></span> Sign Up</a>
                    </li>
                    <li><a href="<?php echo base_url(); ?>users/login">
                            <span class="glyphicon glyphicon-log-in"></span> Login</a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="<?php echo base_url('users/account'); ?>">
                            <span class="glyphicon glyphicon-user"></span> Account
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('users/logout'); ?>">
                            <span class="glyphicon glyphicon-log-out"></span> Log Out
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </form>
    </div>

</nav>
<div style="margin-bottom: 251px;">

</div>
</body>


