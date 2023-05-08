<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
					
				$shippingStatus = $_POST['shippingStatus'];


		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE orders SET shippingStatus=:shippingStatus WHERE id=:id");
			$stmt->execute(['shippingStatus'=>$shippingStatus, 'id'=>$id]);
			$_SESSION['success'] = 'Shipping Status updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit shipping info form first';
	}

	header('location:shipping.php');

?>