<!DOCTYPE html>


<html>


<?php echo $header;?>


<body class="hold-transition skin-blue sidebar-mini">


<div class="wrapper">





<?php echo $top_menu;?>


<?php echo $left_nav;?>





  <!-- Content Wrapper. Contains page content -->


  <div class="content-wrapper">


    <!-- Content Header (Page header) -->


    <section class="content-header">


      <h1>


        Conatact Us Content


        <small> Add</small>


      </h1>


      <ol class="breadcrumb">


        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>


        <li class="active">Content - Add</li>


      </ol>
      <?php if ($this->session->flashdata('sess_message')) { ?>
        <div  class="pull-left label label-success" style="margin-top: 2px; margin-left: 200px;font-size: 14px;"> 
            <?php echo $this->session->flashdata('sess_message'); ?>
        </div>
      <?php } elseif ($this->session->flashdata('err_message')) { ?>
          <div  class="pull-left label label-danger" style="margin-top: 2px; margin-left: 200px;font-size: 14px;"> 
              <?php echo $this->session->flashdata('err_message'); ?>
          </div>
      <?php } ?>

    </section>





    <!-- Main content -->


    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add Contact us Content</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <form class="form-horizontal" action="<?php echo $base_url; ?>admin/contact_us_content/add" method="post" id="content_add" name="content_add" enctype="multipart/form-data" >
                <div class="box-body">
                 <div class="form-group">
                    <label for="type" class="control-label col-md-3">Address</label>
                    <div class="col-md-9">
                    <input type="text" name="address" id="address" class="form-control" value="" placeholder="Enter Address">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Phone</label>
                    <div class="col-md-9">
                    <input type="text" name="phone" id="phone" class="form-control" value="" placeholder="Enter Phone Number">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Email</label>
                    <div class="col-md-9">
                    <input type="text" name="email" id="email" class="form-control" value="" placeholder="Enter Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Business Hours</label>
                    <div class="col-md-9">
                   <textarea name="business_hours" id="hours" class="form-control form-control-lg"></textarea>
                    </div>
                </div>
                 
                  <div class="form-group">
                    <label for="status" class="control-label col-md-3">Status</label>
                    <div class="col-md-9">
                    <select class="form-control" name="status" id="status" style="width:50%">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                      
                    </select>
                    </div>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" name="submit" id="submit" value="submit">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
 
  <!-- /.content-wrapper -->


    <!-- /.content -->


  </div>


  <!-- /.content-wrapper -->





  <?php echo $footer_content;?>





</div>


<!-- ./wrapper -->





<?php echo $footer;?>
<style type="text/css">
    .customerror{
        color: red;
    }
</style>
<script src="https://cdn.ckeditor.com/4.11.0/standard/ckeditor.js"></script>
<script>
      CKEDITOR.replace( 'hours' );
</script>
<script type="text/javascript">
    $("#content_add").validate({
        errorElement: 'span',
        errorClass: 'customerror',
        rules: {
            
           address: {
               required: true
           },
           email: {
               required: true,
               email: true
           },
           phone: {
               required: true
           }
        },
        messages: {
         
          address: {
             required: "Address is required!"
          },
          email: {
             required: "Email is required!",
             email: "Please enter valid email"
          },
          phone: {
             required: "Phone is required!"
          },
        }
    });
    
</script>

</body>


</html>


