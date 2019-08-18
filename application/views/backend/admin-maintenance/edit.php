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


        Admin


        <small> Edit</small>


      </h1>


      <ol class="breadcrumb">


        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>


        <li class="active">Admin - Edit</li>


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
              <div class="row">
                <div class="col-md-9"> <h3 class="box-title">Edit Admin</h3></div>
                <div class="col-md-3 pull-right" ><a href="<?php echo $base_url;?>admin/admin-maintenance" class="btn pull-right btn-primary">Back</a></div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <form class="form-horizontal" autocomplete="off" action="<?php echo $base_url; ?>admin/admin-maintenance/edit/<?php echo base64_encode($details[0]['id']);?>" method="post" id="admin_edit" name="admin_edit" enctype="multipart/form-data" >
                <div class="box-body">
                 <div class="form-group">
                    <label for="type" class="control-label col-md-3">First Name</label>
                    <div class="col-md-9">
                    <input type="text" name="f_name" id="f_name" class="form-control" placeholder="Enter First Name" value="<?php echo $details[0]['f_name'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Last Name</label>
                    <div class="col-md-9">
                    <input type="text" name="l_name" id="l_name" class="form-control" placeholder="Enter Last Name" value="<?php echo $details[0]['l_name'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Email</label>
                    <div class="col-md-9">
                    <input type="hidden" name="id" id="id" class="form-control"  placeholder="Enter Email" value="<?php echo $details[0]['id'];?>">
                    <input type="text" name="email" id="email" class="form-control" value="<?php echo $details[0]['email'];?>">
                    <label
                            style="color: #c10000;font-size: 0.9em;line-height: 18px;padding: 5px 0 0; display: none;"
                            id="invalid_email" for="emailid">Email-id is invalid</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Username</label>
                    <div class="col-md-9">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" value="<?php echo $details[0]['username'];?>">
                    </div>
                </div>
                 <!-- <div class="form-group">
                      <label class="control-label col-md-3">Image</label>
                      <div class="col-md-9">
                          <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                  <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                              <div>
                                  <span class="btn default btn-file">
                                      <span class="fileinput-new"> Select image </span>
                                      <span class="fileinput-exists"> Change </span>
                                      <input type="file" name="image" id="image" required=""> </span>
                                  <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                              </div>
                          </div>
                          <!-- <div class="clearfix margin-top-10">
                              <span class="label label-danger">NOTE!</span> Image preview only works in IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+. In older browsers the filename is shown instead. </div> -->
                      <!-- </div>
                  </div> --> 
                  <div class="form-group">
                              <label for="status" class="control-label col-md-3">Status</label>
                              <div class="col-md-9">
                              <select class="form-control" name="status" id="status" style="width:50%">
                                <option <?php if($details[0]['status']==1){?>selected<?php } ?> value="1">Active</option>
                                <option <?php if($details[0]['status']==0){?>selected<?php } ?> value="0">Inactive</option>
                                
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
    .input_with_eye{
    position: relative;
   }
  .input_with_eye .custom_button_eye{
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
   }
</style>
<script type="text/javascript">
$(document).ready(function() {
    $("#admin_edit").validate({
      errorElement: 'span',
        errorClass: 'customerror',
        rules: {
            f_name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "<?php echo base_url();?>admin/admin_maintenance/register_edit_email_exists/<?php echo $details[0]['id'];?>",
                    type: "post",
                    data: {
                        email: function() {
                            return $("#email").val();
                        }
                    }
                }
            },
            username: {
                required: true
            }
        },
        messages: {
            fname: {
                required: "First name field is required"
            },
            email: {
                required: "Email field is required",
                email: "Please enter valid email",
                remote: 'Email already used. Add admin with another account.'
            },
            username: {
                required: "Username field is required",
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    $('#submit').click(function() {
        var emailid = $('#email').val();
        if (emailid != '') {
            if (IsEmail(emailid) == false) {
                $('#invalid_email').css("display", "block");;
                return false;
            }
        }
    });
});

function IsEmail(emailid) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(emailid)) {
        return false;
    } else {
        return true;
    }
}
</script>

</body>


</html>


