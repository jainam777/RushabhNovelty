<?php include 'includes/session.php'; ?>
<?php

if(isset($_POST['search'])){
  $proName = $_POST['search'];
}else if(isset($_POST['searchId'])){
  $proId = $_POST['searchId'];
}

  $where = '';
  if(isset($_GET['category'])){
    $catid = $_GET['category'];
    $where = 'AND catergory_id ='.$catid;
  }

?>
<?php include 'includes/header.php'; ?>
<style type="text/css">
  #divscroll{
  overflow-x: auto;
  white-space: nowrap;
}
</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Photos
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Products</li>
        <li class="active">Product Photos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          <form method="POST" action="product_photos_search.php">
                  <input class="form-control" type="text" placeholder="Search All Products" name="search" aria-label="Search">
                </form>
                <form method="POST" action="product_photos_search.php">
                  <input class="form-control" type="text" placeholder="Search Product By Id" name="searchId" aria-label="Search">
                </form>
            <div class="box-body" id="divscroll">
              <table id="example1" class="table table-bordered" style="overflow-x:auto;">
                <thead>
                  <th>Product ID</th>
                  <th>Name</th>
                  <th>Image 1</th>
                  <th>Image 2</th>
                  <th>Image 3</th>
                  <th>Image 4</th>
                  <th>Image 5</th>
                  <th>Image 6</th>
                  <th>Image 7</th>
                  <th>Image 8</th>
                  <th>Image 9</th>
                  <th>Image 10</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $now = date('Y-m-d');
                      if(isset($_POST['search'])){
                        $stmt = $conn->prepare("SELECT product_photos.product_id,products.product_name,product_photos.pic1,product_photos.pic2,product_photos.pic3,product_photos.pic4,product_photos.pic5,product_photos.pic6,product_photos.pic7,product_photos.pic8,product_photos.pic9,product_photos.pic10 FROM product_photos,products WHERE product_photos.product_id=products.product_id AND product_name LIKE :proName $where ORDER BY products.product_id");
                        $stmt->execute(['proName'=>'%'.$_POST['search'].'%']);
                      }else if(isset($_POST['searchId'])){
                        $stmt = $conn->prepare("SELECT product_photos.product_id,products.product_name,product_photos.pic1,product_photos.pic2,product_photos.pic3,product_photos.pic4,product_photos.pic5,product_photos.pic6,product_photos.pic7,product_photos.pic8,product_photos.pic9,product_photos.pic10 FROM product_photos,products WHERE product_photos.product_id=products.product_id AND products.product_id=:proId $where ORDER BY products.product_id");
                        $stmt->execute(['proId'=>$_POST['searchId']]);
                      }
                      
                      
                      foreach($stmt as $row){
                        $image = (!empty($row['pic1'])) ? '../images/product_images/'.$row['pic1'] : '../images/no-image.jpg';
                        
                        echo "
                          <tr>
                            <td>
                              ".$row['product_id']."
                            </td>
                            <td>".$row['product_name']."</td>
                            <td>   
                                <img src='../images/product_images/".$row['pic1']."' height='100px' width='80px'>
                                <span class='pull-right'><a href='#edit_photo1' class='photo' data-toggle='modal' data-id='".$row['product_id']."'><i class='fa fa-edit'></i></a></span>
                            </td>
                            <td>   
                                <img src='../images/product_images/".$row['pic2']."' height='100px' width='80px'>
                                <span class='pull-right'><a href='#edit_photo2' class='photo' data-toggle='modal' data-id='".$row['product_id']."'><i class='fa fa-edit'></i></a></span>
                            </td>
                            <td>   
                                <img src='../images/product_images/".$row['pic3']."' height='100px' width='80px'>
                                <span class='pull-right'><a href='#edit_photo3' class='photo' data-toggle='modal' data-id='".$row['product_id']."'><i class='fa fa-edit'></i></a></span>
                            </td>
                            <td>   
                                <img src='../images/product_images/".$row['pic4']."' height='100px' width='80px'>
                                <span class='pull-right'><a href='#edit_photo4' class='photo' data-toggle='modal' data-id='".$row['product_id']."'><i class='fa fa-edit'></i></a></span>
                            </td>
                            <td>   
                                <img src='../images/product_images/".$row['pic5']."' height='100px' width='80px'>
                                <span class='pull-right'><a href='#edit_photo5' class='photo' data-toggle='modal' data-id='".$row['product_id']."'><i class='fa fa-edit'></i></a></span>
                            </td>
                            <td>   
                                <img src='../images/product_images/".$row['pic6']."' height='100px' width='80px'>
                                <span class='pull-right'><a href='#edit_photo6' class='photo' data-toggle='modal' data-id='".$row['product_id']."'><i class='fa fa-edit'></i></a></span>
                            </td>
                            <td>   
                                <img src='../images/product_images/".$row['pic7']."' height='100px' width='80px'>
                                <span class='pull-right'><a href='#edit_photo7' class='photo' data-toggle='modal' data-id='".$row['product_id']."'><i class='fa fa-edit'></i></a></span>
                            </td>
                            <td>   
                                <img src='../images/product_images/".$row['pic8']."' height='100px' width='80px'>
                                <span class='pull-right'><a href='#edit_photo8' class='photo' data-toggle='modal' data-id='".$row['product_id']."'><i class='fa fa-edit'></i></a></span>
                            </td>
                            <td>   
                                <img src='../images/product_images/".$row['pic9']."' height='100px' width='80px'>
                                <span class='pull-right'><a href='#edit_photo9' class='photo' data-toggle='modal' data-id='".$row['product_id']."'><i class='fa fa-edit'></i></a></span>
                            </td>
                            <td>   
                                <img src='../images/product_images/".$row['pic10']."' height='100px' width='80px'>
                                <span class='pull-right'><a href='#edit_photo10' class='photo' data-toggle='modal' data-id='".$row['product_id']."'><i class='fa fa-edit'></i></a></span>
                            </td>
                          </tr>
                        ";
                      }
                    }
                    catch(PDOException $e){
                      echo $e->getMessage();
                    }

                    $pdo->close();
                  ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </section>
     
  </div>
  	<?php include 'includes/footer.php'; ?>
    <?php include 'includes/products_search_photo_modal.php'; ?>


8/div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'products_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.prodid').val(response.product_id);
    }
  });
}

</script>
</body>
</html>
