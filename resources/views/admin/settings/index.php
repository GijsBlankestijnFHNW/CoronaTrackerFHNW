<?php include(app_path().'/common/admin/header.php'); ?>

<div class="container-fluid">
                <h3 class="text-dark mb-4">Account settings</h3>
    <?php if(Session::has('error')) { ?>
    <p class="alert alert-danger"><?php echo Session::get('error'); ?></p>
    <?php } ?>
    <?php if(Session::has('success')) { ?>
    <p class="alert alert-success"><?php echo Session::get('success'); ?></p>
    <?php } ?>
                <div class="row mb-3">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">Change password</p>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <input type="file" name="profile_image" id="profile_image" class="d-none file">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="password"><strong>Current password</strong></label><input class="form-control" type="password" placeholder="" name="pass" required></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="password"><strong>New password</strong></label><input class="form-control" type="password" placeholder="" name="pass1" required></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="password"><strong>Confirm password</strong></label><input class="form-control" type="password" placeholder="" name="pass2" required></div>
                                                </div>
                                            </div>
                                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Update password</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include(app_path().'/common/admin/footer.php'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script>
    $(document).on('click', '.browse', function(){
                    var file = $('#profile_image');
                    file.trigger('click');
                  });

		  $(document).on('change', '.file', function(e){
                      var o=new FileReader;
                      o.readAsDataURL(e.target.files[0]),o.onloadend=function(o){
                          $("#current_img").attr("src",o.target.result); 
                      }
                    //$(this).prev().text($(this).val().replace(/C:\\fakepath\\/i, ''));
                  });
</script>
</script>