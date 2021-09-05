<?php
	session_start();
	include 'components/conn.php';
	
	if(isset($_SESSION['rushabh_novelty_admin'])){
		header('location: admin/home.php');
	}

	if(isset($_SESSION['rushabh_novelty_user'])){
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("SELECT * FROM users WHERE user_id=:id");
			$stmt->execute(['id'=>$_SESSION['rushabh_novelty_user']]);
			$user = $stmt->fetch();
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}

		$pdo->close();
	}
?>