<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		
		$email = $_POST['email'];
		$password = $_POST['password'];
	

		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM admin WHERE email=:email");
		$stmt->execute(['email'=>$email]);
		$row = $stmt->fetch();



		if($password == $row['password'])
		{
			$password = $row['password'];
		}
		else
		{
			$password = password_hash($password, PASSWORD_DEFAULT);
		}

		try{
			$stmt = $conn->prepare("UPDATE admin SET name=:name,email=:email, password=:password WHERE id=:id");
			$stmt->execute(['name'=>$name,'email'=>$email, 'password'=>$password, 'id'=>$id]);
			$_SESSION['success'] = 'Admin updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit admin form first';
	}

	header('location: admins.php');

?>