<?php
    include 'includes/session.php';
    $output = "";
    $options = array('All Delivery Pending','Some Products Delivery Pending','All Packed for Delivery','Some Packed for Delivery','All Out for Delivery','Some Out for Delivery','All Delivered','Some Delivered','Cancelled');
    if(isset($_POST['action'])){
        if(isset($_POST['startDate']) && isset($_POST['endDate'])){
                $output .= "
                <div class='box-body sort_date' id='divscroll'>
                <table class='table table-bordered'>
                <thead>
                    <th class='hidden'></th>
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
                ";
                try{
                    
                    $con = $pdo->open();
                    if($_POST['startDate']!=0 && $_POST['endDate']!=0){
                        $stmt = $con->prepare("SELECT * FROM `sales` WHERE date BETWEEN :start_date AND :end_date");
                        $stmt->execute(['start_date'=>$_POST['startDate'],'end_date'=>$_POST['endDate']]);
                    }
                    else if($_POST['startDate']!=0 && $_POST['endDate']==0){
                        $stmt = $con->prepare("SELECT * FROM sales WHERE date=:start_date");
                        $stmt->execute(['start_date'=>$_POST['startDate']]);
                    }else if($_POST['startDate']==0 && $_POST['endDate']!=0){
                        $stmt = $con->prepare("SELECT * FROM sales WHERE date=:end_date");
                        $stmt->execute(['end_date'=>$_POST['endDate']]);
                    }
                    foreach($stmt as $row){
                        $selected = $row['order_status'];
                        $output .="
                          <tr>
                            <td class='hidden'></td>
                            ";
                            if($row['order_status']=='All Delivery Pending'){
                              $output .="<td><center><span class='dot' style='background-color:#FA0000;'></span></center></td>";
                             }else if($row['order_status']=='Some Products Delivery Pending'){
                              $output .="<td><center><span class='dot' style='background-color:#00D8FF;'></span></center></td>";
                             }
                             else if($row['order_status']=='All Packed for Delivery'){
                              $output .="<td><center><span class='dot' style='background-color:#F28729;'></span></center></td>";
                             }
                             else if($row['order_status']=='Some Packed for Delivery'){
                              $output .="<td><center><span class='dot' style='background-color:#000CFF;'></span></center></td>";
                             }
                             else if($row['order_status']=='All Out for Delivery'){
                              $output .="<td><center><span class='dot' style='background-color:yellow;'></span></center></td>";
                             }
                             else if($row['order_status']=='Some Out for Delivery'){
                              $output .="<td><center><span class='dot' style='background-color:#9700FF;'></span></center></td>";
                             }
                             else if($row['order_status']=='All Delivered'){
                              $output .="<td><center><span class='dot' style='background-color:#2ECC71;'></span></center></td>";
                             }
                             else if($row['order_status']=='Some Delivered'){
                              $output .="<td><center><span class='dot' style='background-color:#FF00EC;'></span></center></td>";
                             }
                             else if($row['order_status']=='Cancelled'){
                              $output .="<td><center><span class='dot' style='background-color:#000000;'></span></center></td>";
                             }
                        $output .="
                            <td>".$row['id']."</td>
                            <td>".date('d-m-Y', strtotime($row['date_time']))."</td>
                            <td>".date('h:i:s a', strtotime($row['date_time']))."</td>
                            <td>".$row['user_id']."</td>
                            <td><button type='button' class='btn btn-info btn-sm btn-flat user_transact' data-id='".$row['user_id']."'><i class='fa fa-search'></i> View</button></td></td>
                            <td><a href='product_orders.php?id=".$row['user_id']."&sales=".$row['id']."' target='_blank'>View Products</a></td>
                            <td>".$row['product_count']."</td>
                            <td>
                            <select class='status' id='".$row['id']."'>";
                            foreach($options as $option){
                              if($selected == $option){
                                $output .= "<option selected='selected' value='$option'>$option</option>";
                              }
                              else{
                                $output .= "<option value='$option'>$option</option>" ;
                              }
                          }
                          $output .="
                            </select>
                            </td>
      
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