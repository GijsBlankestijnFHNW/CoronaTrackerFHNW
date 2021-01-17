<?php include(app_path().'/common/admin/header.php'); ?>
<link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">

<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                <h3 class="text-dark mb-4">Archived users</h3>
                <a href="<?php echo url('admin/users'); ?>"><button class="btn btn-primary btn-sm d-sm-inline-block" type="button"><i class="fa fa-users"></i> All users</button></a>
    </div>
    <?php if(Session::has('error')) { ?>
    <p class="alert alert-danger"><?php echo Session::get('error'); ?></p>
    <?php } ?>
    <?php if(Session::has('success')) { ?>
    <p class="alert alert-success"><?php echo Session::get('success'); ?></p>
    <?php } ?>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Client information</p>
                    </div>
                    <div class="card-body">
                        
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table my-0" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone number</th>
                                        <th>Registered on</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(!empty($data)) {
                                        foreach($data as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row->first_name.' '.$row->last_name; ?></td>
                                        <td><?php echo $row->email; ?></td>
                                        <td><?php echo $row->phone_number; ?></td>
                                        <td>
                                            <?php echo date_format(new DateTime($row->on_date), 'd-m-Y'); ?>
                                            <p><?php echo date_format(new DateTime($row->on_date), 'H:i'); ?></p>
                                        </td>
                                        <td>
                                            <form action="" method="post" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="archieve_id" value="<?php echo $row->id; ?>">
                                                <button class="btn btn-success">Un-archived</button>
                                            </form>
                                            
                                            <form action="" method="post" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="delete_id" value="<?php echo $row->id; ?>">
                                                <button class="btn btn-danger" onclick="return confirm('Do you really want to delete this record permanently?')"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php } } ?>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><strong>Name</strong></td>
                                        <td><strong>Email</strong></td>
                                        <td><strong>Phone number</strong></td>
                                        <td><strong>Registered on</strong></td>
                                        <td><strong>Actions</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

<?php include(app_path().'/common/admin/footer.php'); ?>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>