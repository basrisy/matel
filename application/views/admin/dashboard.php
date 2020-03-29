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
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url(); ?>assets/vendors/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables/media/css/dataTables.checkboxes.css" rel="stylesheet">
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
            One Matel Indonesia - ©2020 All Rights Reserved. <a href="#">v.202003.008</a>
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
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url(); ?>assets/vendors/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables/media/js/dataTables.checkboxes.min.js"></script>
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
        fixedHeader: true,
        processing: true, 
        serverSide: true, 
        ordering: false,
        // order: [], 
          
        ajax: {
          url: "<?php echo site_url('data/get_data_kendaraan')?>",
          type: "POST",
          data: function ( data ) {
            data.leasing = $('#leasing').val();
            data.cabang = $('#cabang').val();
            data.update_at = $('#update_at').val();
            data.request = 1;
          }
        },
        columnDefs: [
          { 
            targets: [ 0 ], //first column / numbering column
            orderable: false //set not orderable
            // checkboxes: {
            //   selectRow: true
            // }
          },
        ],
        select: {
          'style': 'multi'
        },
        order: [[1, 'asc']],
        language: {
          url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
        },
      });
      $('#leasing').change(function(){
        var leasing = $('#leasing').val();
        if(leasing != ''){
          $.ajax({
            url:"<?php echo base_url(); ?>data/get_cabang",
            method:"POST",
            data:{leasing:leasing},
            success:function(data){
              $('#cabang').html(data);
            }
          });
        } else {
          $('#cabang').html('<option value="">Semua Cabang</option>');
        }
      });

      //  Filter Custom
      $('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload();  //just reload table
      });
      $('#btn-reset').click(function(){ //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload();  //just reload table
      });
      
      // Delete filter
      $('#btn-delete').click(function(){
        var confirmdelete = confirm("Anda benar-benar ingin menghapus data ini?");
        if (confirmdelete == true) {
          $.ajax({            
            url: "<?php echo site_url('data/get_data_kendaraan')?>",
            type: "POST",
            data:{
              request : 2,
              leasing : $('#leasing').val(),
              cabang : $('#cabang').val(),
              update_at : $('#update_at').val(),
            },
            success: function(response){
              $('#form-filter')[0].reset();
              table.ajax.reload();
            }
          });
        } 
      });

      // Check all 
      $('#checkall').click(function(){
          if($(this).is(':checked')){
            $('.delete_check').prop('checked', true);
          }else{
            $('.delete_check').prop('checked', false);
          }
      });
      // Delete record
      $('#delete_record').click(function(){

        var deleteids_arr = [];
        // Read all checked checkboxes
        $("input:checkbox[class=delete_check]:checked").each(function () {
          deleteids_arr.push($(this).val());
        });

        // Check checkbox checked or not
        if(deleteids_arr.length > 0){

          // Confirm alert
          var confirmdelete = confirm("Anda benar-benar ingin menghapus data ini?");
          if (confirmdelete == true) {
            $.ajax({
              url: '<?php echo site_url('data/get_data_kendaraan')?>',
              type: 'POST',
              data: {request: 3,deleteids_arr: deleteids_arr},
              success: function(response){
                table.ajax.reload();
              }
            });
          } 
        }
      });
      // Checkbox checked
      function checkcheckbox(){

        // Total checkboxes
        var length = $('.delete_check').length;

        // Total checked checkboxes
        var totalchecked = 0;
        $('.delete_check').each(function(){
          if($(this).is(':checked')){
              totalchecked+=1;
          }
        });

        // Checked unchecked checkbox
        if(totalchecked == length){
          $("#checkall").prop('checked', true);
        }else{
          $('#checkall').prop('checked', false);
        }
      }
      
      //datatables temp/preview
      var tablePreview = $('#preview').DataTable({ 
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        fixedHeader: true,
        processing: true, 
        serverSide: true, 
        order: [], 
          
        ajax: {
          url: "<?php echo site_url('data/preview_import')?>",
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
        }
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
