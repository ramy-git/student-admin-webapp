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
          <h3 class="box-title">Class Group</h3>
        </div>
        <div class="box-body">
          <div class="row">

            <?php  foreach ($class as $key => $classVAL) { ?>
              <form action="<?php echo base_url();?>Admin/process_update_class" method="post"  >
                <input type="hidden" name="id" value="<?php echo  $classVAL->id;?>">
              <div class="col-md-12 col-sm-12 form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required="" value="<?php echo $classVAL->name;?>" >
              </div>
              <div class="col-md-12 col-sm-12 form-group text-right">
                <button class="btn btn-primary">Update</button>
              </div>
            </form>
              
            <?php } ?>
             
            
            
          </div>
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

