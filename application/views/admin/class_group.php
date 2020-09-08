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
            <div class="col-md-6">
              <h1>Class</h1>
            </div>
            <div class="col-md-6 text-right">
              <?php if($this->session->userdata('atype')=='admin'){ ?>
              <button class="btn btn-primary" data-toggle="modal" data-target="#add_class"><i class="fa fa-plus"></i> Add Class</button>
            <?php } ?>
            </div>
          </div>

          


          <table class="table table-bordered datatable">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php

              $countx = 1;
              foreach ($class as $key => $classVAL) { ?>
                <tr>
                  <td><?php echo $countx++;?></td>
                  <td><?php echo $classVAL->name;?></td>
                  <td><?php echo $classVAL->created_at;?></td>
                  <td>
                    <?php if($this->session->userdata('atype')=='admin'){ ?>
                    <a  class="btn btn-primary btn-xs" href="<?php echo base_url();?>Admin/edit_class/<?php echo base64_encode($classVAL->id); ?>"><i class="fa fa-edit"></i> Edit </a>

                    <a  class="btn btn-danger btn-xs" href="<?php echo base_url();?>Admin/delete_class/<?php echo base64_encode($classVAL->id); ?>"><i class="fa fa-trash"></i> Delete </a>
                  <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>

          <hr/>
          <hr/>

          <div class="row">
            <div class="col-md-6">
              <h1>Class Groups</h1>
            </div>
            <div class="col-md-6 text-right">
              <?php if($this->session->userdata('atype')=='admin'){ ?>
              <button class="btn btn-primary" data-toggle="modal" data-target="#add_class_group"><i class="fa fa-plus"></i> Add Class Group</button>
            <?php } ?>
            </div>
          </div>

          <table class="table table-bordered datatable">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Class</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php

              $countx = 1;
              foreach ($class_group as $key => $class_groupVAL) { ?>
                <tr>
                  <td><?php echo $countx++;?></td>
                  <td><?php echo $class_groupVAL->name;?></td>
                  <td><?php echo $class_groupVAL->class_name;?></td>
                  <td><?php echo $class_groupVAL->created_at;?></td>
                  <td>

                    <?php if($this->session->userdata('atype')=='admin'){ ?>
                    <a  class="btn btn-primary btn-xs" href="<?php echo base_url();?>Admin/edit_class_group/<?php echo base64_encode($class_groupVAL->id); ?>"><i class="fa fa-edit"></i> Edit </a>

                    <a  class="btn btn-danger btn-xs" href="<?php echo base_url();?>Admin/delete_class_group/<?php echo base64_encode($class_groupVAL->id); ?>"><i class="fa fa-trash"></i> Delete </a>

                  <?php } ?>

                    
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>




          
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



    <!-- Modal -->
  <div class="modal fade" id="add_class" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Class</h4>
        </div>
        <form action="<?php echo base_url();?>Admin/process_add_class" method="post">
        <div class="modal-body">
          <label>Name</label>
          <input type="text" name="name" required="" class="form-control">
        </div>
        <div class="modal-footer">
          <button  class="btn btn-primary" >Save</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>

    <!-- Modal -->
  <div class="modal fade" id="add_class_group" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Class</h4>
        </div>
        <form action="<?php echo base_url();?>Admin/process_add_class_group" method="post">
        <div class="modal-body">
          <label>Group Name</label>
          <input type="text" name="name" required="" class="form-control">
          <br/>
          <select class="form-control" name="class_id" required>
            <option value="">select</option>
            <?php foreach ($class as $key => $classVAL) { ?>
            <option value="<?php echo $classVAL->id;?>"><?php echo $classVAL->name;?></option>
            <?php } ?>
          </select>
        </div>
        <div class="modal-footer">
          <button  class="btn btn-primary" >Save</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>

<?php include 'footer.php';?>