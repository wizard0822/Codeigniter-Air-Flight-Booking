<?php echo $header;?>
<?php echo $top_menu;?>
<section class="inward_menu_bottom">
    <div class="container">
    <?php if($this->session->flashdata('err_message')!='') { ?>
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <span><?php echo $this->session->flashdata('err_message'); ?></span>
            </div>
            <?php } ?>
            <?php if($this->session->flashdata('sess_message')!='') { ?>
            <div class="alert alert-success">
                <button class="close" data-close="alert"></button>
                <span><?php echo $this->session->flashdata('sess_message'); ?></span>
            </div>
            <?php } ?>
    <form class="inward_menu_bottom_block" method="post">
    <div class="inward_main_block_holder">
            <table style="width:100%">
            <tr>
              <th>Pickup Date</th>
              <th>Pickup Time</th> 
              <th>Pickup Address</th>
              <th>Destination Address</th>
              <th>Via Location 1</th>
              <th>Via Location 2</th>
              <th>Via Location 3</th>
              <th>Amount</th>
              <th>Status</th>
            </tr>
            <?php if(count($bookingDetails)>0){
              foreach ($bookingDetails as $key => $value) { ?>
            <tr>
              <td><?php echo $value['pickup_date'];?></td>
              <td><?php echo $value['pickup_time'];?></td>
              <td><?php echo $value['airport_name'];?></td>
              <td><?php echo $value['destination_address'];?></td> 
              <td><?php echo $value['via1_address'];?></td>
              <td><?php echo $value['via2_address'];?></td>
              <td><?php echo $value['via3_address'];?></td> 
              <td>200</td> 
              <td><?php if($value['status']==2){echo "Cancelled Trip";}?></td>
            </tr>
            <?php } }else {?>
            <tr>
                <td>No trips found</td>
            </tr>
            <?php } ?>
            
        </table>
      </form>
    </div>
  </div>
</section>

    <?php echo $footer;?>