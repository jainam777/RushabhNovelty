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
              <form class="form-horizontal" method="POST" action="products_delete.php">
                <input type="hidden" class="prodid" name="id">
                <div class="text-center">
                    <p>DELETE PRODUCT</p>
                    <h2 class="bold name"></h2>
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


<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Product</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="products_edit.php">
                <input type="hidden" class="prodid" name="id">
                  <div class="form-group">
                    <label for="edit_name" class="col-sm-1 control-label">Name</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control name" id="edit_name" name="name" required>
                    </div>

                    <label for="edit_category" class="col-sm-1 control-label">Category</label>
                    <div class="col-sm-5">
                    <select class="form-control" id="edit_category" name="category">
                      <option selected id="catselected"></option>
                    </select>
                  </div>
                  </div>
                  <div class="form-group">
                    <label for="edit_price" class="col-sm-1 control-label">Price</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="edit_price" name="price" required>
                    </div>
                    <label for="edit_subcategory" class="col-sm-1 control-label">Sub-Category</label>
                    <div class="col-sm-5">
                      <select class="form-control" id="edit_subcategory" name="subcategory">
                        <option selected id="subcatselected"></option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="edit_gst" class="col-sm-1 control-label">GST NO.</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="edit_gst" name="gst" required>
                    </div>
                    <label for="edit_hsn" class="col-sm-1 control-label">HSN Code</label>

                    <div class="col-sm-5">
                      <input type="text"  class="form-control" id="edit_hsn" name="hsn" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="edit_stock" class="col-sm-1 control-label">Product Stock</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="edit_stock" name="stock" required>
                    </div>
                  </div>
                  <p><b>Description</b></p>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <textarea id="editor2" name="description" rows="10" cols="120" required></textarea>
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

