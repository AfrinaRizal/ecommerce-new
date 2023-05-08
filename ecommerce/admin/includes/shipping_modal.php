<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Shipping</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="shipping_edit.php">
                <input type="hidden" class="ordersid" name="id">
                <div class="form-group">


                    <label for="edit_date" class="col-sm-3 control-label">Order Date</label>

                    <div class="col-sm-9">
                      <input type="placed_on" class="form-control" id="edit_date" name="placed_on" readonly="">
                    </div>
                </div>
                <div class="form-group">


                    <label for="edit_name" class="col-sm-3 control-label">Name</label>

                    <div class="col-sm-9">
                      <input type="name" class="form-control" id="edit_name" name="name" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_email" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" id="edit_email" name="address" readonly=""></textarea>
                    </div>
                </div>
                <div class="form-group">


                    <label for="edit_telno" class="col-sm-3 control-label">Telephone Number</label>

                    <div class="col-sm-9">
                      <input type="telno" class="form-control" id="edit_telno" name="telno" readonly="">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="edit_order" class="col-sm-3 control-label">Order</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" id="edit_order" name="total_quantity" readonly=""></textarea>
                    </div>
                </div>  

                 <div class="form-group">
                    <label for="edit_price" class="col-sm-3 control-label">Total Price</label>

                    <div class="col-sm-9">
                      <input type="totalPrice" class="form-control" id="edit_price" name="totalPrice" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_tracking" class="col-sm-3 control-label">Tracking Number</label>

                    <div class="col-sm-9">
                      <input type="trackingNum" class="form-control" id="edit_tracking" name="trackingNum" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_password" class="col-sm-3 control-label">Shipping Status</label>

                   <!--  <div class="col-sm-9">
                      <input type="paymentStatus" class="form-control" id="edit_password" name="paymentStatus">
                    </div> -->
                    <select name="shippingStatus">
               <option value="Preparing to ship" >Preparing to ship</option>
                              <option value="Ready to ship" >Ready to ship</option>
                              <option value="Product had been shipped by courier" >Product had been shipped by courier</option>
                              <option value="Product had been delivered" >Product had been delivered</option>


<!--                <option value="paypal">paypal</option> -->
            </select>
                </div>


                
                <!-- <div class="form-group">
                    <label for="edit_lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_lastname" name="lastname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_address" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" id="edit_address" name="address"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_contact" class="col-sm-3 control-label">Contact Info</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_contact" name="contact">
                    </div>
                </div> -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>