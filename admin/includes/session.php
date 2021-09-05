<?php
	session_start();
	include 'conn.php';
	

	if(!isset($_SESSION['rushabh_novelty_admin']) || trim($_SESSION['rushabh_novelty_admin']) == ''){
		header('location: ../index.php');
		exit();
	}

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM users WHERE user_id=:id");
	$stmt->execute(['id'=>$_SESSION['rushabh_novelty_admin']]);
	$admin = $stmt->fetch();

	$pdo->close();

?>