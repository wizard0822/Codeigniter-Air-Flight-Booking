<!-- BEGIN HEADER -->            
<header class="main-header">                
  <!-- Logo -->                
  <a href="<?php echo $base_url;?>" class="logo">                  
    <!-- mini logo for sidebar mini 50x50 pixels -->                  
    <span class="logo-mini">
      <b>S
      </b>K
    </span>                  
    <!-- logo for regular state and mobile devices -->                  
    <span class="logo-lg">
      <b>Sky
      </b>Bound
    </span>                
  </a>                
  <!-- Header Navbar: style can be found in header.less -->                
  <nav class="navbar navbar-static-top">                  
    <!-- Sidebar toggle button-->                  
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">                    
      <span class="sr-only">Toggle navigation
      </span>                  
    </a>                  
    <!-- Navbar Right Menu -->                  
    <div class="navbar-custom-menu">                    
      <ul class="nav navbar-nav">                                           
        <!-- User Account: style can be found in dropdown.less -->                      
        <li class="dropdown user user-menu">                        
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">                          
            <img src="<?php echo $base_url;?>assets/dist/img/download.png" class="user-image" alt="User Image">                          
            <span class="hidden-xs">Hi, 
              <?php echo $admin_details['f_name'];?>
            </span>                        
          </a>                        
          <ul class="dropdown-menu">                          
            <!-- User image -->                          
            <li class="user-header">                            
              <img src="<?php echo $base_url;?>assets/dist/img/download.png" class="img-circle" alt="User Image">                            
              <p>                              
                <?php echo $admin_details['f_name']." ".$admin_details['l_name'];?>                              
                <small>Member since April. 2019
                </small>                            
              </p>                          
            </li>                          
            <!-- Menu Body -->                                                    
            <!-- Menu Footer-->                          
            <li class="user-footer">                            
              <div class="pull-left">                              
                <a href="<?php echo $base_url;?>admin/dashboard/change_password/" class="btn btn-default btn-flat">Change Password
                </a>                            
              </div>                            
              <div class="pull-right">                              
                <a href="<?php echo $base_url;?>admin/dashboard/logout" class="btn btn-default btn-flat">Sign out
                </a>                            
              </div>                          
            </li>                        
          </ul>                      
        </li>                      
        <!-- Control Sidebar Toggle Button -->                      
        <li>                        
          <a href="#" data-toggle="control-sidebar">
            <i class="fa fa-gears">
            </i>
          </a>                      
        </li>                    
      </ul>                  
    </div>                
  </nav>                          
</header>            
<!-- END HEADER -->
