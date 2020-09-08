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

      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo count($student); ?></h3>

              <p>Students</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo base_url();?>Admin/student" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include 'footer.php';?>