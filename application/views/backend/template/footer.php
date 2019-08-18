<!-- jQuery 3 --><script src="<?php echo $base_url;?>assets/bower_components/jquery/dist/jquery.min.js"></script><!-- Bootstrap 3.3.7 --><script src="<?php echo $base_url;?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script><!-- FastClick --><script src="<?php echo $base_url;?>assets/bower_components/fastclick/lib/fastclick.js"></script><!-- AdminLTE App --><script src="<?php echo $base_url;?>assets/dist/js/adminlte.min.js"></script><!-- Sparkline --><script src="<?php echo $base_url;?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script><!-- jvectormap  --><script src="<?php echo $base_url;?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script><script src="<?php echo $base_url;?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script><!-- SlimScroll --><script src="<?php echo $base_url;?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script><!-- ChartJS --><script src="<?php echo $base_url;?>assets/bower_components/chart.js/Chart.js"></script><!-- AdminLTE dashboard demo (This is only for demo purposes) --><script src="<?php echo $base_url;?>assets/dist/js/pages/jquery.validate.min.js" type="text/javascript"></script><!-- AdminLTE for demo purposes -->
<script src="<?php echo $base_url;?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<?php if($controller_name=='dashboard') { ?>
<script src="<?php echo $base_url;?>assets/dist/js/pages/dashboard2.js"></script>
<?php } ?>
<style type="text/css">
	.btn.red:not(.btn-outline):hover {
    color: #ffffff;
    background-color: #e12330;
    border-color: #dc1e2b;
	}
	.btn.btn-file > input[type="file"] {
	    position: absolute;
	    top: 0;
	    right: 0;
	    min-width: 100%;
	    min-height: 100%;
	    font-size: 100px;
	    text-align: right;
	    opacity: 0;
	    filter: alpha(opacity=0);
	    outline: none;
	    background: white;
	    cursor: inherit;
	    display: block;
	}
	.btn.red:not(.btn-outline) {
	    color: #ffffff;
	    background-color: #e7505a;
	    border-color: #e7505a;
	}
	.btn.default:not(.btn-outline):hover {
	    color: #666;
	    background-color: #c2cad8;
	    border-color: #bcc5d4;
	}
	.btn.default:not(.btn-outline) {
	    color: #666;
	    background-color: #e1e5ec;
	    border-color: #e1e5ec;
	}
</style>
<script src="<?php echo $base_url;?>assets/dist/js/components.css"></script>
<script src="<?php echo $base_url;?>assets/dist/js/demo.js"></script>
<script src="<?php echo $base_url;?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $base_url;?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo $base_url;?>assets/bower_components/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript">
	//Date picker
    $('.datepicker').datepicker({
      autoclose: true
    });

</script>