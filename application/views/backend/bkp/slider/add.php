<!DOCTYPE html>
<html>
	<?php echo $header;?>
	<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<?php echo $top_menu;?>
				<?php echo $left_nav;?>
	  			<!-- Content Wrapper. Contains page content -->
	  			<div class="content-wrapper">
	    		<!-- Content Header (Page header) -->
	    			<section class="content-header">
	      				<h1>Add<small> Slider</small></h1>
					      <ol class="breadcrumb">
					      		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					        	<li class="active">Add - Slider</li>
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
		              <h3 class="box-title">Slider Image</h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		               <form class="form-horizontal" action="<?php echo $base_url; ?>admin/slider/add" method="post" id="slider_add" name="slider_add" enctype="multipart/form-data" >
			                <div class="box-body">

				                 <div class="form-group">
				                    <label for="type" class="control-label col-md-3">Main Title </label>
				                    <div class="col-md-9">
				                    	<input type="text" name="slider_name" id="slider_name" class="form-control" value="" placeholder="Enter Slider Title Name">
				                    </div>
				                </div>

				                <div class="form-group">
				                    <label for="type" class="control-label col-md-3">Title(optional)</label>
				                    <div class="col-md-9">
				                    	<input type="text" name="optional_slider_name" id="optional_slider_name" class="form-control" value="" placeholder="Enter Slider Title Name">
				                    </div>
				                </div>
				                

				                <div class="form-group">
				                      <label class="control-label col-md-3">Slider Image</label>
				                      <div class="col-md-9">
				                          <div class="fileinput fileinput-new" data-provides="fileinput">
				                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
				                                  <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
				                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
				                              <div>
				                                  <span class="btn default btn-file">
				                                      <span class="fileinput-new"> Select image </span>
				                                      <span class="fileinput-exists"> Change </span>
				                                      <input type="file" name="imagefile" id="image" required=""> </span>
				                                  <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
				                              </div>
				                          </div>
				                         
				                      </div>
				                </div>
				                <div class="form-group">
				                	<label for="type" class="control-label col-md-3">Short Description(optional)</label>
				                	<div class="col-md-9">
					                	<textarea name="editor1"></textarea>
						                <script>
						                        CKEDITOR.replace( 'editor1' );
						                </script>
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
			                  <a class="btn btn-danger" href="<?php echo $base_url;?>admin/slider">Cancel</a>
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
		<!-- <script src="https://cdn.ckeditor.com/4.11.0/standard/ckeditor.js"></script>
		<script>
		      CKEDITOR.replace( 'description' );
		</script> -->
		<script type="text/javascript">
		    $("#slider_add").validate({
		        errorElement: 'span',
		        errorClass: 'customerror',
		        rules: {
		            
		           slider_name: {
		               required: true
		           },
		           image: {
		               required:true
		           }
		        },
		        messages: {
		         
		          slider_name: {
		             required: "Please provide slider name!"
		          },
		          image: {
		             required: "Please select slider image!",
		          }

		        }
		    });
		    
		</script>
</body>
</html>


