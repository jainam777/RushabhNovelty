<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("DELETE FROM subcategory WHERE subcategory_id=:id");
			$stmt->execute(['id'=>$id]);

			$_SESSION['success'] = 'Sub-Category deleted successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Select Subcategory to delete first';
	}

	header('location: subcategory.php');
	
?>