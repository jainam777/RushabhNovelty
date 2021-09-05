<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

        $stmt = $conn->prepare("SELECT subcategory.*,category.category_name FROM subcategory,category WHERE subcategory.category_id=category.catergory_id AND subcategory_id=:id");

		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();
		
		$pdo->close();

		echo json_encode($row);
	}
	else if(isset($_POST['action'])){
		$category = $_POST['category'];

		$conn = $pdo->open();

        $stmt = $conn->prepare("SELECT * FROM subcategory WHERE category_id=:category_id");

		$stmt->execute(['category_id'=>$category]);
		$row = $stmt->fetch();
		
		$pdo->close();

		echo json_encode($row);
	}
?>