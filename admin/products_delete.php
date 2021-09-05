<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

		try{

			$stmtPhoto = $conn->prepare("SELECT pic1,pic2,pic3,pic4,pic5,pic6,pic7 FROM product_photos WHERE product_id=:id");
			$stmtPhoto->execute(['id'=>$id]);
			$i=1;
			foreach($stmtPhoto as $rows){
				while($i<=7){
					if ($rows['pic'.$i] != 'no-image.png') {
						unlink('../images/product_images/'.$rows['pic'.$i]);
						
					}
					$i = $i+1;
				}
				
			}

			$stmt = $conn->prepare("DELETE FROM products WHERE product_id=:id");
			$stmt->execute(['id'=>$id]);

			$_SESSION['success'] = 'Product deleted successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Select product to delete first';
	}

	header('location: products.php');
	
?>