<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
        $name = $_POST['name'];
		$catname = $_POST['catname'];
	//	echo $id." ".$name." ".$catname;

		try{
            $stmtCat = $conn->prepare("SELECT catergory_id FROM category WHERE category_name=:catname");
            $stmtCat->execute(['catname'=>$catname]);
            $category = $stmtCat->fetch();
            
			$stmt = $conn->prepare("UPDATE subcategory SET subcategory_name=:name,category_id=:cat_id WHERE subcategory_id=:id");
			$stmt->execute(['name'=>$name, 'id'=>$id,'cat_id'=>$category['catergory_id']]);
			$_SESSION['success'] = 'Sub-Category updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit category form first';
	}

	header('location: subcategory.php');

?>