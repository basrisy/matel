<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <!-- <link rel="icon" href="images/favicon.ico" type="image/ico" /> -->

    <title>One Matel Indonesia</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap datepicker -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url(); ?>assets/vendors/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables/extensions/FixedHeader/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables/extensions/Scroller/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>assets/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

        <?php echo $nav; ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <?php echo $content; ?>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            One Matel Indonesia - ©2020 All Rights Reserved. <a href="#">v.202003.002</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/vendors/iCheck/icheck.min.js"></script>
    <!-- CKEditor -->
    <script src="<?php echo base_url(); ?>assets/vendors/ckeditor/ckeditor.js"></script>
    <!-- bootstrap datepicker -->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url(); ?>assets/vendors/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables/extensions/Buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables/extensions/Buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables/extensions/Buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables/extensions/Responsive/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/build/js/custom.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
      //datatables
      var table = $('#table').DataTable({ 
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        processing: true, 
        serverSide: true, 
        order: [], 
          
        ajax: {
          url: "<?php echo site_url('data/get_data_kendaraan')?>",
          type: "POST"
        },

          
        columnDefs: [
          { 
            targets: [ 0 ], 
            orderable: false, 
          },
        ],
        language: {
          url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
        },
        fixedHeader: true
      });

      $('#tabledata').dataTable( {
          lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
          processing: true,
          serverSide: false,
          language: {
            url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
          },
          fixedHeader: true
      });
      //Alert
      $('.alert-message').alert().delay(3000).slideUp('slow');
      $('.toast').fadeIn(400).delay(3000).fadeOut(400);   
    });

    //Date picker
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
    });

    // Show Password
    $('.form-checkbox').click(function(){
      if($(this).is(':checked')){
        $('.password').attr('type','text');
      }else{
        $('.password').attr('type','password');
      }
    });
    </script>
	
  </body>
</html>
