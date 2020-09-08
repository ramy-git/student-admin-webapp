  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2019 <a href="http://www.rrgsoftware.org/">RRG Software</a>.</strong> All rights
    reserved.
  </footer>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/adminlte/dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url();?>assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<!-- Morris.js charts -->
<script src="<?php echo base_url();?>assets/adminlte/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/bower_components/morris.js/morris.min.js"></script>
<script src="<?php echo base_url();?>assets/croppie/croppie.js"></script>

<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()

    setTimeout(function(){ $(".content-header").css('display','none'); },1000);
    
     $('.datatable').DataTable( {
  "autoWidth": false,
});
    
  })
  
  
  
  function get_wo(){
    
   var cust_id =  $('#customer_id').val();

  $.post("<?php echo base_url();?>Welcome/get_wo",
  {
    id: cust_id
  },
  function(data, status){
      $('#wo').html(data);
      
      if(localStorage.getItem("wo")){
          $('#wo').val(localStorage.getItem("wo"));
      }

  });

}
  
  


</script>
</body>
</html>
