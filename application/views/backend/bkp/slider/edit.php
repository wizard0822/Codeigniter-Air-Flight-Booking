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
	      				<h1>Slider<small> Edit</small></h1>
					      <ol class="breadcrumb">
					      		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					        	<li class="active">Slider - Edit</li>
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
		               <form class="form-horizontal" action="<?php echo $base_url; ?>admin/slider/edit/<?php echo base64_encode($list[0]['id']);?>" method="post" id="slider_add" name="slider_add" enctype="multipart/form-data" >
			                <div class="box-body">

				                 <div class="form-group">
				                    <label for="type" class="control-label col-md-3">Main Title </label>
				                    <div class="col-md-9">
				                    	<input type="text" name="slider_name" id="slider_name" class="form-control" value="<?php echo $list[0]['title'] ?>" placeholder="Enter Slider Title Name">
				                    </div>
				                </div>

				                <div class="form-group">
				                    <label for="type" class="control-label col-md-3">Title(optional)</label>
				                    <div class="col-md-9">
				                    	<input type="text" name="optional_slider_name" id="optional_slider_name" class="form-control" value="<?php echo $list[0]['alt_title']; ?>" placeholder="Enter Slider Title Name">
				                    </div>
				                </div>
				                
				                <!-- add image -->
								    <div class="form-group">
								

									
										<label for="type" class="control-label col-md-3">Select Slider Image</label>
									
									<div class="col-md-9">
											<div class="active_img display_img">
												
									             <img id="image_disp" class="thumbnail " 
									                src="<?php echo $base_url;?>assets/upload/slider_images/<?php echo $list[0]['image'];?>" alt="">

										</div>
															
										<div class="button_selection">
												<div class="select_img1">		
													<div class="input-group">
														<label>
															<span class="btn btn-primary">
																<span id="upload_id" style="text-align: center;">Change Image</span> 
																	<input  type="file" 
																					onchange="readURL(this);" 
																					name="imagefile" 
																					id="imagefile" 
																					value="<?php  echo $list[0]['image'];?>" 
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
				                	<label for="type" class="control-label col-md-3">Short Description(optional)</label>
				                	<div class="col-md-9">
					                	<textarea name="editor1"><?php echo $list[0]['short_description']?></textarea>
						                <script>
						                        CKEDITOR.replace( 'editor1' );
						                </script>
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

		    #image_disp{
				width:200px;
				height: auto;
			}
			.change_remove_button{
				
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
			.error{
				color:red;
				font-weight:bold;
				font-size: 14px;
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
		           },image:{
		           	required:true
		           }
		           
		        },
		        messages: {
		         
		          slider_name: {
		             required: "Please provide slider name!"
		          },image:{
		           	required:"PLease select slider image!"
		           }
		          
		        }
		    });
		    
		</script>


		<script>
	$(function() {

			// We can attach the `fileselect` event to all file inputs on the page
			$(document).on('change', ':file', function() {
				var input = $(this),
					numFiles = input.get(0).files ? input.get(0).files.length : 1,
					label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
				input.trigger('fileselect', [numFiles, label]);
				});

				// We can watch for our custom `fileselect` event like this
				$(document).ready( function() {
					$(':file').on('fileselect', function(event, numFiles, label) {

						var input = $(this).parents('.input-group').find(':text'),
							log = numFiles > 1 ? numFiles + ' files selected' : label;

						if( input.length ) {
							input.val(log);
						} else {
							if( log ) //alert(log);
						}

					});
			});

	});
</script>

<!-- ON UPLOADING FILE  -->
 <script type="text/javascript">
	function readURL(input) {
						if (input.files && input.files[0]) {
							var reader = new FileReader();

							reader.onload = function (e) {
								$('#image_disp')
									.attr('src', e.target.result);
									

									// Edited 13/11/18 start
								$(".change_remove_button").css({'display':'block'});
								// $('.select_img1').css({'display':'none'});
								$('#upload_id').text('Change Image');

								//end edit
							};

						reader.readAsDataURL(input.files[0]);

						}
	

	}
	
	// Edited 13/11/18 start
	$('#remove_button').on('click',function(){
		$(".change_remove_button").css({'display':'none'});
		$('#upload_id').text('Select Image');
		$('.select_img1').css({'display':'block'});

		$('#image_disp').attr("src","http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image");
		

		$('input#camera_name').val("");
		$('input#aperture').val("");
		$('input#c_iso').val("");
		$('input#shutter_speed').val("");
	});
//end edit

</script> 

</body>
</html>


