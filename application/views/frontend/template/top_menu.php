<body>
    <section class="my_menu_holder">
        <div class="my_menu_holder_inner">
            <nav class=" container navbar navbar-expand-lg navbar-light ">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url();?>"><img
                            src="<?php echo $base_url;?>assets/frontend/images/logo.png"></a>

                    <!-- data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation" -->

                    <button id="nav_bar_toggle" class="navbar-toggler" type="button">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav  my_menu">
                        <li
                            class="nav-item <?php if($this->uri->segment(1)=="" OR $this->uri->segment(1)=="home"){ echo "active"; }?>">
                            <a class="nav-link" href="<?php echo base_url();?>"><span data-letters="Home">Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url();?>about"><span data-letters="About">About</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url();?>faq"><span data-letters="FAQ">FAQ</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url();?>contact"><span data-letters="Contact">Contact</span></a>
                        </li>
                        <?php if(empty($userDetails['id'])){?>

                        <li class="nav-item <?php if($this->uri->segment(1)=="signin"){ echo "active"; }?>">
                            <a class="nav-link" href="<?php echo base_url();?>signin" id="signin"><span
                                    data-letters="Login">Login</span></a>
                        </li>
                        <li class="nav-item <?php if($this->uri->segment(1)=="signup"){ echo "active"; }?>">
                            <a class="nav-link" href="<?php echo base_url();?>signup" id="signup"><span
                                    data-letters="Signup">Signup</span></a>
                        </li><?php } else { ?>
                        <li class="nav-item">
                            <!-- <a class="nav-link" href="<?php echo base_url();?>contact"><span data-letters="Contact">Contact</span></a> -->
                            <a class="nav-link" href="<?php echo base_url();?>my-booking"><span data-letters="Contact">My Bookings</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link  dropdown-toggle" menu_id="profile" href="Javascript:void(0)"
                                id="navbarDropdown" role="button"><span class="text-capitalize"
                                    data-letters="Logout"><?php echo $userDetails['firstname'].' '.$userDetails['lastname'];?></span>
                                <i class="fas fa-plus" id="plus_minus"></i> </a>
                            <div id="profile" class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?php echo base_url();?>profile">My Account</a>

                                <!-- <a class="dropdown-item" href="<?php echo base_url();?>my-booking">My Bookings</a> -->

                                <a class="dropdown-item" href="<?php echo base_url();?>signin/logout">Logout</a>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </nav>
        </div>
        <div id="cookies-notification" style="display:none">
            <p>
                SkyBound uses cookies to improve your booking experience.
                <a href="#" id="dismiss-cookies-notification">I Accept</a> or <a href="<?php echo base_url();?>privacy-policy">Read More</a>
            </p>
    </div>
    </section>



    
<style>
    div#cookies-notification {
    background-color: #555;
    position: relative;
    color: #fff;
    padding: 14px;
    display: flex;
    justify-content: center;
    font-size: 16px;
    text-align:center;
    }
    div#cookies-notification p a{
        color:#fa9f1b;
    }
    
</style>