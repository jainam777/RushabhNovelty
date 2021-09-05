<?php include 'includes/session.php'; ?>
<?php
  $where = '';
  if(isset($_GET['reason'])){
    $catid = $_GET['reason'];
    $where = "WHERE reason ='".$catid."' ";
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
        Customer Messages
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Contact Us</li>
        <li class="active">Customer Messages</li>
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
              <!-- <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat" id="addproduct"><i class="fa fa-plus"></i> New</a> -->
              <div class="pull-right">
                <form class="form-inline">
                  <div class="form-group">
                    <label>Category: </label>
                    <select class="form-control input-sm" id="select_category">
                      <option value="all">ALL</option>
                      <?php
                        $conn = $pdo->open();

                        $stmt = $conn->prepare("SELECT reason FROM customer_messages");
                        $stmt->execute();

                        foreach($stmt as $crow){
                          $selected = ($crow['reason'] == $catid) ? 'selected' : ''; 
                          echo "
                            <option value='".$crow['reason']."' ".$selected.">".$crow['reason']."</option>
                          ";
                        }

                        $pdo->close();
                      ?>
                    </select>
                  </div>
                </form>
              </div>
            </div>
            <div class="box-body" id="divscroll">
              <table id="example1" class="table table-bordered" style="overflow-x:auto;">
                <thead>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Reason</th>
                  <th>Message</th>
                  <th>Date</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $now = date('Y-m-d');
                      $stmt = $conn->prepare("SELECT * from customer_messages $where ORDER BY msg_date DESC");
                      $stmt->execute();
                      foreach($stmt as $row){
                        echo "
                          <tr>
                            <td>
                              ".$row['customer_name']."
                            </td>
                            <td>".$row['customer_email']."</td>
                            <td>".$row['customer_mobile']."</td>
                            <td>".$row['reason']."</td>
                            <td>".$row['cust_message']."</td>
                            <td>".$row['msg_date']."</td>

                           
                              <td><button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Delete</button><td>
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
    <?php include 'includes/customer_msg_modal.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.desc', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    //getRow(id);
  });

  $('#select_category').change(function(){
    var val = $(this).val();
    if(val == 'all'){
      window.location = 'customer_msg.php';
    }
    else{
      window.location = 'customer_msg.php?reason='+val;
    }
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'message_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#desc').html(response.cust_message);
    //  $('.name').html('Message');
      $('.prodid').val(response.id);
    }
  });
}

</script>
</body>
</html>
