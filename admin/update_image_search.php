<?php
include 'includes/session.php';
include 'includes/compress_image.php';

if(isset($_POST['upload'])){
    $id = $_POST['id'];
    $col = $_POST['pic'];
    $result = false;
    $imageTempName = $_FILES['fileToUpload']['tmp_name'];
    $imageName = $_FILES['fileToUpload']['name'];
    $directory = '../images/product_images/';
    $target_file = $directory . basename($imageName);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $_SESSION['error'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed '.$imageFileType;
    }else{
            $new_filename = $id.'_'.time().'_'.$col.'.'.$imageFileType;
            $con = $pdo->open();

            $stmtPhoto = $conn->prepare("SELECT $col FROM product_photos WHERE product_id=:id");
            $stmtPhoto->execute(['id'=>$id]);
            $rows = $stmtPhoto->fetch();
            if ($rows[$col] != 'no-image.png') {
                unlink('../images/product_images/'.$rows[$col]);
            }

            $stmt = $con->prepare("UPDATE product_photos SET $col=:img_name WHERE product_id=:id");
            $stmt->execute(['img_name'=>$new_filename,'id'=>$id]);
            //$result = move_uploaded_file($imageTempName,$directory.$new_filename);
            $result = compressImage($imageTempName, $directory.$new_filename, 50);

            if($result){
                $_SESSION['success'] = 'Product photos updated successfully';
            }
    }
}

header('location: product_photos_search.php');

?>