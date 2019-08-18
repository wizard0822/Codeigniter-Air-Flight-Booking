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


        Customer


        <small> Add</small>


      </h1>


      <ol class="breadcrumb">


        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>


        <li class="active">Customer - Add</li>


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
                <div class="col-md-9"> <h3 class="box-title">Add Customer</h3></div>
                <div class="col-md-3 pull-right" ><a href="<?php echo $base_url;?>admin/customer" class="btn pull-right btn-primary">Back</a></div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <form class="form-horizontal" autocomplete="off" action="<?php echo $base_url; ?>admin/customer/add" method="post" id="customer_add" name="customer_add" enctype="multipart/form-data" >
                <div class="box-body">
                 <div class="form-group">
                    <label for="type" class="control-label col-md-3">First name</label>
                    <div class="col-md-9">
                     <input type="text" name="fname" id="fname" placeholder="First Name"
                            value="<?php echo $fname;?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Last name</label>
                    <div class="col-md-9">
                    <input type="text" name="lname" id="lname" placeholder="Last Name"
                            value="<?php echo $lname;?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Email</label>
                    <div class="col-md-9">
                    <input type="email" name="email" id="email" placeholder="Email Address"
                            value="<?php echo $email;?>" class="form-control">
                        <label
                            style="color: #c10000;font-size: 0.9em;line-height: 18px;padding: 5px 0 0; display: none;"
                            id="invalid_email" for="emailid">Email-id is invalid</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Telephone</label>
                    <div class="col-md-9">
                    <!-- <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address" value="<?php echo $address;?>"> -->
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Telephone"
                            value="<?php echo $phone;?>" maxlength="11"
                            oninput="this.value=this.value.replace(/[^0-9]/g,'');" style="padding-left:50px;">

                        <input type="hidden" name="country_code" id="country_code" value="+44">
                    </div>
                </div>
                
                  <!-- <div class="form-group">
                              <label for="status" class="control-label col-md-3">Status</label>
                              <div class="col-md-9">
                              <select class="form-control" name="status" id="status" style="width:50%">
                                <option selected value="1">Active</option>
                                <option value="0">Inactive</option>
                                
                              </select>
                              </div>
                            </div> -->
                  
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
   .intl-tel-input {
    position: relative;
    display: block;
  }
</style>
<script type="text/javascript">
$(document).ready(function() {
    $("#show_password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        if ($('#password').attr('type') == 'text') {
            $('#password').attr('type', 'password');
        } else {
            $('#password').attr('type', 'text');
        }

    });
    $("#customer_add").validate({
      errorElement: 'span',
        errorClass: 'customerror',
        rules: {
            fname: {
                required: true,
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "<?php echo base_url();?>admin/customer/register_email_exists",
                    type: "post",
                    data: {
                        email: function() {
                            return $("#email").val();
                        }
                    }
                }
            },
            country_code: {
                required: true
            },
            phone: {
                required: true,
                minlength: 10,
                maxlength: 11
            }
        },
        messages: {
            fname: {
                required: "First name field is required"
            },
            email: {
                required: "Email field is required",
                email: "Please enter valid email",
                remote: 'Email already used. Signup with another account.'
            },
            country_code: {
                required: "Country code field is required",
            },
            phone: {
                required: "Phone Number field is required",
                minlength: "Phone should be atleast 10 characters",
                maxlength: "Phone should be maximum 11 characters"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    $('#signup_btn').click(function() {
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
<script src="https://unpkg.com/jquery-input-mask-phone-number@1.0.4/dist/jquery-input-mask-phone-number.js"></script>
<script src="<?php echo base_url();?>assets/frontend/js/intlTelInput-jquery.min.js"></script>

<script>
$(document).ready(function($) {
    $('#phone1').usPhoneFormat({
        format: '(xxx) xxx-xxxx',
    });


    $("#phone").intlTelInput({
      initialCountry:'gb' ,
        utilsScript: "<?php echo base_url();?>assets/frontend/js/utils.js",
    });

    $('#phone').on("countrychange", function() {
        let flag_code = $(".selected-flag").attr('title').split(':')[1].replace(/ /g, '');
        console.log(flag_code);
        $('#country_code').val(flag_code);
    });

});
</script>

</body>


</html>


