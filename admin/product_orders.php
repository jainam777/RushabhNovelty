<?php include 'includes/session.php';
$options = array('Delivery Pending','Packed for Delivery','Out for Delivery','Delivered','Cancelled'); 
    $user_id = $_GET['id'];
    $order_date = $_GET['sales'];
?>

<?php include 'includes/header.php'; ?>
<style type="text/css">
    #divscroll{
  overflow-x: auto;
  white-space: nowrap;
}
.dot {
  height: 20px;
  width: 20px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
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
        Orders
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Orders</li>
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

      <form action="makepdf.php" method="POST">
        <input type="hidden" name="id" value=<?php echo $_GET['id']; ?>>
        <input type="hidden" name="sales" value=<?php echo $_GET['sales']; ?>>
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <div class="pull-right">
                  <!-- <a href="makepdf.php?id='<?php echo $_GET['id']; ?>'&sales='<?php echo $_GET['sales']; ?>'"><button class='btn btn-success btn-sm btn-flat' type="submit" name="print">Print</button></a> -->
                  <button class='btn btn-success btn-sm btn-flat' type="submit" name="print">Print</button>
                </div>
              </div>
              <div class="box-body" id="divscroll">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <th class="hidden"></th>
                    <th>Status</th>
                    <th>Product ID</th>
                    <th>Photo</th>
                    <th>Quantity</th>
                    <th>Name</th>
                    <!-- <th>Colour</th> -->
                    <th>Price</th>
                    <th>Delivery Status</th>
                  </thead>
                  <tbody>
                    <?php
                    
                      $conn = $pdo->open();
  
                      try{
                        $stmt = $conn->prepare("SELECT * from user_order WHERE user_id=:user_id AND sales_id=:sales ORDER BY order_date DESC");
                        $stmt->execute(['user_id'=>$_GET['id'],'sales'=>$_GET['sales']]);
                        foreach($stmt as $row){
                          $selected = $row['order_status'];
                          echo "
                            <tr>
                              <td class='hidden'></td>";
                              if($row['order_status']=='Delivery Pending'){
                                echo"<td><center><span class='dot' style='background-color:#FA0000;'></span></center></td>";
                               }
                               else if($row['order_status']=='Packed for Delivery'){
                                 echo"<td><center><span class='dot' style='background-color:#F28729;'></span></center></td>";
                               }
                               else if($row['order_status']=='Out for Delivery'){
                                 echo"<td><center><span class='dot' style='background-color:yellow;'></span></center></td>";
                               }
                               else if($row['order_status']=='Delivered'){
                                 echo"<td><center><span class='dot' style='background-color:#2ECC71;'></span></center></td>";
                               }
                               else if($row['order_status']=='Cancelled'){
                                 echo"<td><center><span class='dot' style='background-color:#000000;'></span></center></td>";
                               }
                              echo"
                              <td>".$row['product_id']."</td>
                              ";
                              $stmtPhoto = $conn->prepare("SELECT pic1 FROM product_photos WHERE product_id=:pid");
                              $stmtPhoto->execute(['pid'=>$row['product_id']]);
                              $photo = $stmtPhoto->fetch();
                              $image = $photo['pic1'];
                              echo"
                              <td>
                                  <img src='../images/product_images/".$image."' height='80px' width='120px'>
                              </td>
                              <td>".$row['product_quantity']."</td>
                              ";
                              
                              $stmtProduct = $conn->prepare("SELECT * FROM products WHERE product_id=:product_id");
                              $stmtProduct->execute(['product_id'=>$row['product_id']]);
                              $product = $stmtProduct->fetch();
  
                              echo"
                              <td><a href='../product_details_admin.php?id=".$row['product_id']."' target='_blank'>
                              ".$product['product_name']."</a>
                              </td>
                              <td>".$product['product_price']."</td>
                              <td>
                            <select class='status' id='".$row['id']."'>";
                            foreach($options as $option){
                              if($selected == $option){
                                  echo "<option selected='selected' value='$option'>$option</option>";
                              }
                              else{
                                  echo "<option value='$option'>$option</option>" ;
                              }
                          }
                            echo"
                            </select>
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
      </form>
    </section>
     
  </div>
  	<?php include 'includes/footer.php'; ?>
    <?php include 'includes/sales_modal.php'; ?>
    <?php include 'includes/sales_product_modal.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<!-- Date Picker -->
<script>
$(function(){


  //Date picker
  $('#datepicker_add').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })
  $('#datepicker_edit').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })

  //Timepicker
  $('.timepicker').timepicker({
    showInputs: false
  })

  //Date range picker
  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
  //Date range as a button
  $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
  )
  
});
</script>
<script>

$(document).on('change','.status',function(){
    var order = "orderstatus";
    var status = $(this).val();
    var id = $(this).attr("id");
    $.ajax({
        url: "update_order_status.php", 
        method:"POST",
        data:{order:order,status:status,id:id},
        success:function(data){
            document.location.href = "product_orders.php?id=<?php echo $_GET['id'];?>&sales=<?php echo $_GET['sales'];?>";
        }
    });

});

$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#ptransaction').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.user_transact', function(e){
    e.preventDefault();
    $('#transaction').modal('show');
    var id = $(this).data('id');
    getUserRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'products_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#edit_description').val(response.product_description);
      $('.name').html(response.product_name);
      $('.prodid').val(response.product_id);
      $('#edit_name').val(response.product_name);
      $('#catselected').val(response.category_name);
      $('#edit_price').val("Rs. "+response.product_price);
      $('#edit_colour').val(response.colour);
      $('#edit_p_size').val(response.size);
      $('#editor2').val(response.product_description);
      //CKEDITOR.instances["editor2"].setData(response.product_description);
      getCategory();
    }
  });
}
function getCategory(){
  $.ajax({
    type: 'POST',
    url: 'category_fetch.php',
    dataType: 'json',
    success:function(response){
      $('#category').append(response);
      $('#edit_category').append(response);
    }
  });
}

function getUserRow(id){
  $.ajax({
    type: 'POST',
    url: 'users_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userid').val(response.user_id);
      $('#edit_email').val(response.email);
      $('#edit_lastname').val(response.name);
      $('#edit_house_name').val(response.house_name+', '+response.street+', '+response.landmark+', '+response.city+', '+response.state+', '+response.pincode);
      $('#edit_street').val(response.street);
      $('#edit_landmark').val(response.landmark);
      $('#edit_city').val(response.city);
      $('#edit_state').val(response.state);
      $('#edit_pincode').val(response.pincode);
      $('#edit_contact').val(response.mobile);
      $('.fullname').html(response.name);
    }
  });
}
</script>
</body>
</html>
