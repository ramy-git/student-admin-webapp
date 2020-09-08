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
          <h3 class="box-title">Users</h3>
        </div>
        <div class="box-body">
          <div class="text-right">
            <a href="<?php echo base_url();?>Admin/add_user"  class="btn btn-primary" ><i class="fa fa-plus"></i> Add</a>
          </div>
          <br>


          <table class="table table-bordered datatable">
            <thead>
              <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Sirname</th>
                <th>Email</th>
                <th>Type</th>
                
                <th>Updated At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $offset = 1;
              foreach ($user as $key => $userVAL) { ?>
                <tr>
                  <td><?php echo $offset++;?></td>
                  <td>
                    <?php if($userVAL->image!=''){ ?>
                      <img  class="student_image" src="<?php echo base_url();?>uploadfiles/students/<?php echo $userVAL->image; ?>">
                    <?php } ?>
                  
                  </td>
                  <td><?php echo $userVAL->name;?></td>
                  <td><?php echo $userVAL->surname;?></td>
                  <td><?php echo $userVAL->email;?></td>
                  <td><?php echo strtoupper($userVAL->type);?></td>
                  
                  <td><?php echo $userVAL->updated_at;?></td>
                  <td>

                    <?php if($this->session->userdata('atype')=='admin'){ ?>
                    <a class="btn  btn-primary btn-xs" href="<?php echo base_url();?>Admin/edit_user/<?php echo base64_encode($userVAL->id);?>"> <i class="fa fa-edit"></i> Edit</a>

                    <a class="btn  btn-danger btn-xs" href="<?php echo base_url();?>Admin/delete_user/<?php echo base64_encode($userVAL->id);?>"> <i class="fa fa-trash"></i> Delete</a>
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

<?php include 'footer.php';?>