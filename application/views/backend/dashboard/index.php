<!DOCTYPE html>
<html>
   <?php echo $header;?>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
         <?php echo $top_menu;?>
         <?php echo $left_nav;?>  <!-- Content Wrapper. Contains page content -->  
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->    
            <section class="content-header">
               <h1>        Dashboard    </h1>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Dashboard</li>
               </ol>
            </section>
            <!-- Main content -->    
            <section class="content">
               <!-- Info boxes -->      
               <!-- <div class="row">
                  <div class="col-md-3 col-sm-6 col-xs-12">
                     <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>            
                        <div class="info-box-content">              <span class="info-box-text">Total Banner</span>              <span class="info-box-number"><?php echo $total_user;?> </span>            </div>
                             
                     </div>
                         
                  </div> -->
			  <?php if($admin_details['type']=='su'){?>

         <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $banner_count;?></h3>

              <p>Admin Maintenance</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo base_url() . 'admin/admin-maintenance'; ?>" class="small-box-footer">More info <i class="fa fa-users"></i></a>
          </div>
			  </div><?php } ?>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
              <div class="inner">
                <h3><?php echo $video_count;?></h3>

                <p>Booking Management</p>
              </div>
              <div class="icon">
                <i class="fa fa-list"></i>
              </div>
              <a href="<?php echo base_url() . 'admin/booking'; ?>" class="small-box-footer">More info <i class="fa fa-list"></i></a>
            </div>
        </div>  
      <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $about_count;?></h3>

              <p>Airport Management</p>
            </div>
            <div class="icon">
              <i class="fa fa-list"></i>
            </div>
            <a href="<?php echo base_url() . 'admin/airport'; ?>" class="small-box-footer">More info <i class="fa fa-list"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $about_count;?></h3>

              <p>Customer Management</p>
            </div>
            <div class="icon">
              <i class="fa fa-list"></i>
            </div>
            <a href="<?php echo base_url() . 'admin/customer'; ?>" class="small-box-footer">More info <i class="fa fa-list"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $about_count;?></h3>

              <p>Vehicle Type Management</p>
            </div>
            <div class="icon">
              <i class="fa fa-bandcamp"></i>
            </div>
            <a href="<?php echo base_url() . 'admin/vehicle-type'; ?>" class="small-box-footer">More info <i class="fa fa-bandcamp"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $about_count;?></h3>

              <p>Price Management</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="<?php echo base_url() . 'admin/price-management'; ?>" class="small-box-footer">More info <i class="fa fa-money"></i></a>
          </div>
        </div>
       <!--  <div class="col-lg-3 col-xs-6">
          
            <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $contactus_count;?></h3>

              <p>Blogs</p>
            </div>
            <div class="icon">
              <i class="fa fa-arrows"></i>
            </div>
            <a href="<?php echo base_url() . 'admin/blogs'; ?>" class="small-box-footer">More info <i class="fa fa-list"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $banner_count;?></h3>

              <p>Logo</p>
            </div>
            <div class="icon">
              <i class="fa fa-bandcamp"></i>
            </div>
            <a href="<?php echo base_url() . 'admin/logo'; ?>" class="small-box-footer">More info <i class="fa fa-bandcamp"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $about_count;?></h3>

              <p>Slider</p>
            </div>
            <div class="icon">
              <i class="fa fa-sliders"></i>
            </div>
            <a href="<?php echo base_url() . 'admin/slider'; ?>" class="small-box-footer">More info <i class="fa fa-sliders"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?php echo $video_count;?></h3>

                <p>About</p>
              </div>
              <div class="icon">
                <i class="fa fa-circle-o"></i>
              </div>
              <a href="<?php echo base_url() . 'admin/about'; ?>" class="small-box-footer">More info <i class="fa fa-circle-o"></i></a>
            </div>
        </div> 
        <div class="col-lg-3 col-xs-6"> 
          <div class="small-box bg-green">
              <div class="inner">
                <h3><?php echo $contactus_count;?></h3>

                <p>Contact</p>
              </div>
              <div class="icon">
                <i class="fa fa-circle-o"></i>
              </div>
              <a href="<?php echo base_url() . 'admin/contact'; ?>" class="small-box-footer">More info <i class="fa fa-circle-o"></i></a>
            </div>
        </div> -->
        <!-- <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $about_count;?></h3>

              <p>Footer</p>
            </div>
            <div class="icon">
              <i class="fa fa-circle-o"></i>
            </div>
            <a href="<?php echo base_url() . 'admin/footer'; ?>" class="small-box-footer">More info <i class="fa fa-circle-o"></i></a>
          </div>
        </div> -->
                  <!-- /.col -->        
                  
                  
                  <!-- /.col -->      
               </div>
               <!-- /.row -->      
               
            </section>
            <!-- /.content -->  
         </div>
         <!-- /.content-wrapper -->  <?php echo $footer_content;?>
      </div>
      <!-- ./wrapper --><?php echo $footer;?>
   </body>
</html>