<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>One Matel Indonesia | Login</title>

        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?php echo base_url(); ?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="<?php echo base_url(); ?>assets/vendors/animate.css/animate.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?php echo base_url(); ?>assets/build/css/custom.min.css" rel="stylesheet">
    </head>

    <body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                <div>
                    <img src="<?php echo base_url(); ?>assets/image/img_logo.png" alt="..." style="width: 40%">
                </div>
                </section>
                <section class="login_content">
                <form method="post">
                    <h1>Halaman Login</h1>
                    <div id="alerts">
                        <?php if($this->session->flashdata('success')) {
                            echo '<div class="alert alert-success alert-message">';
                            echo $this->session->flashdata('success');
                            echo '</div>';
                        } ?>
                        <?php if($this->session->flashdata('warning')) {
                            echo '<div class="alert alert-warning alert-message">';
                            echo $this->session->flashdata('warning');
                            echo '</div>';
                        } ?>
                        <?php if($this->session->flashdata('danger')) {
                            echo '<div class="alert alert-danger alert-message">';
                            echo $this->session->flashdata('danger');
                            echo '</div>';
                        } ?>
                    </div>
                    <div>
                        <input type="text" name="username" class="form-control" placeholder="Username" />
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>
                    <div>
                        <button name="submit" value="Submit" type="submit" class="btn btn-default btn-block btn-flat">Masuk</button>
                        <!-- <a class="reset_pass" href="#">Lupa Password ?</a> -->
                    </div>

                    <div class="clearfix"></div>
                    <br />
                    <div>
                        <h1>One Matel Indonesia</h1>
                        <p>©2020 All Rights Reserved.</p>
                    </div>

                    
                </form>
                </section>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/build/js/custom.min.js"></script>

    <script type="text/javascript">
        $('.alert-message').alert().delay(3000).slideUp('slow');
    </script>
    </body>
</html>
