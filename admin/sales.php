<?php include 'includes/session.php'; ?>
<?php
$options = array('All Delivery Pending','Some Products Delivery Pending','All Packed for Delivery','Some Packed for Delivery','All Out for Delivery','Some Out for Delivery','All Delivered','Some Delivered','Cancelled');
  $where = '';
  if(isset($_GET['status'])){
    $catid = $_GET['status'];
    $where = "WHERE order_status ='".$catid."'";
  }

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
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="pull-right">
                <form method="POST" class="form-inline" action="sales_print.php">
                  <div class="form-group">
                      <label>Delivery Status: </label>
                      <select class="form-control input-sm" id="select_category">
                        <option value="0">ALL</option>
                        <?php
                          foreach($options as $option){
                            $selected = ($option == $catid) ? 'selected' : ''; 
                            echo "
                              <option value='".$option."' ".$selected.">".$option."</option>
                            ";
                          }

                          $pdo->close();
                        ?>
                      </select>
                    </div>
                  <!-- <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range">
                  </div> -->
                  <!-- <button type="submit" class="btn btn-success btn-sm btn-flat" name="print"><span class="glyphicon glyphicon-print"></span>Print</button> -->
                </form>
              </div>
              <div class="pull-left">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date">
              </div>
            </div>
            <div class="box-body sort_date" id="divscroll">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Status</th>
                  <th>Order ID</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Buyer ID</th>
                  <th>Buyer Details</th>
                  <th>Products</th>
                  <th>Total Products</th>
                  <th>Delivery Status</th>
                </thead>
                <tbody>
                  <?php
                  
                  
                    $conn = $pdo->open();

                    try{
                      $stmt = $conn->prepare("SELECT * from sales $where ORDER BY date_time DESC");
                      $stmt->execute();
                      foreach($stmt as $row){
                        $selected = $row['order_status'];
                        echo "
                          <tr>
                            <td class='hidden'></td>
                            ";
                              if($row['order_status']=='All Delivery Pending'){
                               echo"<td><center><span class='dot' style='background-color:#FA0000;'></span></center></td>";
                              }else if($row['order_status']=='Some Products Delivery Pending'){
                                echo"<td><center><span class='dot' style='background-color:#00D8FF;'></span></center></td>";
                              }
                              else if($row['order_status']=='All Packed for Delivery'){
                                echo"<td><center><span class='dot' style='background-color:#F28729;'></span></center></td>";
                              }
                              else if($row['order_status']=='Some Packed for Delivery'){
                                echo"<td><center><span class='dot' style='background-color:#000CFF;'></span></center></td>";
                              }
                              else if($row['order_status']=='All Out for Delivery'){
                                echo"<td><center><span class='dot' style='background-color:yellow;'></span></center></td>";
                              }
                              else if($row['order_status']=='Some Out for Delivery'){
                                echo"<td><center><span class='dot' style='background-color:#9700FF;'></span></center></td>";
                              }
                              else if($row['order_status']=='All Delivered'){
                                echo"<td><center><span class='dot' style='background-color:#2ECC71;'></span></center></td>";
                              }
                              else if($row['order_status']=='Some Delivered'){
                                echo"<td><center><span class='dot' style='background-color:#FF00EC;'></span></center></td>";
                              }
                              else if($row['order_status']=='Cancelled'){
                                echo"<td><center><span class='dot' style='background-color:#000000;'></span></center></td>";
                              }
                          echo"
                            <td>".$row['id']."</td>
                            <td>".date('d-m-Y', strtotime($row['date_time']))."</td>
                            <td>".date('h:i:s a', strtotime($row['date_time']))."</td>
                            <td>".$row['user_id']."</td>
                            <td><button type='button' class='btn btn-info btn-sm btn-flat user_transact' data-id='".$row['user_id']."'><i class='fa fa-search'></i> View</button></td></td>
                            <td><a href='product_orders.php?id=".$row['user_id']."&sales=".$row['id']."' target='_blank'>View Products</a></td>
                            ";
                            $stmt_total = $conn->prepare("SELECT count(*) as total_products from user_order WHERE order_status!='Cancelled' AND sales_id=:sales_id");
                            $stmt_total->execute(['sales_id'=>$row['id']]);
                            $total_products = $stmt_total->fetch();
                          echo"  
                            <td>".$total_products['total_products']."</td>
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

  $('#select_category').change(function(){
    var val = $(this).val();
    if(val == 0){
      window.location = 'sales.php';
    }
    else{
      window.location = 'sales.php?status='+val;
    }
  });

  var startDate = 0;
  var endDate = 0;

  $(document).on('change','#start_date', function(e){
    var action="startDate";
    startDate = document.getElementById('start_date').value;
    console.log(startDate);
    console.log(endDate);
    $.ajax({
      url:"sort_sales.php",
      method:"POST",
      data:{action:action,startDate:startDate,endDate:endDate},
      success:function(data){
        $('.sort_date').html(data);
      }
    });
  });

  $(document).on('change','#end_date', function(e){
   // var startDate = $(this).data('id');
    var action="endDate";
    endDate = document.getElementById('end_date').value;
    console.log(startDate);
    console.log(endDate);
    $.ajax({
      url:"sort_sales.php",
      method:"POST",
      data:{action:action,startDate:startDate,endDate:endDate},
      success:function(data){
        $('.sort_date').html(data);
      }
    });
  });

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
    var action = "orderstatus";
    var status = $(this).val();
    var id = $(this).attr("id");
    $.ajax({
        url: "update_order_status.php", 
        method:"POST",
        data:{action:action,status:status,id:id},
        success:function(data){
            document.location.href = "sales.php";
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
