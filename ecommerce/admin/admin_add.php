<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
				$photo = $_POST['photo'];

		

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM admin WHERE email=:email");
		$stmt->execute(['email'=>$email]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Email already exist';
		}
		else{
			$password = password_hash($password, PASSWORD_DEFAULT);
			// $filename = $_FILES['photo']['name'];
			// $now = date('Y-m-d');
			// if(!empty($filename)){
			// 	move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
			// }
			try{
				$stmt = $conn->prepare("INSERT INTO admin (name, email, password) VALUES (:name, :email, :password)");
				$stmt->execute(['name'=>$name, 'email'=>$email, 'password'=>$password]);
				$_SESSION['success'] = 'Admin added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up user form first';
	}

	header('location: admins.php');

?>