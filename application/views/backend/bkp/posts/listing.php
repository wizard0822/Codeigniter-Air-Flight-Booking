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


        Posts


        <small>List</small>


      </h1>


      <ol class="breadcrumb">


        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>


        <li class="active">Posts List</li>


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
                <div class="col-md-9"> <h3 class="box-title">All Posts List</h3></div>
               <!--  <div class="col-md-3 pull-right" ><a href="<?php echo $base_url;?>about_us/add" class="btn pull-right btn-primary">Add</a></div> -->
              </div>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>

                  <th>User Name</th>
                  <th>Category</th>
                  <th>Post Title</th>
                 <!--  <th>Post Description</th> -->
                  <th>Added Date</th>
                  <th>Post Image</th>
                  <th>View Count</th>
                  <th>Last View Time</th>
                  <th>Status</th><!-- 
                  <th>Featured</th> -->
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                
                  <?php foreach ($list as $key => $value) {?>
                  <tr>
                    <td>
                    <?php echo $value['user_name'];?>
                    </td>
                   <td><?php echo $value['category_name'];?></td>
                   <td><?php echo $value['title'];?></td>
                   <!-- <td><?php echo substr($value['description'],0,100);?></td> -->
                  <td><span style="display: none;"><?php echo $value['added_date'];?></span><?php echo date('d/m/Y',$value['added_date']);?></td>
                  <td><img class="img-fluid" alt="Post Image"
                                src="<?php echo $base_url; ?>assets/upload/post_image/<?php echo $value['image']; ?>" height="50px" width="50px"></td>
                  <td><?php echo $value['view_count'];?></td>
                  <td><?php if($value['view_time']!=''){echo date('d/m/Y h:i:s',$value['view_time']);}?></td>
                  <td>
                    <?php if($value['status']==0) { ?>
                      <a href="<?php echo $base_url;?>admin/posts/activate/<?php echo base64_encode($value['id']); ?>"  class="confirmBox  btn btn-mini hidden-phone hidden-tablet"  onclick="return confirm('Are you sure you want to Approve?');">
                      <span class="label label-sm label-danger"> Pending </span>
                      </a>
                      <?php } else if($value['status']==1) { ?>
                      <a href="<?php echo $base_url;?>admin/posts/inactivate/<?php echo base64_encode($value['id']); ?>"  class="confirmBox  btn btn-mini hidden-phone hidden-tablet"  onclick="return confirm('Are you sure you want to deactivate?');">
                      <span class="label label-sm label-success"> Active </span>
                      </a>
                      <?php } else if($value['status']==2) { ?>
                      <a href="<?php echo $base_url;?>admin/posts/activate/<?php echo base64_encode($value['id']); ?>"  class="confirmBox  btn btn-mini hidden-phone hidden-tablet"  onclick="return confirm('Are you sure you want to activate?');">
                      <span class="label label-sm label-danger"> Inactive </span>
                      </a>
                      
                      <?php } else{ ?>
                      <a href="<?php echo $base_url;?>admin/posts/activate/<?php echo base64_encode($value['id']); ?>"  class="confirmBox  btn btn-mini hidden-phone hidden-tablet"  onclick="return confirm('Are you sure you want to activate?');">
                      <span class="label label-sm label-danger"> Inactive </span>
                      </a>
                      <?php } ?>
                    </td>
                    <!-- <td>
                    <?php if($value['featured']==1) { ?>
                      <a href="<?php echo $base_url;?>admin/posts/unfeatured/<?php echo base64_encode($value['id']); ?>"  class="confirmBox  btn btn-mini hidden-phone hidden-tablet"  onclick="return confirm('Are you sure you want to unfeatured the post?');">
                      <span class="label label-sm label-success"> Featured </span>
                      </a>
                      <?php } else{ ?>
                      <a href="<?php echo $base_url;?>admin/posts/featured/<?php echo base64_encode($value['id']); ?>"  class="confirmBox  btn btn-mini hidden-phone hidden-tablet"  onclick="return confirm('Are you sure you want to featured the post?');">
                      <span class="label label-sm label-danger"> Unfeatured </span>
                      </a>
                      <?php } ?>
                    </td> -->
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                           <li><a href="<?php echo $base_url;?>admin/posts/view/<?php echo base64_encode($value['id']); ?>">View Details</a></li>
                           <li><a href="<?php echo $base_url;?>admin/posts/view_comments/<?php echo base64_encode($value['id']); ?>">View Comments</a></li>
                          <li><a  class="confirmBox"  onclick="return confirm('Do you want to delete the post? If you delete the post all related comments also be deleted? Are you want to delete?');" href="<?php echo $base_url;?>admin/posts/delete/<?php echo base64_encode($value['id']); ?>">Delete</a></li>
                          
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
                  <th>Status</th> -->
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
      "order": [[ 3, "desc" ]]
    })
  })
</script>

</body>


</html>


