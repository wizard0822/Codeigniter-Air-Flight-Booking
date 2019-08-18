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
	      				<h1>About<small> US</small></h1>
					      <ol class="breadcrumb">
					      		<li><a href="<?php echo $base_url;?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
					        	<li class="active">About - Us</li>
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
		              <h3 class="box-title">About Us</h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		               <form class="form-horizontal" action="<?php echo $base_url; ?>admin/about/add" method="post" id="slider_add" name="slider_add" enctype="multipart/form-data" >
			                <div class="box-body">

				                 <div class="form-group">
				                    <label for="type" class="control-label col-md-3"> Title </label>
				                    <div class="col-md-9">
				                    	<input type="text" name="title_name" id="title_name" class="form-control" value="" placeholder="Enter Slider Title Name">
				                    </div>
				                </div>

				                <div class="form-group">
				                    <label for="type" class="control-label col-md-3">Alternate Title(optional)</label>
				                    <div class="col-md-9">
				                    	<input type="text" name="optional_title_name" id="optional_slider_name" class="form-control" value="" placeholder="Enter Slider Title Name">
				                    </div>
				                </div>
				                

				                <!-- add image -->
								    <div class="form-group">
								

									
										<label for="type" class="control-label col-md-3">Select Cover Image</label>
									
									<div class="col-md-9">
											<div class="active_img display_img">
												
									             <img id="image_disp" class="thumbnail " 
									                src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" alt="">

										</div>
															
										<div class="button_selection">
												<div class="select_img1">		
													<div class="input-group">
														<label>
															<span class="btn btn-primary">
																<span id="upload_id" style="text-align: center;">Select Image</span> 
																	<input  type="file" 
																					onchange="readURL(this);" 
																					name="imagefile" 
																					id="imagefile" 
																					value="" 
																					style="display: none;" 
																					multiple>
															</span>
														</label>
																			<!-- <input   type="text" class="form-control" readonly> -->
																		
													</div>
											
											</div>

										<div class="change_remove_button">
													<a  class="btn btn-danger" id="remove_button">Remove</a>
										</div>
											
										</div>
									</div>
										
									</div>

				                <!-- end -->
				                <div class="form-group">
				                	<label for="type" class="control-label col-md-3">Description</label>
				                	<div class="col-md-9">
					                	<textarea name="editor1"></textarea>
						                <script>
						                        CKEDITOR.replace( 'editor1' );
						                </script>
					                </div>
				                </div>

				                  <!-- <div class="form-group">
				                    <label for="status" class="control-label col-md-3">Status</label>
				                    <div class="col-md-9">
				                    <select class="form-control" name="status" id="status" style="width:50%">
				                      <option value="1">Active</option>
				                      <option value="0">Inactive</option>
				                      
				                    </select>
				                    </div>
				                  </div> -->
		                  

		                	</div>
			                <!-- /.box-body -->

			                <div class="box-footer">
			                  <button type="submit" class="btn btn-primary" name="submit" id="submit" value="submit">Submit</button>
			                  <a class="btn btn-danger" href="<?php echo $base_url;?>admin/about">Cancel</a>
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
		    #image_disp{
				width:200px;
				height: auto;
			}
			.change_remove_button{
				display: none;
			}
			 #change_button{
						width:100px;
						/*display: none;*/
			}
			}
			#remove_button{

						width:100px;
						/*display: none;*/
			}
			.button_selection {
			    display: flex;
			}
			.button_selection .select_img1 {
			    margin-right: 10px;
			}
			
			span.btn.btn-primary {
				width: 100px;
				height: 35px;
			}
			a#remove_button {
				width: 90px;
				height: 35px;
			}
			label#imagefile-error {
				position: absolute;
				top: 35px;
				left: 0px;
			}
			
			
			label#editor1-error {
				    position: absolute;
					top: 88%;
					z-index: 9999;
				
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
		            
		           title_name: {
		               required: true
		           },
		           imagefile: {
		               required:true
		           },
		          editor1:{
		          	 required: true
		          }
		        },
		        messages: {
		         
		          slider_name: {
		             required: "This field is required!"
		          },
		          imagefile: {
		             required: "This field is required!",
		          },
		          editor1:{
		          	 required: "This field is required!",
		          }

		        }
		    });
		    
		</script>

<script type="text/javascript">
	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#image_disp').attr('src', e.target.result);
                // Edited 13/11/18 start
				$(".change_remove_button").css({'display':'block'});
								// $('.select_img1').css({'display':'none'});
				$('#upload_id').text('Change');
								//end edit
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

	// Edited 13/11/18 start
	$('#remove_button').on('click',function(){

		$(".change_remove_button").css({'display':'none'});
		$('#upload_id').text('Select Image');
		$('.select_img1').css({'display':'block'});

		$('#image_disp').attr("src","http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image");

		//Edited 26/11/2018
		$('#imagefile').val($('#image_disp').text());
		//End Edit
		$('input#camera_name').val("");
		$('input#aperture').val("");
		$('input#c_iso').val("");
		$('input#shutter_speed').val("");
	});
	//end edit
    
    $("#imagefile").change(function(){
        readURL(this);
    });
</script>


</body>
</html>


