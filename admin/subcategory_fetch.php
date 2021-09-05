<?php
	include 'includes/session.php';

	$output = '';

	$conn = $pdo->open();
	if(isset($_POST['action'])){
		$category = $_POST['category'];
		$stmtTotal = $conn->prepare("SELECT count(*) as total FROM subcategory WHERE category_id=:category_id");
		$stmt = $conn->prepare("SELECT * FROM subcategory WHERE category_id=:category_id");
		$stmt->execute(['category_id'=>$category]);
		$stmtTotal->execute(['category_id'=>$category]);
		$total = $stmtTotal->fetch();
	}
	else{
		$stmt = $conn->prepare("SELECT * FROM subcategory");
		$stmt->execute();
		$stmtTotal = $conn->prepare("SELECT count(*) as total FROM subcategory");
		$stmtTotal->execute();
	}
	
	if($total['total']==0){
		$output .= "
		<option value='' class='append_items'>-Select-</option>
	";	
	}else{
		foreach($stmt as $row){
			$output .= "
			<option value='".$row['subcategory_id']."' class='append_items'>".$row['subcategory_name']."</option>
		";
		}
	}
	

	$pdo->close();
	echo json_encode($output);

?>