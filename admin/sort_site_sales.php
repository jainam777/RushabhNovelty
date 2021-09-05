<?php
    include 'includes/session.php';
    $output = "";
    if(isset($_POST['action'])){
        if(isset($_POST['startDate']) && isset($_POST['endDate'])){
                $output .= "
                <div class='box-body sort_date' id='divscroll'>
                <table class='table table-bordered'>
                <thead>
                  <th class='hidden'></th>
                  <th>Order ID</th>
                  <th>User ID</th>
                  <th>User Details</th>
                  <th>Total Products</th>
                  <th>Total Amount</th>
                  <th>Date</th>
                  <th>Time</th>
                </thead>
                <tbody>
                ";
                try{
                    
                    $con = $pdo->open();
                    if($_POST['startDate']!=0 and $_POST['endDate']!=0){
                        $stmt = $con->prepare("SELECT * FROM `sales` WHERE order_status!='Cancelled' AND date BETWEEN :start_date AND :end_date");
                        $stmt->execute(['start_date'=>$_POST['startDate'],'end_date'=>$_POST['endDate']]);
                    }
                    else if($_POST['startDate']!=0 and $_POST['endDate']==0){
                        $stmt = $con->prepare("SELECT * FROM sales WHERE order_status!='Cancelled' AND date=:start_date");
                        $stmt->execute(['start_date'=>$_POST['startDate']]);
                    }else if($_POST['startDate']==0 and $_POST['endDate']!=0){
                        $stmt = $con->prepare("SELECT * FROM sales WHERE order_status!='Cancelled' AND date=:end_date");
                        $stmt->execute(['end_date'=>$_POST['endDate']]);
                    }
                    foreach($stmt as $row){
                        $output .= "
                          <tr>
                            <td class='hidden'></td>
                            <td>".$row['id']."</td>
                            <td>".$row['user_id']."</td>
                            <td><button type='button' class='btn btn-info btn-sm btn-flat user_transact' data-id='".$row['user_id']."'><i class='fa fa-search'></i> View</button></td></td>
                            ";
                            $stmt_total = $con->prepare("SELECT count(*) as total_products from user_order WHERE order_status!='Cancelled' AND sales_id=:sales_id");
                            $stmt_total->execute(['sales_id'=>$row['id']]);
                            $total_products = $stmt_total->fetch();
                        $output.="
                            <td>".$total_products['total_products']."</td>
                            <td>Rs. ".$row['total_amount']."</td>
                            <td>".date('d-m-Y', strtotime($row['date_time']))."</td>
                            <td>".date('h:i:s a', strtotime($row['date_time']))."</td>
                          </tr>
                        ";
                    }
                }catch(PDOException $e){
                    echo $e->getMessage();
                }
                $output .= "
                </tbody>
                </table>
                </div>
                ";
        }
        echo $output;
    }
?>