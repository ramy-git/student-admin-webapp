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
          <h3 class="box-title">Student</h3>
        </div>
        <div class="box-body">
          <div class="text-right">
            <?php if($this->session->userdata('atype')=='admin'){ ?>
            <a href="<?php echo base_url();?>Admin/add_student"  class="btn btn-primary" ><i class="fa fa-plus"></i> Add</a>
          <?php } ?>
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
                <th>class</th>
                <th>class group</th>
                <?php if($this->session->userdata('atype')!='student'){ ?>
                <th>Student id</th>
                <th>Verify</th>
                <th>Updated At</th>
                <th>Action</th>
              <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php
              $offset = 1;
              foreach ($student as $key => $studentVAL) { ?>
                <tr>
                  <td><?php echo $offset++;?></td>
                  <td>
                    <?php if($studentVAL->image!=''){ ?>
                      <img  class="student_image" src="<?php echo base_url();?>uploadfiles/students/<?php echo $studentVAL->image; ?>">
                    <?php } ?>
                  
                  </td>
                  <td><?php echo $studentVAL->name;?></td>
                  <td><?php echo $studentVAL->surname;?></td>
                  
                  <td><?php echo $studentVAL->email;?></td>
                  <td><?php echo $studentVAL->class_name;?></td>
                  <td><?php echo $studentVAL->class_group_name;?></td>
                  <?php if($this->session->userdata('atype')!='student'){ ?>
                  <td><?php echo $studentVAL->student_id;?></td>
                  <td>
                    <?php if ($studentVAL->verify==1) { echo "Yes"; } ?>
                    <?php if ($studentVAL->verify==0) { echo "No"; } ?>
                  </td>
                  <td><?php echo $studentVAL->updated_at;?></td>
                  <td>
                    <a class="btn  btn-info btn-xs" href="<?php echo base_url();?>Admin/view_student/<?php echo base64_encode($studentVAL->id);?>"> <i class="fa fa-folder-open"></i> View</a>

                    <?php if($this->session->userdata('atype')=='admin'){ ?>
                    <a class="btn  btn-primary btn-xs" href="<?php echo base_url();?>Admin/edit_student/<?php echo base64_encode($studentVAL->id);?>"> <i class="fa fa-edit"></i> Edit</a>

                    <a class="btn  btn-danger btn-xs" href="<?php echo base_url();?>Admin/delete_student/<?php echo base64_encode($studentVAL->id);?>"> <i class="fa fa-edit"></i> Delete</a>
                  <?php } ?>

                  </td>
                  <?php } ?>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="pagination">
            <?php echo $links;?>
          </div>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include 'footer.php';?>