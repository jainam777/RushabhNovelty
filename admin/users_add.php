<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$contact = $_POST['contact'];
		$house = $_POST['house_no'];
		$street = $_POST['street'];
		$landmark = $_POST['landmark'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$pincode = $_POST['pincode'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE email=:email");
		$stmt->execute(['email'=>$email]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Email already taken';
		}
		else{
			$password = password_hash($password, PASSWORD_DEFAULT);

			$now = date('Y-m-d');
			try{
				$stmt = $conn->prepare("INSERT INTO users (email, password, name, house_name, street, landmark, city, state, pincode, mobile, account_created_on) VALUES (:email, :password, :firstname, :house_name, :street, :landmark, :city, :state, :pincode, :contact, :created_on)");
				$stmt->execute(['email'=>$email, 'password'=>$password, 'firstname'=>$firstname, 'house_name'=>$house,'street'=>$street,'landmark'=>$landmark,'city'=>$city,'state'=>$state,'pincode'=>$pincode, 'contact'=>$contact, 'created_on'=>$now]);
				$_SESSION['success'] = 'User added successfully';

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

	header('location: users.php');

?>