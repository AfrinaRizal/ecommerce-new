<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Shipping Information
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admin</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
             <!--  <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a> -->
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
<!--                   <th>Photo</th>
 -->                   
                  <th class="hidden"></th>

 <th>Date</th>
                  <th>Name</th>
                  <th>Telephone Number</th>
                  <th>Order</th>
                  <th>Address</th>

                  <th>Shipping Status</th>
                  <th>Tracking Number</th>

                  <th>Tools</th>
                  <th>Ref</th>

                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                       try{
                      $now = date('Y-m-d');
                      $stmt = $conn->prepare("SELECT *, sum(totalPrice) as total,  orders.id AS ordersid FROM orders  GROUP BY placed_on");
                      $stmt->execute();
                      foreach($stmt as $row){
                        echo "
                          <tr>
                                                      <td class='hidden'></td>

                            <td>".date('M d, Y', strtotime($row['placed_on']))."</td>
                            <td>".$row['name']."</td>
                                <td>0".$row['telno']."</td>

                            <td>".$row['total_quantity']."</td>
                                                            <td>".$row['address']."</td>

                            <td>".$row['shippingStatus']."</td>
                                                        <td>".$row['trackingNum']."</td>



                            <td>
                              <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
                               

                            </td>
                            <td> 

                            <form method='POST' class='form-inline' action='shipping_print.php?id=".$row['id']."'>
                 <button type='submit' class='btn btn-success btn-sm btn-flat' name='print' ><span class='glyphicon glyphicon-print'></span> Print</button>



                </form>

                            </td>
                          </tr>
                        ";
                      }
                    }
                    catch(PDOException $e){
                      echo $e->getMessage();
                    }

                    $pdo->close();
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
     
  </div>
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/shipping_modal.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){

  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.status', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'shipping_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.ordersid').val(response.id);
      $('#edit_email').val(response.address);
      $('#edit_password').val(response.shippingStatus);
      $('#edit_name').val(response.name);
      $('#edit_lastname').val(response.lastname);
      $('#edit_address').val(response.address);
      $('#edit_order').val(response.total_quantity);
            $('#edit_tracking').val(response.trackingNum);
$('#edit_date').val(response.placed_on);
$('#edit_price').val(response.totalPrice);
$('#edit_telno').val(response.telno);

      $('.name').html(response.name);
    }
  });
}
</script>
</body>
</html>
