<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
        $name = $_POST['name'];
		$catname = $_POST['catname'];

		$conn = $pdo->open();

			try{
                $stmtCat = $conn->prepare("SELECT catergory_id FROM category WHERE category_name=:catname");
                $stmtCat->execute(['catname'=>$catname]);
                $category = $stmtCat->fetch();
				$stmt = $conn->prepare("INSERT INTO subcategory (subcategory_name,category_id) VALUES (:name,:cat_id)");
				$stmt->execute(['name'=>$name,'cat_id'=>$category['catergory_id']]);
				$_SESSION['success'] = 'Category added successfully';
			}
			catch(PDOException $e){
                $_SESSION['error'] = $e->getMessage();
			}

		$pdo->close();
	}
	else{
        $_SESSION['error'] = 'Fill up category form first';
	}

	header('location: subcategory.php');

?>