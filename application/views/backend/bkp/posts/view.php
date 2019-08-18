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


        Post


        <small>Details</small>


      </h1>


      <ol class="breadcrumb">


        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>


        <li class="active">Post Details</li>


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
              <h3 class="box-title"> Details Post</h3>
              <div class="col-md-3 pull-right" ><a href="<?php echo $base_url;?>admin/posts" class="btn pull-right btn-primary">Back</a></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="box-body">
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">User Name</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $value['user_name'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Category</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $value['category_name'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Post Image</label>
                    <div class="col-md-9">
                      <img class="img-fluid" alt="Post Image"
                                  src="<?php echo $base_url; ?>assets/upload/post_image/<?php echo $value['image']; ?>" height="auto" width="40%">
                    </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Post Title</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $value['title'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Post Description</label>
                      <div class="col-md-9">
                      <textarea rows="10" cols="5" readonly="readonly" class="form-control"><?php echo $value['description'];?></textarea>
                      
                      </div>
                  </div>
                  <?php if(!empty($value['vlog_link'])){?>
                    <div class="form-group">
                    <label for="type" class="control-label col-md-3">Vlog Link</label>
                      <?php
                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $value['vlog_link'], $match);
                $youtube_id = $match[1];?>
                  <div class="col-md-9">
                       <iframe id="iframe_video<?php echo $key+1;?>" class="iframe_video" width="560" height="315"
                                src="https://www.youtube-nocookie.com/embed/<?php echo $youtube_id;?>?rel=0&amp;loop=1&amp;playlist=<?php echo $youtube_id;?>"
                                frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                  </div><?php } ?>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Post View Count</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $value['view_count'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Last Post View Time</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php if($value['view_time']!=''){echo date('d/m/Y h:i:s',$value['view_time']);}?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Status</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php if($value['status']==1){echo 'Active';} else if($value['status']==0){echo 'Inactive';}?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <!-- <div class="form-group">
                      <label for="type" class="control-label col-md-3">Featured</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php if($value['featured']==1){echo 'Featured';} else if($value['featured']==0){echo 'Unfeatured';}?>" readonly="readonly">
                      
                      </div>
                  </div> -->
                  
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


