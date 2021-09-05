<?php
	include 'includes/session.php';
	include 'includes/slugify.php';
	include 'includes/compress_image.php';

	if(isset($_POST['add'])){
		$product_name = $_POST['name'];
		$product_category = $_POST['category'];
		$product_price = $_POST['price'];
		$product_subcategory = $_POST['subcategory'];
		$gst = $_POST['gst'];
		$hsn = $_POST['hsn'];
		// $product_colour = $_POST['colour'];
		$stock = $_POST['stock'];
		$thumbnail = $_FILES['thumbnail']['tmp_name'];
		$thumbnailName = $_FILES['thumbnail']['name'];
		$directory = '../images/product_images/';
		$target_Tfile = $directory . basename($thumbnailName);
		$ThumbimageFileType = strtolower(pathinfo($target_Tfile,PATHINFO_EXTENSION));
		if($ThumbimageFileType != "jpg" && $ThumbimageFileType != "png" && $ThumbimageFileType != "jpeg" && $ThumbimageFileType != "gif" ) {
			$_SESSION['error'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed '.$ThumbimageFileType;
			header('location: products.php');
			exit;
		}
		
		$description = $_POST['description'];
		$i=2;
		$fileCount = count($_FILES['fileToUpload']['tmp_name']);


		$conn = $pdo->open();

			try{
				$stmt = $conn->prepare("INSERT INTO products (product_name, category_id, subcategoty_id, product_description, product_price,stock,gst_no,hsn_code) VALUES (:product_name, :category_id, :subcategory_id, :product_description, :product_price, :stock, :gst, :hsn)");
				$stmt->execute(['product_name'=>$product_name,'category_id'=>$product_category,'subcategory_id'=>$product_subcategory,'product_description'=>$description,'product_price'=>$product_price,'stock'=>$stock,'gst'=>$gst,'hsn'=>$hsn]);
				$stmtGetId = $conn->prepare("SELECT product_id FROM products ORDER BY pro_date DESC LIMIT 1");
				$stmtGetId->execute();
				$product_id = $stmtGetId->fetch();
				$new_Thumbfilename = $product_id['product_id'].'_'.time().'_Thumb.'.$ThumbimageFileType;
				$stmtPhoto = $conn->prepare("INSERT INTO product_photos (product_id,pic1) values (:id,:pic1)");
				$stmtPhoto->execute(['id'=>$product_id['product_id'],'pic1'=>$new_Thumbfilename]);
				//$resultThumb = move_uploaded_file($thumbnail,$directory.$new_Thumbfilename);
				$compressedImage = compressImage($thumbnail, $directory.$new_Thumbfilename, 50);

				if($fileCount<=9){
					foreach($_FILES['fileToUpload']['tmp_name'] as $key => $image){
						$imageName = $_FILES['fileToUpload']['name'][$key];
						$imageTempName = $_FILES['fileToUpload']['tmp_name'][$key];
						//$directory = '../images/product_images/';
						$target_file = $directory . basename($imageName);
						$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
						
			
						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
							$_SESSION['error'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
							break;
						}
			
						$ext = pathinfo($imageName, PATHINFO_EXTENSION);
						$new_filename = $product_id['product_id'].'_'.time().'_'.$i.'.'.$ext;
						$con = $pdo->open();
						$stmt = $con->prepare("UPDATE product_photos SET pic$i=:img_name WHERE product_id=:id");
						$stmt->execute(['img_name'=>$new_filename,'id'=>$product_id['product_id']]);
			
						//$result = move_uploaded_file($imageTempName,$directory.$new_filename);
						$compressedImage = compressImage($imageTempName, $directory.$new_filename, 70);
						$i=$i+1;
					}
			
					// if($result){
					// 	$_SESSION['success'] = 'Product photos updated successfully';
					// }
					$_SESSION['success'] = 'Product added successfully';
				}else{
					$_SESSION['error'] = 'Too many images selected.';
				}
				

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up product form first';
	}

	header('location: products.php');

?>