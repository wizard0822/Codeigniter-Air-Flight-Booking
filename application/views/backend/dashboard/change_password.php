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


        Dashboard


        <small>Change Password</small>


      </h1>


      <ol class="breadcrumb">


        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>


        <li class="active">Change Password</li>


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
              <h3 class="box-title">Change Password</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <form class="form-horizontal" action="<?php echo $base_url; ?>admin/dashboard/change_password/<?php echo $admin_id;?>" method="post" id="change_password_add" name="change_password_add" enctype="multipart/form-data" >
                <div class="box-body">
                  <div class="form-group">
                    <label for="name">Old Password</label>
                    <div class="position-relative input_with_eye"> 
                      <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Enter Old Password">
                      <span toggle="#password-field" class="fa fa-fw fa-eye field-icon custom_button_eye"
                              id="show_old_password"></span>
                    </div>
                  </div>
                  <div class="form-group">
                   <label for="name">New Password</label>
                   <div class="position-relative input_with_eye"> 
                      <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter New Password">
                      <span toggle="#password-field" class="fa fa-fw fa-eye field-icon custom_button_eye"
                              id="show_new_password"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="name">Confirm Password</label>
                   <div class="position-relative input_with_eye"> 
                      <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Confirm Password">
                      <span toggle="#password-field" class="fa fa-fw fa-eye field-icon custom_button_eye"
                              id="show_confirm_password"></span>
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
    right: 15px;
    transform: translateY(-50%);
   }
</style>
<script type="text/javascript">
$(document).ready(function() {
  $("#show_old_password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        if ($('#old_password').attr('type') == 'text') {
            $('#old_password').attr('type', 'password');
        } else {
            $('#old_password').attr('type', 'text');
        }

    });
    $("#show_new_password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        if ($('#new_password').attr('type') == 'text') {
            $('#new_password').attr('type', 'password');
        } else {
            $('#new_password').attr('type', 'text');
        }

    });
    $("#show_confirm_password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        if ($('#confirm_password').attr('type') == 'text') {
            $('#confirm_password').attr('type', 'password');
        } else {
            $('#confirm_password').attr('type', 'text');
        }

    });
jQuery.validator.addMethod("passwordErrorStrong", function(value, element) {
        var strongRegex = new RegExp("^(?=.{10,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
        var mediumRegex = new RegExp(
            "^(?=.{8,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$",
            "g");
        var enoughRegex = new RegExp("(?=.{7,}).*", "g");
        if (value.length < 8) {
            return false;
        } else {
            if (false == enoughRegex.test(value)) {
                return false;
            } else if (strongRegex.test(value)) {
                return true;
            } else if (mediumRegex.test(value)) {
                return true;
            } else {
                return false;
            }


        }
    }, "Oops! Add letter(s), number(s) and/or symbol(s)!");
            $("#change_password_add").validate({
                         errorElement: 'span',
                        errorClass: 'customerror',
                       rules: {
                          
                           old_password: {
                               required: true
                           },
                           new_password:{
                            required:true,
                            minlength:8,
                            passwordErrorStrong: true
                           },
                           confirm_password: {
                               required: true,
                               minlength:8,
                               equalTo: "#new_password"
                           }
                       },
                       messages: {
                       
                        old_password: {
                           required: "Please enter old password!"
                       },
                       new_password: {
                           required: "Please enter new password!",
                           minlength:"Please enter minimum 8 characters!"
                       },confirm_password: {
                           required: "Please enter confirm password!",
                           minlength:"Please enter minimum 8 characters!",
                           equalTo:"Password and confirm password does not match!"
                       }

                       }
                   });
});
</script>

</body>


</html>


