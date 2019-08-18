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


					<small>List</small>


				</h1>


				<ol class="breadcrumb">


					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>


					<li class="active">Promo Code List</li>


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
									<div class="col-md-9"> <h3 class="box-title">All Promo Code List</h3></div>
									<div class="col-md-3 pull-right" ><a href="<?php echo $base_url;?>admin/promocode/add" class="btn pull-right btn-primary">Add</a></div> 
								</div>

							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<table id="example2" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>ID</th>
											<th>Code</th>
											<th>Fixed Customer Amount</th>
											<th>Fixed Driver Amount</th>
											<th>Percent Customer Amount</th>
											<th>Percent Driver Amount</th>
											<th>Expiry Date</th>
											<th>Expiry Count</th>
											<th>Action</th>

										</tr>
									</thead>
									<tbody>

										<?php foreach ($list as $key => $value) {?>
											<tr>
												<td>
													<?php echo $value['id'];?>
												</td>
												<td>
													<?php echo $value['code'];?>
												</td>
												<td><?php echo $value['fixed_customer_amount'];?></td>
												<td><?php echo $value['fixed_driver_amount'];?></td>
												<td><?php echo $value['percent_customer_amount']; ?></td>
												<td><?php echo $value['percent_driver_amount'];?></td>
												<td><?php echo $value['expiry_date'];?></td>
												<td>
													<?php echo $value['expiry_count'] ?>
												</td>

												<td>
													<div class="btn-group">
														<button type="button" class="btn btn-info">Action</button>
														<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
															<span class="caret"></span>
															<span class="sr-only">Toggle Dropdown</span>
														</button>
														<ul class="dropdown-menu" role="menu">
															<li><a href="<?php echo $base_url;?>admin/promocode/edit/<?php echo base64_encode($value['id']); ?>">Edit</a></li>
															<li><a  class="confirmBox"  onclick="return confirm('Are you sure to delete the Promo Code?');" href="<?php echo $base_url;?>admin/promocode/delete/<?php echo base64_encode($value['id']); ?>">Delete</a></li>

														</ul>
													</div>
												</td> 
											</tr>
										<?php } ?>


									</tbody>
                <!-- <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Display Name</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>active</th> -->
                  <!-- <th>Added Date</th> -->
                  <!-- <th>Action</th> -->
                <!-- </tr>
                </tfoot> -->
              </table>
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
<script>
	$(function () {
    // $('#example1').DataTable()
    $('#example2').DataTable({
    	'paging'      : true,
    	"pageLength": 50,
    	'lengthChange': false,
    	'searching'   : true,
    	'ordering'    : true,
    	'info'        : true,
    	'autoWidth'   : false,
    	"order": [[ 7, "desc" ]]
    })
  })
</script>

</body>


</html>


