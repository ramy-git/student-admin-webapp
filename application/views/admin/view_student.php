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
          <div class="row">

            <?php foreach ($student as $key => $studentVAL) { ?>


              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td>Image</td>
                    <td>
                      <img src="<?php echo base_url();?>uploadfiles/students/<?php echo $studentVAL->image;?>"  class="img-fluid" >
                    </td>
                  </tr>
                  <tr>
                    <td>Name</td>
                    <td><?php echo $studentVAL->name;?></td>
                  </tr>
                  <tr>
                    <td>Surname</td>
                    <td><?php echo $studentVAL->surname;?></td>
                  </tr>
                  <tr>
                    <td>Class group</td>
                    <td>
                      <?php 

                foreach ($class as $key => $classVAL) {
                foreach ($class_group as $key => $class_groupVAL) { 
                  if($classVAL->id==$class_groupVAL->class_id){ 
                  if($class_groupVAL->id==$studentVAL->class_group){ echo $class_groupVAL->class_name;?> - <?php echo $class_groupVAL->name;  } } } } ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Student ID</td>
                    <td><?php echo $studentVAL->student_id;?></td>
                  </tr>
                  <tr>
                    <td>Phone</td>
                    <td><?php echo $studentVAL->phone;?></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td><?php echo $studentVAL->email;?></td>
                  </tr>
                  <tr>
                    <td>Verify</td>
                    <td>
                      <?php if ($studentVAL->verify==1) { echo "Yes"; } ?>
                    <?php if ($studentVAL->verify==0) { echo "No"; } ?>
                      
                    </td>
                  </tr>
                  <tr>
                    <td>Created At</td>
                    <td><?php echo $studentVAL->created_at;?></td>
                  </tr>
                  <tr>
                    <td>Updated At</td>
                    <td><?php echo $studentVAL->updated_at;?></td>
                  </tr>
                </tbody>
              </table>
             
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



