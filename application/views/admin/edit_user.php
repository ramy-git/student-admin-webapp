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
          <h3 class="box-title">User</h3>
        </div>
        <div class="box-body">
          <div class="row">

            <?php foreach ($user as $key => $userVAL) { ?>
             
            <form action="<?php echo base_url();?>Admin/process_update_user" method="post" onsubmit="validateform(event)" >
              <input type="hidden" name="id" value="<?php echo $userVAL->id; ?>">
            <div class="col-md-6 col-sm-12 form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control" required="" value="<?php echo $userVAL->name;?>">
            </div>
            <div class="col-md-6 col-sm-12 form-group">
              <label>Surname</label>
              <input type="text" name="surname" class="form-control" required="" value="<?php echo $userVAL->surname;?>">
            </div>
            <div class="col-md-6 col-sm-12 form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required="" value="<?php echo $userVAL->email;?>">
            </div>
            <div class="col-md-6 col-sm-12 form-group">
              <label>User Type</label>
              <select class="form-control" name="type" >
                <option  <?php if($userVAL->type=='teacher'){ echo 'selected'; } ?> value="teacher">Teacher</option>
                <option <?php if($userVAL->type=='admin'){ echo 'selected'; } ?> value="admin">Admin</option>
              </select>
            </div>
            <div class="col-md-6 col-sm-12 form-group">
              <label>Password</label>
              <input type="password"  id="password" name="password" class="form-control" value="<?php echo $userVAL->password;?>" required="">
            </div>
            <div class="col-md-6 col-sm-12 form-group">
              <label>Confirm Password</label>
              <input type="password" id="cpassword"  class="form-control"  required="" value="<?php echo $userVAL->password;?>">
            </div>

            <div class="col-md-12 col-sm-12 form-group text-right" id="upload_area">
              <input type="file" id="filepicker" onchange="encodeImageFileAsURL(this)" style="display: none;"  />
              <input type="hidden" name="image" id="form_image" value="<?php echo $userVAL->image;?>">
              <div style="display: flex;">
                <div style="width: 50%;" id="image_div">
                  <img src="<?php echo base_url();?>uploadfiles/students/<?php echo $userVAL->image;?>"  class="img-fluid" >
                </div>
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
