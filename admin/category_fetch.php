<?php
	include 'includes/session.php';

	$output = '';

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM category");
	$stmt->execute();

	$output .= "<option value='' class='append_items'>-Select-</option>";
	foreach($stmt as $row){
		$output .= "
			<option value='".$row['catergory_id']."' class='append_items'>".$row['category_name']."</option>
		";
	}

	$pdo->close();
	echo json_encode($output);

?>