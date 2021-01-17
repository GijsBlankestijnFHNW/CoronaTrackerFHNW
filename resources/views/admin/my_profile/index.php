<?php include(app_path().'/common/admin/header.php'); ?>

<div class="container-fluid">
                <h3 class="text-dark mb-4">My Profile</h3>
    <?php if(Session::has('error')) { ?>
    <p class="alert alert-danger"><?php echo Session::get('error'); ?></p>
    <?php } ?>
    <?php if(Session::has('success')) { ?>
    <p class="alert alert-success"><?php echo Session::get('success'); ?></p>
    <?php } ?>
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="<?php if($admin->profile_image!='') echo url('profile_images/'.$admin->profile_image); else echo url('admin_assets/img/avatars/user_placeholder.png'); ?>" width="160" height="160" id="current_img">
                                <div class="mb-3"><button class="btn btn-primary btn-sm browse" type="button">Change Photo</button></div>
                            </div>
                        </div>
                        <div class="card shadow mb-4"></div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">Personal Information</p>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <input type="file" name="profile_image" id="profile_image" class="d-none file">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="username"><strong>Username</strong></label><input class="form-control" type="text" placeholder="" name="username" required value="<?php echo $admin->username ?>"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="email"><strong>Email address</strong></label><input class="form-control" type="email" placeholder="user@example.com" name="email" required value="<?php echo $admin->email; ?>"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="first_name"><strong>First name</strong></label><input class="form-control" type="text" placeholder="" name="first_name" value="<?php echo $admin->first_name; ?>"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="last_name"><strong>Last name</strong></label><input class="form-control" type="text" placeholder="" name="last_name" value="<?php echo $admin->last_name; ?>"></div>
                                                </div>
                                            </div>
                                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Save Changes</button></div>
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