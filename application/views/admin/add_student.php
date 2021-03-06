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
            <form action="<?php echo base_url();?>Admin/process_store_student_internal" method="post" onsubmit="validateform(event)" >
            <div class="col-md-6 col-sm-12 form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control" required="">
            </div>
            <div class="col-md-6 col-sm-12 form-group">
              <label>Surname</label>
              <input type="text" name="surname" class="form-control" required="">
            </div>
            <div class="col-md-6 col-sm-12 form-group">
              <label>Class group</label>
              <select class="form-control"  name="class_group" required>
                <option value="">select</option>
                <?php 

                foreach ($class as $key => $classVAL) {
                foreach ($class_group as $key => $class_groupVAL) { 
                  if($classVAL->id==$class_groupVAL->class_id){ ?>
                  <option value="<?php echo $class_groupVAL->id;?>"><?php echo $class_groupVAL->class_name;?> - <?php echo $class_groupVAL->name;?></option>
                <?php } } } ?>
              </select>
            </div>
            <div class="col-md-6 col-sm-12 form-group">
              <label>Student ID</label>
              <input type="text" name="student_id" class="form-control" >
            </div>
            <div class="col-md-6 col-sm-12 form-group">
              <label>Phone</label>
              <input type="text" name="phone" class="form-control">
            </div>
            <div class="col-md-6 col-sm-12 form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required="">
            </div>
            <div class="col-md-6 col-sm-12 form-group">
              <label>Password</label>
              <input type="password"  id="password" name="password" class="form-control" required="">
            </div>
            <div class="col-md-6 col-sm-12 form-group">
              <label>Confirm Password</label>
              <input type="password" id="cpassword"  class="form-control" required="">
            </div>
            <div class="col-md-6 col-sm-12 form-group">
              <label>Verify</label>
              <select class="form-control" name="verify">
                <option value="0">No</option>
                <option value="1">Yes</option>
              </select>
            </div>
            <div class="col-md-12 col-sm-12 form-group text-right" id="upload_area">
              <input type="file" id="filepicker" onchange="encodeImageFileAsURL(this)" style="display: none;"  />
              <input type="hidden" name="image" id="form_image">
              <div style="display: flex;">
                <div style="width: 50%;" id="image_div"></div>
                <div style="width: 50%;">
                  <button  type="button" class="btn btn-primary" onclick="$('#filepicker').click()" ><i class="fa fa-upload"></i> Upload Image</button>
                </div>
              </div>
              
              
            </div>
            <div class="col-md-12 col-sm-12 form-group text-right" id="crop_area">
              <div id="demo-basic"></div>
              <br>
              <button  type="button" class="btn btn-primary  basic-result"><i class="fa fa-crop"></i> Crop</button>
            </div>
            <div class="col-md-12 col-sm-12 form-group text-right">
              <div id="demo-basic"></div>
              <br>
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
            </form>
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





<script type="text/javascript">
  function encodeImageFileAsURL() {
    var file = document.getElementById("filepicker").files[0];
   // console.log(file);
    var reader = new FileReader();
    reader.onloadend = function() {
     // console.log('RESULT', reader.result);
      filedata = reader.result;
      crop_init();
    }
    reader.readAsDataURL(file);

  }
</script>


<script type="text/javascript">

  var basic;
  var filedata;


  function crop_init(){

    $('#upload_area').hide();


  basic = $('#demo-basic').croppie({
      viewport: {
          width: 200,
          height: 200
      }
  });
  basic.croppie('bind', {
      url: filedata,
      points: [77,469,280,739]
  });

  $('#crop_area').show();


  }



  $('.basic-result').on('click', function() {

    var file = document.getElementById("filepicker");
    file.value = file.defaultValue;
      
      var size = { width: 200, height:200  };
      basic.croppie('result', {
        type: 'canvas',
        size: size,
        resultSize: {
          width: 200,
          height: 200
        }
      }).then(function (resp) {

        $.post("<?php echo base_url();?>Admin/ajax_image_upload",
        {
          image: resp
        },
        function(data, status){

          try {
                var obj = JSON.parse(data);
                  if (obj.status==1){
                    $('#form_image').val(obj.image);
                    var imgx_str = '<img src="<?php echo base_url();?>uploadfiles/students/'+obj.image+'"  class="img-fluid" >';
                    $('#image_div').html(imgx_str);
                  }else{
                    alert('Error In Image');
                  }
              }
              catch(err) {
                alert('Error In Image');
              }

        });
        
        //$('#output').attr('src',resp);
        $('#demo-basic').croppie('destroy');
        $('#crop_area').hide();
        $('#upload_area').show();
      });
    });


</script>


<script type="text/javascript">
  
  function validateform(eve){

    if ($('#password').val()!=$('#cpassword').val()) {
      alert('confirm password not match');
        eve.preventDefault();
        return false;
    }

    if ($('#form_image').val()=="") {
      alert('Upload a image first');
        eve.preventDefault();
        return false;
    }

  }
</script>
