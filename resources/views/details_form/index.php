<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo url('css/main.css'); ?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" type="image/png" href="https://cdn.pixabay.com/photo/2020/04/29/07/54/coronavirus-5107715_1280.png">
    <title>Corona tracing - Switzerland</title>
      
  </head>
  <body>
	
	<div class="container-fluid">
	  <div class="row no-gutter">
		<div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
		<div class="col-md-8 col-lg-6">
		  <div class="login d-flex align-items-center py-5">
			<div class="container">
			  <div class="row">
                <div class="col-md-9 col-lg-8 mx-auto" id="success" style="display:none; font-size:20px;">
                    <p class="alert alert-success"><i class="fa fa-check-circle"></i> Thank you for filling in the details.</p>
                  </div>
				<div class="col-md-9 col-lg-8 mx-auto" id="form_box">
				  <h3 class="login-heading mb-4">Please fill in the form</h3>
                    <p class="alert alert-danger" id="error" style="display:none;">Error</p>
				  <form action="" method="post" id="details_form">
                      <?php echo csrf_field(); ?>
	  <div class="form-group row">
		<label for="text" class="col-4 col-form-label">First name</label> 
		<div class="col-8">
		  <div class="input-group">
			<div class="input-group-prepend">
			  <div class="input-group-text">
				<i class="fa fa-address-card-o"></i>
			  </div>
			</div> 
			<input id="text" name="first_name" type="text" class="form-control" required="required">
		  </div>
		</div>
	  </div>
	  <div class="form-group row">
		<label for="text1" class="col-4 col-form-label">Last name</label> 
		<div class="col-8">
		  <div class="input-group">
			<div class="input-group-prepend">
			  <div class="input-group-text">
				<i class="fa fa-address-card-o"></i>
			  </div>
			</div> 
			<input id="text1" name="last_name" type="text" class="form-control" required="required">
		  </div>
		</div>
	  </div>
	  <div class="form-group row">
		<label for="text2" class="col-4 col-form-label">Phone Number</label> 
		<div class="col-8">
		  <div class="input-group">
			<div class="input-group-prepend">
			  <div class="input-group-text">
				<i class="fa fa-mobile-phone"></i>
			  </div>
			</div> 
			<input id="text2" name="phone_number" type="text" class="form-control" required="required">
		  </div>
		</div>
	  </div>
	  <div class="form-group row">
		<label for="text3" class="col-4 col-form-label">Email Adress</label> 
		<div class="col-8">
		  <div class="input-group">
			<div class="input-group-prepend">
			  <div class="input-group-text">
				<i class="fa fa-envelope-open-o"></i>
			  </div>
			</div> 
			<input id="text3" name="email" type="email" class="form-control" required="required">
		  </div>
		</div>
	  </div>
	  <div class="form-group row">
		<label class="col-4"></label> 
		<div class="col-8">
		  <div class="custom-control custom-checkbox custom-control-inline">
			<input name="checkbox" id="checkbox_0" type="checkbox" class="custom-control-input" value="consent" aria-describedby="checkboxHelpBlock" required="required"> 
			<label for="checkbox_0" class="custom-control-label">I confirm </label>
		  </div> 
		  <span id="checkboxHelpBlock" class="form-text text-muted">That all the above information I have provided is valid and up to date.</span>
		</div>
	  </div> 
	  <div class="form-group row">
		<div class="offset-4 col-8">
		  <button name="submit" type="submit" class="btn btn-primary" id="submit_btn">Submit</button>
		</div>
	  </div>
	</form>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
        $("#details_form").submit(function(e){
        e.preventDefault();
            
        var formData=new FormData(this);
        $.ajax({
            url: "<?php echo url('save-details'); ?>",
            type: "POST",
            data:  formData,
            beforeSend: function(){ //alert('sending');
                $("#submit_btn").attr('disabled', true);
                $("#error").hide();
            },
            contentType: false,
            processData:false,
            success: function(data) { //alert(data);
                $("#submit_btn").attr('disabled', false);
                //success
                // here we will handle errors and validation messages
                if ( ! data.success) {
                    $("#error").text(data.error);
                    $("#error").show();
                } else {
                    // ALL GOOD! just show the success message!
                    $("#success").show();
                    $("#form_box").hide();
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