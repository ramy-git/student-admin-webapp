<?php include 'header.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?php if($this->session->flashdata('msg')){ ?>
            <div class="row">
             
              <div class="col"><div class="bs-component">
            <div class="alert alert-dismissible alert-info">
            <button class="close" type="button" data-dismiss="alert">×</button>
            <?php echo $this->session->flashdata('msg'); ?>
            </div>
          </div></div>
          
            </div><?php } ?>
    </section>
    

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Customers</h3>
        </div>
        <div class="box-body">
          Start creating your amazing application!
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include 'footer.php';?>