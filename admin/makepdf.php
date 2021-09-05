<?php
include 'includes/session.php';
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$printf ="
<html>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
    <body>
        <p><h3>Rushabh Novelty</h3></p>
        ";
        $con = $pdo->open();
        $stmtUser = $con->prepare("SELECT * FROM users WHERE user_id=:user_id");
        $stmtUser->execute(['user_id'=>$_POST['id']]);
        $user = $stmtUser->fetch();
        
        $printf.="
        <p>
            <h4>User Details</h4>
            <strong>Name:</strong> ".$user['name']."<br>
            <strong>Email:</strong> ".$user['email']."<br>
            <strong>Mobile No:</strong> ".$user['mobile']."<br>
           
          
        </p><br>
        <h4>Order Details</h4>        
        <table>
            <tr>
                <td>Product ID</td>
                <td>Photo</td>
                <td>Quantity</td>
                <td>Name</td>
                <td>Price</td>
            </tr>";
            try{
                $sumTotal = 0;
                $stmt = $conn->prepare("SELECT * from user_order WHERE user_id=:user_id AND sales_id=:sales ORDER BY order_date DESC");
                $stmt->execute(['user_id'=>$_POST['id'],'sales'=>$_POST['sales']]);
                foreach($stmt as $row){
                    
                   
                  $printf .= "
                    <tr>
                      <td>".$row['product_id']."</td>
                      ";
                      $stmtPhoto = $conn->prepare("SELECT pic1 FROM product_photos WHERE product_id=:pid");
                      $stmtPhoto->execute(['pid'=>$row['product_id']]);
                      $photo = $stmtPhoto->fetch();
                      $image = $photo['pic1'];
                      $printf .="
                      <td>
                          <img src='../images/product_images/".$image."' height='80px' width='120px'>
                      </td>
                      <td>".$row['product_quantity']."</td>
                      ";
                      
                      $stmtProduct = $conn->prepare("SELECT * FROM products WHERE product_id=:product_id");
                      $stmtProduct->execute(['product_id'=>$row['product_id']]);
                      $product = $stmtProduct->fetch();

                      $sumTotal = $sumTotal+($row['product_quantity']*$product['product_price']);
          
                      $printf .="
                      <td><a href='../product_details_admin.php?id=".$row['product_id']."' target='_blank'>
                      ".$product['product_name']."</a>
                      </td>
                      <td>".$product['product_price']."</td>
                    </tr>
                  ";
                }
              }
              catch(PDOException $e){
                echo $e->getMessage();
              }
          
              $pdo->close();
    $printf.="
            <tr>
                <td colspan='4' text-align: right;>Total</td>
                <td>".$sumTotal."<td>
            </tr>
        </table>
    ";
  
  

    $printf .="
</body>
</html>
";

$mpdf->WriteHTML($printf);
$mpdf->Output('orders.pdf','D');




?>