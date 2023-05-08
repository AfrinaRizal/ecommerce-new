<?php
	include 'includes/session.php';
	// include 'includes/slugify.php';

// $user_id=$_SESSION['user'];

      
     if(isset($_SESSION['user'])){

    $conn = $pdo->open();
if(isset($_POST['order-btn'])){

$total = 0;         
// $cart_items[] = '';
         $stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products on products.id=cart.product_id WHERE user_id=:user_id");
         $stmt->execute(['user_id'=>$user['id']]);
       foreach($stmt as $row){
      $cart_items[] = $row['name'].' ('.$row['price'].' x '. $row['quantity'].') - ';
    $total_products = implode($cart_items);

 $product_id = $row['product_id'];
            $qty = $row['quantity'];
            $stock = $row['stock'];;
            $updatedstock = $stock-$qty ;

            try{
      $stmt = $conn->prepare("UPDATE products SET stock = '$updatedstock' WHERE id = '$product_id'");
      $stmt->execute([ 'id'=>$product_id]);
      // $output['message'] = 'Updated';

          

    }


    catch(PDOException $e){
      $output['message'] = $e->getMessage();
    }


 $subtotal = $row['price'] * $row['quantity'];
            $total += $subtotal;

      $fee = 0.10 * $total;
          $grandtotal=$total+$fee;

$stmt = $conn->prepare("SELECT MAX(id) AS id FROM orders WHERE user_id = :user_id AND paymentStatus = 'Pending'");
   		$stmt->execute(['user_id'=>$user['id']]);

   $row =$stmt->fetch();
   // print_r($row);
   $order_id = $row['id'];

try{
			$stmt = $conn->prepare("UPDATE orders SET paymentStatus = 'Paid' WHERE id = '$order_id'");
			$stmt->execute([ 'id'=>$order_id]);
			// $output['message'] = 'Updated';

					

		}


		catch(PDOException $e){
			$output['message'] = $e->getMessage();
		}

if(!$stmt) {
      echo "<script>alert('Payment Failed'); window.history.go(-1);</script>";
      exit();
   } else {
				$stmt = $conn->prepare("DELETE FROM cart WHERE user_id = :user_id");
			$stmt->execute(['user_id'=>$user['id']]);      
			echo "<script>alert('Payment Success'); window.location='list_order.php';</script>";
      exit();
   }
   
    }


	
    $pdo->close();

    // echo json_encode($total);
  }
      }

?>