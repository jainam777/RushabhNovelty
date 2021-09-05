<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT products.*,category_name,subcategory_name FROM products,category,subcategory WHERE products.category_id=category.catergory_id AND products.subcategoty_id=subcategory_id AND products.product_id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();
		
		$pdo->close();

		echo json_encode($row);
	}
?>
