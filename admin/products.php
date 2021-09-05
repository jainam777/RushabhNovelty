<?php include 'includes/session.php'; ?>
<?php
  $limit = 25;
 // $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  if($page<1){
    $page = 1;
  }
	$start = ($page - 1) * $limit;
  $result1 = $conn->query("SELECT count(*) AS id FROM products");
  $proCount = $result1->fetch();
  $total = $proCount['id'];
  $pages = ceil( $total / $limit );

  $Previous = $page - 1;
  $Next = $page + 1;
  $where = '';
  
  if(isset($_GET['category'])){
    $catid = $_GET['category'];
    $where = 'AND catergory_id ='.$catid;
    $limit = 50;
  }

  if(isset($_GET['subcategory'])){
    $catid = $_GET['subcategory'];
    $where = 'AND subcategory_id ='.$catid;
    $limit = 50;
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
        Product List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Products</li>
        <li class="active">Product List</li>
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
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat" id="addproduct"><i class="fa fa-plus"></i> New</a>
              <div>
                <form class="form-inline">
                  <div class="form-group">
                    <label>Category: </label>
                    <select class="form-control input-sm" onchange="location = this.value;">
                      <option value="products.php">ALL</option>
                      <?php
                        $conn = $pdo->open();

                        $stmt = $conn->prepare("SELECT * FROM category");
                        $stmt->execute();

                        foreach($stmt as $crow){
                         // $selected = ($crow['catergory_id'] == $catid) ? 'selected' : ''; 
                          echo "
                            <option value='products_category.php?category=".$crow['catergory_id']."' >".$crow['category_name']."</option>
                          ";
                        }

                        $pdo->close();
                      ?>
                    </select>
                  </div>
                </form>
                <br>
                <!-- Search form -->
                <form method="POST" action="product_search.php">
                  <input class="form-control" type="text" placeholder="Search Product By Name" name="search" aria-label="Search">
                </form>
                <form method="POST" action="product_search.php">
                  <input class="form-control" type="text" placeholder="Search Product By ID" name="searchId" aria-label="Search">
                </form>
                        
              </div>
            </div>
            <div class="box-body" id="divscroll">
              <table class="table table-bordered" style="overflow-x:auto;">
                <thead>
                  <th>ID</th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Description</th>
                  <!-- <th>Colour</th> -->
                  <th>Subcategory</th>
                  <th>Category</th>
                  <th>GST No.</th>
                  <th>HSN Code</th>
                  <th>Stock</th>
                  <th>Price</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $now = date('Y-m-d');
                      $stmt = $conn->prepare("SELECT products.*,category_name,subcategory_name,product_photos.pic1 FROM products,category,subcategory,product_photos WHERE products.category_id=category.catergory_id AND products.subcategoty_id=subcategory_id AND product_photos.product_id=products.product_id $where ORDER BY products.product_id LIMIT $start, $limit");
                      $stmt->execute();
                      
                      foreach($stmt as $row){
                        $image = (!empty($row['pic1'])) ? '../images/product_images/'.$row['pic1'] : '../images/no-image.jpg';
                        $counter = ($row['pro_date'] == $now) ? $row['counter'] : 0;
                        echo "
                          <tr>
                          <td>".$row['product_id']."</td>
                            <td>
                            <img src='".$image."' height='30px' width='30px'>
                              <span class='pull-right'><a href='#edit_photo' class='photo' data-toggle='modal' data-id='".$row['product_id']."'><i class='fa fa-edit'></i></a></span>
                            </td>
                            <td>
                              ".$row['product_name']."
                            </td>
                            <td><a href='#description' data-toggle='modal' class='btn btn-info btn-sm btn-flat desc' data-id='".$row['product_id']."'><i class='fa fa-search'></i> View</a></td>
                            <td>".$row['subcategory_name']."</td>
                            <td>".$row['category_name']."</td>
                            <td>".$row['gst_no']."</td>
                            <td>".$row['hsn_code']."</td>
                            <td>".$row['stock']."</td>
                            <td>".number_format($row['product_price'], 2)."</td>
                            <td>
                              <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['product_id']."'><i class='fa fa-edit'></i> Edit</button>
                              <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['product_id']."'><i class='fa fa-trash'></i> Delete</button>
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

            <div class="col-md-12">
				<nav aria-label="Page navigation">
					<ul class="pagination">
				    <li>
				      <a href="products.php?page=<?= $Previous; ?>" aria-label="Previous">
				        <span aria-hidden="true">&laquo; Previous</span>
				      </a>
				    </li>
            <li><a href="products.php?page=<?=$page; ?>"><?= $page; ?></a></li>
            <li><a href="products.php?page=<?=$page+1; ?>"><?= $page+1; ?></a></li>
            <li><a href="products.php?page=<?=$page+2; ?>"><?= $page+2; ?></a></li>
            <li><a href="products.php?page=<?=$page+3; ?>"><?= $page+3; ?></a></li>
            <li><a href="products.php?page=<?=$page+4; ?>"><?= $page+4; ?></a></li>
				    <li>
				      <a href="products.php?page=<?= $Next; ?>" aria-label="Next">
				        <span aria-hidden="true">Next &raquo;</span>
				      </a>
				    </li>
				  </ul>
				</nav>
			</div>
          </div>
        </div>
      </div>
    </section>
     
  </div>
  	<?php include 'includes/footer.php'; ?>
    <?php include 'includes/products_modal.php'; ?>
    <?php include 'includes/products_modal2.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
    // getCategory();
    // getSubCategory();
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.desc', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $('#select_category').change(function(){
    var val = $(this).val();
    if(val == 0){
      window.location = 'products.php';
    }
    else{
      window.location = 'products.php?category='+val;
    }
  });

  $('#select_subcategory').change(function(){
    var val = $(this).val();
    if(val == 0){
      window.location = 'products.php';
    }
    else{
      window.location = 'products.php?subcategory='+val;
    }
  });

  $('#addproduct').click(function(e){
    e.preventDefault();
    getCategory();
    getSubCategory();
  });

  $("#addnew").on("hidden.bs.modal", function () {
      $('.append_items').remove();
  });

  $("#edit").on("hidden.bs.modal", function () {
      $('.append_items').remove();
  });

  $('#category').change(function(){
    var val = $(this).val();
    
  });

  $(document).on('change','#category',function(){
      var category = $(this).val();
      var action = "subcategory_change";
      $.ajax({
      method:"POST",
      url:"subcategory_fetch.php",
      data:{action:action,category:category},
      dataType: 'json',
      success:function(response){
        //$('#subcategory').html('');
        $('#subcategory').html(response);
      //  $('#edit_subcategory').append(response);
      }
      });
  });

  $(document).on('change','#edit_category',function(){
      var category = $(this).val();
      var action = "subcategory_change";
      $.ajax({
      method:"POST",
      url:"subcategory_fetch.php",
      data:{action:action,category:category},
      dataType: 'json',
      success:function(response){
        //$('#subcategory').html(response);
        $('#edit_subcategory').html('');
        $('#edit_subcategory').append(response);
      }
      });
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'products_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#desc').html(response.product_description);
      $('.name').html(response.product_name);
      $('.prodid').val(response.product_id);
      $('#edit_name').val(response.product_name);
      $('#catselected').val(response.category_id).html(response.category_name);
      $('#subcatselected').val(response.subcategoty_id).html(response.subcategory_name);
      $('#edit_price').val(response.product_price);
      $('#edit_stock').val(response.stock);
      $('#edit_colour').val(response.colour);
      $('#edit_gst').val(response.gst_no);
      $('#edit_hsn').val(response.hsn_code);
      $('#editor2').val(response.product_description);
      // CKEDITOR.instances["editor2"].setData(response.product_description);
      getCategory();
      getSubCategory(response.category_id);
    }
  });
}
function getCategory(){
  $.ajax({
    type: 'POST',
    url: 'category_fetch.php',
    dataType: 'json',
    success:function(response){
      $('#category').html(response);
      $('#edit_category').append(response);
    }
  });
}

function getSubCategory(edit_category){
  var category = edit_category;
  var action = "subcategory_change";
  $.ajax({
    type: 'POST',
    url: 'subcategory_fetch.php',
    data:{action:action,category:category},
    dataType: 'json',
    success:function(response){
      $('#edit_subcategory').append(response);
    }
  });
}
</script>
</body>
</html>
