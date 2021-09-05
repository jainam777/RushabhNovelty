<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New User</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_add.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Mobile No.</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="contact" name="contact">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-8 control-label">Address</label>
                </div>

                <div class="form-group">
                    <label for='h_no' class="col-sm-3 control-label">House NO./Building Name/Apt Name:</label>

                    <div class="col-sm-9">
                      <input type='text' id='house_no' class="form-control" name='house_no' required>
                    </div>
                </div>
                <div class="form-group">
                    <label for='street' class="col-sm-3 control-label">Street:</label>

                    <div class="col-sm-9">
                      <input type='text' id='street' class="form-control" name='street' required>
                    </div>
                </div>
                <div class="form-group">
                    <label for='landmark' class="col-sm-3 control-label">Landmark:</label>

                    <div class="col-sm-9">
                      <input type='text' id='landmark' class="form-control" name='landmark' required>
                    </div>
                </div>
                <div class="form-group">
                    <label for='city' class="col-sm-3 control-label">City:</label>

                    <div class="col-sm-9">
                      <input type='text' id='city' class="form-control" name='city' required>
                    </div>
                </div>
                <div class="form-group">
                    <label for='state' class="col-sm-3 control-label">State:</label>

                    <div class="col-sm-9">
                      <input type='text' id='state' class="form-control" name='state' required>
                    </div>
                </div>
                <div class="form-group">
                    <label for='pincode' class="col-sm-3 control-label">Pincode:</label>

                    <div class="col-sm-9">
                      <input type='text' id='pincode' class="form-control" name='pincode' required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit User</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_edit.php">
                <input type="hidden" class="userid" name="id">
                <div class="form-group">
                    <label for="edit_email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="edit_email" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Nane</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_firstname" name="firstname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_contact" class="col-sm-3 control-label">Contact Info</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_contact" name="contact">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-8 control-label">Address</label>
                </div>

                <div class="form-group">
                    <label for='edit_house_name' class="col-sm-3 control-label">House NO./Building Name/Apt Name:</label>

                    <div class="col-sm-9">
                      <input type='text' id='edit_house_name' class="form-control" name='house_no' required>
                    </div>
                </div>
                <div class="form-group">
                    <label for='edit_street' class="col-sm-3 control-label">Street:</label>

                    <div class="col-sm-9">
                      <input type='text' id='edit_street' class="form-control" name='street' required>
                    </div>
                </div>
                <div class="form-group">
                    <label for='edit_landmark' class="col-sm-3 control-label">Landmark:</label>

                    <div class="col-sm-9">
                      <input type='text' id='edit_landmark' class="form-control" name='landmark' required>
                    </div>
                </div>
                <div class="form-group">
                    <label for='edit_city' class="col-sm-3 control-label">City:</label>

                    <div class="col-sm-9">
                      <input type='text' id='edit_city' class="form-control" name='city' required>
                    </div>
                </div>
                <div class="form-group">
                    <label for='edit_state' class="col-sm-3 control-label">State:</label>

                    <div class="col-sm-9">
                      <input type='text' id='edit_state' class="form-control" name='state' required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_pincode" class="col-sm-3 control-label">Pincode:</label>

                    <div class="col-sm-9">
                      <input type='text' id="edit_pincode" class="form-control" name='pincode' required>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_delete.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>DELETE USER</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>


<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_photo.php" enctype="multipart/form-data">
                <input type="hidden" class="userid" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div> 


<!-- Activate -->
<div class="modal fade" id="activate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Activating...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_activate.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>ACTIVATE USER</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="activate"><i class="fa fa-check"></i> Activate</button>
              </form>
            </div>
        </div>
    </div>
</div> 


     