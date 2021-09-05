<div class="modal fade" id="ptransaction">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Product Details</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="product_edit.php">
                <input type="hidden" class="prodid" name="id">
                <div class="form-group">
                    <label for="edit_name" class="col-sm-3 control-label">Product Name:</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_name" name="name" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_description" class="col-sm-3 control-label">Description:</label>

                    <div class="col-sm-9">
                      <textarea id='edit_description' class="form-control" name='description' readonly></textarea> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_colour" class="col-sm-3 control-label">Colour:</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_colour" name="edit_colour" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="catselected" class="col-sm-3 control-label">Primary Room:</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="catselected" name="category" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for='edit_p_size' class="col-sm-3 control-label">Product Size:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_p_size" name="size" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_price" class="col-sm-3 control-label">Product Price:</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_price" name="contact" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              </form>
            </div>
        </div>
    </div>
</div>