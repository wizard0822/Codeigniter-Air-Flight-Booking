<!-- Left side column. contains the logo and sidebar -->  
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->    
  <section class="sidebar">
    <!-- Sidebar user panel -->      
    <div class="user-panel">
      <div class="pull-left image">          
        <img src="<?php echo $base_url;?>assets/dist/img/download.png" class="img-circle" alt="User Image">        
      </div>
      <div class="pull-left info">
        <p>
          <?php echo $admin_details['f_name']." ".$admin_details['l_name'];?>
        </p>
        <a href="#">
          <i class="fa fa-circle text-success">
          </i> Online
        </a>        
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->      
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li  <?php if($controller_name=='dashboard') { ?>class="active"<?php } ?> >
          <a href="<?php echo $base_url;?>admin/dashboard">
            <i class="fa fa-dashboard"></i> 
            <span>Dashboard</span>
            <!--             <span class="pull-right-container">              <i class="fa fa-angle-left pull-right"></i>            </span> -->          
          </a>
      </li>
      <!-- <li class="treeview <?php if($controller_name=='users' || $controller_name=='posts') { ?>active menu-open<?php } ?>">
          <a href="#">            
            <i class="fa fa-pie-chart">
            </i>            
            <span>Settings
            </span>            
            <span class="pull-right-container">              
              <i class="fa fa-angle-left pull-right">
              </i>            
            </span>          
          </a>           -->
          <!-- <ul class="treeview-menu"> -->
              <!-- <li 
                  <?php if($controller_name=='users') { ?> class="active"
                  <?php } ?>>
                  <a href="<?php echo $base_url;?>admin/users/">
                    <i class="fa fa-users">
                    </i> Customer
                  </a>
              </li> -->
			  <?php if($admin_details['type']=='su'){?>
               <li <?php if($controller_name=='admin-maintenance') { ?> class="active"<?php } ?>>
                  <a href="<?php echo $base_url;?>admin/admin-maintenance">
                    <i class="fa fa-users">
                    </i> Admin Maintenance
                  </a>
              </li><?php } ?>
              <li 
                  <?php if($controller_name=='booking') { ?> class="active"
                  <?php } ?>>
                  <a href="<?php echo $base_url;?>admin/booking">
                    <i class="fa fa-list">
                    </i> Booking Management
                  </a>
              </li>
              <li 
                  <?php if($controller_name=='airport') { ?> class="active"
                  <?php } ?>>          
                  <a href="<?php echo $base_url;?>admin/airport">            
                    <i class="fa fa-list">
                    </i> 
                    <span>Airport Management
                    </span>          
                  </a>        
              </li>
              <li 
                  <?php if($controller_name=='customer') { ?> class="active"
                  <?php } ?>>
                  <a href="<?php echo $base_url;?>admin/customer">
                    <i class="fa fa-users">
                    </i> Customer Management
                  </a>
              </li>
              <li 
                  <?php if($controller_name=='vehicle-type') { ?> class="active"
                  <?php } ?>>
                  <a href="<?php echo $base_url;?>admin/vehicle-type">
                    <i class="fa fa-bandcamp">
                    </i> Vehicle Type Management
                  </a>
              </li>
              <li 
                  <?php if($controller_name=='price-management') { ?> class="active"
                  <?php } ?>>
                  <a href="<?php echo $base_url;?>admin/price-management">
                    <i class="fa fa-money">
                    </i> Price Management
                  </a>
              </li>
              <li 
                  <?php if($controller_name=='promocode') { ?> class="active"
                  <?php } ?>>
                  <a href="<?php echo $base_url;?>admin/promocode">
                    <i class="fa fa-tags">
                    </i> Promo Code Management
                  </a>
              </li>
            <li <?php if($controller_name=='zone-management') { ?>class="active"<?php } ?>>          
              <a href="<?php echo $base_url;?>admin/zone-management" target="_blank">            
                  <i class="fa fa-list"></i>
                  <span>Zone Management</span>          
              </a>        
            </li> 
              <!-- <li 
                  <?php if($controller_name=='blogs') { ?> class="active"
                    <?php } ?>>          
                  <a href="<?php echo $base_url;?>admin/blogs">            
                      <i class="fa fa-list">
                      </i> 
                      <span>Blogs
                      </span>          
                  </a>        
              </li> -->
        <!-- </li>
        <li <?php if($controller_name=='logo') { ?>class="active"<?php } ?>>          
              <a href="<?php echo $base_url;?>admin/logo">            
                  <i class="fa fa-bandcamp" aria-hidden="true"> </i>
                  <span>Logo</span>          
              </a>        
        </li>
        <li <?php if($controller_name=='slider') { ?>class="active"<?php } ?>>          
              <a href="<?php echo $base_url;?>admin/slider">            
                  <i class="fa fa-sliders" aria-hidden="true"></i>
                  <span>Slider</span>          
              </a>        
        </li>
        
        <li <?php if($controller_name=='about') { ?>class="active"<?php } ?>>          
              <a href="<?php echo $base_url;?>admin/about">            
                  <i class="fa fa-circle-o"></i>
                  <span>About</span>          
              </a>        
        </li>
        <li <?php if($controller_name=='contact_us_content') { ?>class="active"<?php } ?>>          
              <a href="<?php echo $base_url;?>admin/contact_us_content">            
                  <i class="fa fa-circle-o"></i>
                  <span>Contact Us Content</span>          
              </a>        
        </li>
        <li <?php if($controller_name=='contact') { ?>class="active"<?php } ?>>          
              <a href="<?php echo $base_url;?>admin/contact">            
                  <i class="fa fa-circle-o"></i>
                  <span>Contact</span>          
              </a>        
        </li> -->
       

        <!-- <li <?php if($controller_name=='footer') { ?>class="active"<?php } ?>>          
              <a href="<?php echo $base_url;?>admin/footer">            
                  <i class="fa fa-circle-o"></i>
                  <span>Footer</span>          
              </a>        
        </li> -->

      </ul>
 </li>
 </ul>     
</section>
<!-- /.sidebar -->  
</aside>
