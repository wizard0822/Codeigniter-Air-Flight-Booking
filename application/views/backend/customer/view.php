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


        User


        <small>Details</small>


      </h1>


      <ol class="breadcrumb">


        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>


        <li class="active">User Details</li>


      </ol>

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
              <h3 class="box-title"> Details User</h3>
              <div class="col-md-3 pull-right" ><a href="<?php echo $base_url;?>/admin/customer" class="btn pull-right btn-primary">Back</a></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="box-body">
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Name</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $value['firstname'].' '.$value['lastname'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Email</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $value['email_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Phone Number</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $value['country_code'].' '.$value['telephone'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Status</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php if($value['active']==1){echo 'Active';} else if($value['active']==0){echo 'Inactive';}?>" readonly="readonly">
                      
                      </div>
                  </div>
                  
                </div>
                <!-- /.box-body -->
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
      CKEDITOR.replace( 'description' );
</script>
<script type="text/javascript">
    $("#question_edit").validate({
        errorElement: 'span',
        errorClass: 'customerror',
        rules: {
            
           name: {
               required: true
           },
           link: {
               url: true,
               required:true
           }
        },
        messages: {
         
          name: {
             required: "Please provide name!"
          },
          link: {
             required: "Please provide link!",
             url: "Please provide link with http:// format!"
          }

        }
    });
    
    
</script>

</body>


</html>


