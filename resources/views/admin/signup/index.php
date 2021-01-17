<!doctype html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo url('admin_assets/css/register.css'); ?>">
	<link rel="icon" type="image/png" href="https://cdn.pixabay.com/photo/2020/04/29/07/54/coronavirus-5107715_1280.png">
    <title>Admin - Register</title>
  </head>
  <body>
    
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
             
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">Register</h5>
            <form class="form-signin" action="" method="post" id="register_form">
                <?php echo csrf_field(); ?>
              <div class="form-label-group">
                <input type="text" id="inputUserame" class="form-control" placeholder="Username" required autofocus name="username">
                <label for="inputUserame">Username</label>
              </div>

              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required name="email">
                <label for="inputEmail">Email address</label>
              </div>
              
              <hr>

              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="pass1">
                <label for="inputPassword">Password</label>
              </div>
              
              <div class="form-label-group">
                <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Password" required name="pass2">
                <label for="inputConfirmPassword">Confirm password</label>
              </div>

                <p class="alert alert-success" id="success" style="display:none;"><i class="fa fa-check-circle"></i> Registered sucessfully, redirecting...</p>
                <p class="alert alert-danger" id="error" style="display:none;"></p>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" id="submit_btn">Register</button>
              <a class="d-block text-center mt-2 small" href="<?php echo url('admin/login'); ?>">Sign In</a>
              <hr class="my-4">
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
	
	

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
        $("#register_form").submit(function(e){
        e.preventDefault();
            
        var formData=new FormData(this);
        $.ajax({
            url: "<?php echo url('admin/signup'); ?>",
            type: "POST",
            data:  formData,
            beforeSend: function(){ //alert('sending');
                $("#submit_btn").attr('disabled', true);
                $("#error").hide();
            },
            contentType: false,
            processData:false,
            success: function(data) { //alert(data);
                //success
                // here we will handle errors and validation messages
                if ( ! data.success) {
                    $("#submit_btn").attr('disabled', false);
                    $("#error").text(data.error);
                    $("#error").show();
                } else {
                    // ALL GOOD! just show the success message!
                    $("#success").show();
                    window.location='<?php echo url('admin/dashboard'); ?>';
                }
            },
            error: function()  {
                //error
            } 	        
        });
    });
    </script>
  </body>
</html>