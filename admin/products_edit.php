<?php
	include 'includes/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$product_name = $_POST['name'];
		$product_category = $_POST['category'];
		$product_price = $_POST['price'];
		$product_subcategory = $_POST['subcategory'];
		$gst = $_POST['gst'];
		$hsn = $_POST['hsn'];
		// $product_colour = $_POST['colour'];
		$stock = $_POST['stock'];
		$description = $_POST['description'];

		$conn = $pdo->open();


		try{
			$stmt = $conn->prepare("UPDATE products SET product_name=:name, category_id=:category, subcategoty_id=:subcategory, product_description=:description, product_price=:price,stock=:stock, gst_no=:gst, hsn_code=:hsn WHERE product_id=:id");
			$stmt->execute(['name'=>$product_name, 'category'=>$product_category, 'subcategory'=>$product_subcategory, 'description'=>$description, 'price'=>$product_price, 'stock'=>$stock, 'gst'=>$gst, 'hsn'=>$hsn, 'id'=>$id]);
			$_SESSION['success'] = 'Product updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit product form first';
	}

	header('location: products.php');

?>