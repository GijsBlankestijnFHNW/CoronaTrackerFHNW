<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo url('admin_assets/css/login.css'); ?>">
	<link rel="icon" type="image/png" href="https://cdn.pixabay.com/photo/2020/04/29/07/54/coronavirus-5107715_1280.png">
    <title>Admin - Login</title>
  </head>
  <body>
	
	<div class="container-fluid">
	  <div class="row no-gutter">
		<div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
		<div class="col-md-8 col-lg-6">
		  <div class="login d-flex align-items-center py-5">
			<div class="container">
			  <div class="row">
				<div class="col-md-9 col-lg-8 mx-auto">
				  <h3 class="login-heading mb-4">Welcome back!</h3>
				  <form action="" method="post" id="login_form">
                      <?php echo csrf_field(); ?>
					<div class="form-label-group">
					  <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email">
					  <label for="inputEmail">Email address</label>
					</div>

					<div class="form-label-group">
					  <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="pass">
					  <label for="inputPassword">Password</label>
					</div>

					<div class="custom-control custom-checkbox mb-3">
					  <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember" checked>
					  <label class="custom-control-label" for="customCheck1">Remember me</label>
					</div>
                      <p class="alert alert-success" id="success" style="display:none;"><i class="fa fa-check-circle"></i> Logged in sucessfully, redirecting...</p>
                    <p class="alert alert-danger" id="error" style="display:none;"></p>
					<button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" id="submit_btn">Sign in</button>
					<div class="text-center">
					  <a class="small" href="<?php echo url('admin/signup'); ?>">Register as Admin</a></div>
				  </form>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
        $("#login_form").submit(function(e){
        e.preventDefault();
            
        var formData=new FormData(this);
        $.ajax({
            url: "<?php echo url('admin/login'); ?>",
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