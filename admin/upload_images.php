<?php
include 'includes/session.php';
include 'includes/compress_image.php';

if(isset($_POST['upload'])){
    $id = $_POST['id'];
    $result = false;
    $i=1;

    $imageName = $_FILES['fileToUpload']['name'];
    $imageTempName = $_FILES['fileToUpload']['tmp_name'];
    $directory = '../images/product_images/';
    $target_file = $directory . basename($imageName);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $_SESSION['error'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
        header('location: products.php');
        exit;
    }

    $ext = pathinfo($imageName, PATHINFO_EXTENSION);
    $new_filename = $id.'_'.time().'_'.$i.'.'.$ext;
    $con = $pdo->open();

    $stmtPhoto = $conn->prepare("SELECT pic1 FROM product_photos WHERE product_id=:id");
    $stmtPhoto->execute(['id'=>$id]);
    $rows = $stmtPhoto->fetch();
    if ($rows['pic1'] != 'no-image.png') {
        unlink('../images/product_images/'.$rows['pic1']);
    }

    $stmt = $con->prepare("UPDATE product_photos SET pic1=:img_name WHERE product_id=:id");
    $stmt->execute(['img_name'=>$new_filename,'id'=>$id]);

    //$result = move_uploaded_file($imageTempName,$directory.$new_filename);
    $result = compressImage($imageTempName, $directory.$new_filename, 50);


    if($result){
        $_SESSION['success'] = 'Product photos updated successfully';
    }else{
        $_SESSION['error'] = 'Product photos update failed';
    }

}

header('location: products.php');

?>