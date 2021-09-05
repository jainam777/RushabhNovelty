<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New City</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="delivery_add.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="city" class="col-sm-3 control-label">City</label>

                    <div class="col-sm-9">
                      <input type="city" class="form-control" id="city" name="city" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">Rate</label>

                    <div class="col-sm-9">
                      <input type="price" class="form-control" id="price" name="price" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-3 control-label">Status</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="status" name="status" required>
                    </div>
                </div>
                <div class="col-sm-9">
                  Set status as 0 for Bus Delivery at specific city otherwise 1.
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
              <form class="form-horizontal" method="POST" action="delivery_edit.php">
                <input type="hidden" class="cid" name="id">
                <div class="form-group">
                    <label for="edit_city" class="col-sm-3 control-label">City</label>
                    <div class="col-sm-9">
                      <input type="city" class="form-control" id="edit_city" name="city">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_price" class="col-sm-3 control-label">Rate</label>

                    <div class="col-sm-9">
                      <input type="price" class="form-control" id="edit_price" name="price">
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
              <form class="form-horizontal" method="POST" action="delivery_delete.php">
                <input type="hidden" class="cid" name="id">
                <div class="text-center">
                    <p>DELETE CITY</p>
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



     