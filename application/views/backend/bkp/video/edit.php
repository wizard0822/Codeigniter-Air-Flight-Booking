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


        Video Link


        <small>Edit</small>


      </h1>


      <ol class="breadcrumb">


        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>


        <li class="active">Video Link Edit</li>


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
              <h3 class="box-title"> Edit Video Link</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <form class="form-horizontal" action="<?php echo $base_url; ?>admin/video/edit/<?php echo base64_encode($list[0]['id']);?>" method="post" id="question_edit" name="question_edit" enctype="multipart/form-data" >
                <div class="box-body">
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Description</label>
                      <div class="col-md-9">
                      <input type="text" name="url" id="url" class="form-control" value="<?php echo $list[0]['url'];?>" placeholder="Enter Youtube Video Link">
                      <!-- <textarea name="description" id="description" row="5" col="5" class="form-control" placeholder="Enter Description"><?php echo $list[0]['description'];?></textarea> -->
                      
                      </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="status" class="control-label col-md-3">Status</label>
                    <div class="col-md-9">
                    <select class="form-control" name="status" id="status" style="width:50%">
                      <option <?php if($list[0]['status']==1){?>selected<?php } ?> value="1">Active</option>
                      <option <?php if($list[0]['status']==0){?>selected<?php } ?> value="0">Inactive</option>
                      
                    </select>
                    </div>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary pull-right" name="submit" id="submit" value="submit">Submit</button>
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


