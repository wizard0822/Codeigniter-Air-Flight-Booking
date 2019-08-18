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


        Promo Code


        <small> Add</small>


      </h1>


      <ol class="breadcrumb">


        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>


        <li class="active">Promo Code - Add</li>


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
                <div class="col-md-9"> <h3 class="box-title">Add Promo Code</h3></div>
                <div class="col-md-3 pull-right" ><a href="<?php echo $base_url;?>admin/promocode" class="btn pull-right btn-primary">Back</a></div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <form class="form-horizontal" autocomplete="off" action="<?php echo $base_url; ?>admin/promocode/add" method="post" id="customer_add" name="customer_add" enctype="multipart/form-data" >
                <div class="box-body">
                 <div class="form-group">
                    <label for="type" class="control-label col-md-3">Code</label>
                    <div class="col-md-9">
                     <input type="text" name="code" id="code" placeholder="Code"
                            value="<?php echo $code;?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Fixed Customer Amount</label>
                    <div class="col-md-9">
                    <input type="text" name="fixed_customer_amount" id="fixed_customer_amount" placeholder="Fixed Customer Amount"
                            value="<?php echo $fixed_customer_amount;?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Fixed Driver Amount</label>
                    <div class="col-md-9">
                    <input type="text" name="fixed_driver_amount" id="fixed_driver_amount" placeholder="Fixed Driver Amount"
                            value="<?php echo $fixed_driver_amount;?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                  <label for="type" class="control-label col-md-3">Percent Customer Amount</label>
                  <div class="col-md-9">
                    <input type="text" name="percent_customer_amount" id="percent_customer_amount" placeholder="Percent Customer Amount"
                            value="<?php echo $percent_customer_amount;?>" class="form-control">
                  </div>
                </div>
                
                 <div class="form-group">
                    <label for="type" class="control-label col-md-3">Percent Driver Amount</label>
                    <div class="col-md-9">
                      <input type="text" name="percent_driver_amount" id="percent_driver_amount" placeholder="Percent Driver Amount"
                              value="<?php echo $percent_driver_amount;?>" class="form-control">
                    </div>
                  </div>
                
                  <div class="form-group">
                    <label for="type" class="control-label col-md-3">Expiry Date</label>
                    <div class="col-md-9">
                      <input type="text" name="expiry_date" id="expiry_date" placeholder="Expiry Date"
                              value="<?php echo $expiry_date;?>" class="form-control">
                    </div>
                  </div>
                
                 <div class="form-group">
                    <label for="type" class="control-label col-md-3">Expiry Count</label>
                    <div class="col-md-9">
                      <input type="text" name="expiry_count" id="expiry_count" placeholder="Expiry Count"
                              value="<?php echo $expiry_count;?>" class="form-control">
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

</style>
<script type="text/javascript">

</script>


</body>


</html>


