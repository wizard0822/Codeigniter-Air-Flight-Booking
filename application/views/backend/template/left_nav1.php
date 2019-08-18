<!-- Left side column. contains the logo and sidebar -->  
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->    
  <section class="sidebar">
    <!-- Sidebar user panel -->      
    <div class="user-panel">
      <div class="pull-left image">          
        <img src="<?php echo $base_url;?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">        
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
    <!-- search form -->      
    <!-- <form action="#" method="get" class="sidebar-form">
<div class="input-group">          <input type="text" name="q" class="form-control" placeholder="Search...">          <span class="input-group-btn">                <button type="submit" name="search" id="search-btn" class="btn btn-flat">                  <i class="fa fa-search"></i>                </button>              </span>        </div>
</form> -->
    <!-- /.search form -->      
    <!-- sidebar menu: : style can be found in sidebar.less -->      
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION
      </li>
      <li 
          <?php if($controller_name=='dashboard') { ?>class="active"
      <?php } ?>>
      <a href="<?php echo $base_url;?>admin/dashboard">
        <i class="fa fa-dashboard">
        </i> 
        <span>Dashboard
        </span>
        <!--             <span class="pull-right-container">              <i class="fa fa-angle-left pull-right"></i>            </span> -->          
      </a>
      </li>
    <li class="treeview <?php if($controller_name=='users' || $controller_name=='posts') { ?>active menu-open<?php } ?>">
      <a href="#">            
        <i class="fa fa-pie-chart">
        </i>            
        <span>Settings
        </span>            
        <span class="pull-right-container">              
          <i class="fa fa-angle-left pull-right">
          </i>            
        </span>          
      </a>          
      <ul class="treeview-menu">
      <li 
            <?php if($method_name=='index' || $method_name=='') { ?> class="active"
        <?php } ?>>
        <a href="<?php echo $base_url;?>admin/category/">
          <i class="fa fa-list">
          </i> Categories
        </a>
        </li>
        <li 
            <?php if($method_name=='index' || $method_name=='') { ?> class="active"
        <?php } ?>>
        <a href="<?php echo $base_url;?>admin/users/">
          <i class="fa fa-list">
          </i> Users
        </a>
        </li>
    <li 
        <?php if($method_name=='index' || $method_name=='') { ?> class="active"
      <?php } ?>>          
      <a href="<?php echo $base_url;?>admin/posts">            
        <i class="fa fa-list">
        </i> 
        <span>Posts
        </span>          
      </a>        
    </li>
    <li 
        <?php if($method_name=='' || $method_name=='index') { ?> class="active"
    <?php } ?>>          
    <a href="<?php echo $base_url;?>admin/blogs">            
      <i class="fa fa-list">
      </i> 
      <span>Blogs
      </span>          
    </a>        
    </li>
     <!--<li 
        <?php if($method_name=='add' || $method_name=='edit' || $method_name=='index') { ?> class="active"
    <?php } ?>>          
    <a href="<?php echo $base_url;?>admin/contact_us">            
      <i class="fa fa-circle-o">
      </i> 
      <span>Contact Us
      </span>          
    </a>        
    </li>
    <li 
        <?php if($method_name=='add' || $method_name=='edit' || $method_name=='index') { ?> class="active"
    <?php } ?>>          
    <a href="<?php echo $base_url;?>admin/logo">            
      <i class="fa fa-circle-o">
      </i> 
      <span>Logo
      </span>          
    </a>        
    </li>
    <li 
        <?php if($method_name=='add' || $method_name=='edit' || $method_name=='index') { ?> class="active"
    <?php } ?>>          
    <a href="<?php echo $base_url;?>admin/acquisition_criteria">            
      <i class="fa fa-circle-o">
      </i> 
      <span>Acquisition Criteria
      </span>          
    </a>        
    </li> -->
  </ul>
</li>
</ul>
</li>
</ul>
</section>
<!-- /.sidebar -->  
</aside>
