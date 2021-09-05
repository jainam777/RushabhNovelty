<?php include 'includes/session.php'; ?>
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
        Sales
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales</li>
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
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date">
              </div>
            </div>
            <!-- id="example1" -->
            <div class="box-body sort_date" id="divscroll">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Order ID</th>
                  <th>User ID</th>
                  <th>User Details</th>
                  <th>Total Products</th>
                  <th>Total Amount</th>
                  <th>Date</th>
                  <th>Time</th>
                </thead>
                <tbody>
                  <?php
                  
                    $conn = $pdo->open();

                    try{
                      $stmt = $conn->prepare("SELECT * from sales WHERE order_status!='Cancelled' ORDER BY date_time DESC");
                      $stmt->execute();
                      foreach($stmt as $row){
                       
                        echo "
                          <tr>
                            <td class='hidden'></td>
                            <td>".$row['id']."</td>
                            <td>".$row['user_id']."</td>
                            <td><button type='button' class='btn btn-info btn-sm btn-flat user_transact' data-id='".$row['user_id']."'><i class='fa fa-search'></i> View</button></td></td>
                            ";
                            $stmt_total = $conn->prepare("SELECT count(*) as total_products from user_order WHERE order_status!='Cancelled' AND sales_id=:sales_id");
                            $stmt_total->execute(['sales_id'=>$row['id']]);
                            $total_products = $stmt_total->fetch();
                          echo"
                            <td>".$total_products['total_products']."</td>
                            <td>Rs. ".$row['total_amount']."</td>
                            <td>".date('d-m-Y', strtotime($row['date_time']))."</td>
                            <td>".date('h:i:s a', strtotime($row['date_time']))."</td>
                            
      
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

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>

<script>


$(function(){
  $(document).on('click', '.user_transact', function(e){
    e.preventDefault();
    $('#transaction').modal('show');
    var id = $(this).data('id');
    getUserRow(id);
  });

  var startDate = 0;
  var endDate = 0;

  $(document).on('change','#start_date', function(e){
    var action="startDate";
    startDate = document.getElementById('start_date').value;
    console.log(startDate);
    console.log(endDate);
    $.ajax({
      url:"sort_site_sales.php",
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
      url:"sort_site_sales.php",
      method:"POST",
      data:{action:action,startDate:startDate,endDate:endDate},
      success:function(data){
        $('.sort_date').html(data);
      }
    });
  });

});


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
