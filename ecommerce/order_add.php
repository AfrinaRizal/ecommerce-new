<?php
	include 'includes/session.php';
	include 'includes/slugify.php';

$user_id=$_SESSION['user'];


	if(isset($_POST['add'])){
		$name = $_POST['name'];
		$postcode = $_POST['postcode'];
		$telno = $_POST['telno'];
				$address = $_POST['address'];
				$country = $_POST['country'];

		$total_quantity = $_POST['total_quantity'];
		$totalPrice = $_POST['totalPrice'];
	$trackingNum = $_POST['trackingNum'];

		$paymentStatus = "Pending";
		$method = $_POST['method'];


		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM orders");
		$stmt->execute([]);
		$row = $stmt->fetch();

		

			try{
				$stmt = $conn->prepare("INSERT INTO orders (user_id, name, postcode, telno, address, country, total_quantity, totalPrice,  trackingNum, paymentStatus, method) VALUES (:user_id, :name, :postcode, :telno,  :address, :country, :total_quantity, :totalPrice, :trackingNum, :paymentStatus, :method )");
				$stmt->execute(['user_id'=>$user_id,'name'=>$name, 'postcode'=>$postcode, 'telno'=>$telno,'address'=>$address,'country'=>$country, 'total_quantity'=>$total_quantity, 'totalPrice'=>$totalPrice, 'trackingNum'=>$trackingNum,'paymentStatus'=>$paymentStatus, 'method'=>$method]);
				// $_SESSION['success'] = 'Order added successfully';


			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up product form first';
	}
				 echo "<script>alert('Order Saved'); window.location='payment.php';</script>";

	// header('location: payment.php');

?>