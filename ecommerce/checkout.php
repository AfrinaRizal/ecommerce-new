<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-purple layout-top-nav">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
   
    <div class="content-wrapper">
      <div class="container">

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-sm-9">
              <h1 class="page-header">ORDER</h1>

              <div class="box box-solid">
                <div class="box-body">
                <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
<div class="display-orders">


      <?php
      
      if(isset($_SESSION['user'])){
    $conn = $pdo->open();


$total = 0;         
// $cart_items[] = '';
         $stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products on products.id=cart.product_id WHERE user_id=:user_id");
         $stmt->execute(['user_id'=>$user['id']]);
       foreach($stmt as $row){
      $cart_items[] = $row['name'].' (RM'.number_format($row['price'], 2).' x '. $row['quantity'].') - ';
    $total_products = implode($cart_items);


      $subtotal = $row['price'] * $row['quantity'];
      $total += $subtotal;

      $trackRand=round(microtime(true));
      $trackName='HG';
      $tracking=$trackName.$trackRand;
    }
    
    $pdo->close();


    // echo json_encode($total);
  }
      ?>
        <input type="hidden" name="total_quantity" value="<?= $total_products; ?>">
         <input type="hidden" name="totalPrice" value="<?= $total; ?>" value="">
          <h4 class="cart-item">Products : <span><?= $total_products; ?></span></h4>

         <h4 class="grand-total">Grand Total : <span>RM<?= number_format($total,2); ?></span></h4>
      </div>         

      <div class="col-sm-5">

<!--                       <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo  $row['price']; ?>">
 -->                    </div>
                </form>

                <!-- <table class="table table-bordered">
                  <thead>
                    <th></th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th width="20%">Quantity</th>
                    <th>Subtotal</th>
                  </thead>
                  <tbody id="tbody">
                  </tbody>
                </table> -->
                </div>
              </div>
              
        <div class="modal-content">
            
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="order_add.php" enctype="multipart/form-data">
                <div class="form-group">
                   <input type="hidden" name="total_quantity" value="<?= $total_products; ?>">
         <input type="hidden" name="totalPrice" value="<?= $total; ?>" value="">
                  <input type="hidden" name="trackingNum" value="<?= $tracking; ?>" value="">

                  <label for="name" class="col-sm-1 control-label">Name</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>


                  <label for="category" class="col-sm-1 control-label">Telephone Number</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="telno" name="telno" required>
                  </div>

                 <!--  <div class="col-sm-5">
                    <select class="form-control" id="category" name="category" required>
                      <option value="" selected>- Select -</option>
                    </select>
                  </div> -->
                </div>
                <div class="form-group">
                  <label for="text" class="col-sm-1 control-label">Postcode</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="postcode" name="postcode" required>
                  </div>

                  <label for="photo" class="col-sm-1 control-label">Country</label>

                   <div class="col-sm-5">
                    <input type="text" class="form-control" id="country" name="country" required>
                  </div>



                  <!-- <div class="col-sm-5">
                    <input type="file" id="photo" name="photo">
                  </div> -->
                </div>

                <div class="form-group">

                   <label for="photo" class="col-sm-1 control-label">Address</label>

                   <div class="col-sm-11">
                    <input type="text" class="form-control" id="address" name="address" required>
                  </div>

                

                </div>
<div class="form-group">
   <label for="photo" class="col-sm-2 control-label">Payment Method</label>

                   <div class="col-sm-5">
<select name="method">
               <option value="credit card" >credit card</option>
<!--                <option value="paypal">paypal</option> -->
            </select>
</div>
</div>

               <!--  <p><b>Description</b></p>
                <div class="form-group">
                  <div class="col-sm-12">
                    <textarea id="editor1" name="description" rows="10" cols="80" required></textarea>
                  </div>
                  
                </div> -->
            </div>
            <div class="modal-footer">
<!--               <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Back</button>
 -->
              <a href='cart_view.php' class='btn btn-default btn-flat pull-left'><i class='fa fa-arrow-left'></i> Back</a>

              <a href='payment.php' class='btn btn-primary btn-flat'><i class='fa fa-arrow-right'></i> Next</a>


              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
  

            </div>
            <div class="col-sm-3">
              <?php include 'includes/sidebar.php'; ?>
            </div>
          </div>
        </section>
       
      </div>
    </div>
    <?php $pdo->close(); ?>
    <?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>

</body>
</html>