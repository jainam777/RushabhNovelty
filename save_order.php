<?php 
    include 'components/session.php';

    try{

        $proCount = 0;
        $sum_total = 0;

        $con = $pdo->open();

        $stmtSales = $con->prepare("INSERT INTO sales(user_id,date) VALUES (:user_id,NOW())");
        $stmtSales->execute(['user_id'=>$_SESSION['rushabh_novelty_user']]);

        $stmtSalesID = $con->prepare("SELECT id FROM sales WHERE user_id=:user_id ORDER BY date_time DESC LIMIT 1");
        $stmtSalesID->execute(['user_id'=>$_SESSION['rushabh_novelty_user']]);
        $salesID = $stmtSalesID->fetch();

        $stmt = $con->prepare("INSERT into user_order(user_id,product_id,product_quantity,order_date_time,order_date,sales_id) SELECT user_id,product_id,product_quantity,NOW(),NOW(),:sales_id FROM user_cart where user_id=:user_id");
        $stmt->execute(['user_id'=>$_SESSION['rushabh_novelty_user'],'sales_id'=>$salesID['id']]);

        $message = "<img src='https://rushabhnovelty.com/images/fevicon.png'>";
        $message .= "<p>Thank you for shopping with Rushabh Novelty.</p>";
        $message .= "<p>We would like to inform you that your order number is ".$salesID['id']."</p>";
        $message .= "<p>The Order Items are as follow:-</p>";
        $orderTable = "<p>Your Order</p>";
        $stmtOrderMail = $con->prepare("SELECT products.product_id, products.product_name, products.product_description, products.product_price, product_photos.pic1, products.stock,user_cart.id,user_cart.product_quantity,category.category_name,count(*) as total from products, product_photos, user_cart, category WHERE products.product_id = product_photos.product_id AND products.product_id = user_cart.product_id AND products.category_id=category.catergory_id  AND user_cart.user_id=:user_id GROUP BY user_cart.id ORDER BY cart_date DESC");
        $stmtOrderMail->execute(['user_id'=>$_SESSION['rushabh_novelty_user']]);
        $orderTable .='<table style="border: 1px solid black;width:100%">
                    <tr>
                        <td style="border: 1px solid black">Product Name</td>
                        <td style="border: 1px solid black">Quantity</td>
                        <td style="border: 1px solid black">Price</td>
                    </tr>
        ';
        foreach($stmtOrderMail as $row){
            $sum_total = $sum_total + ($row['product_quantity']*$row['product_price']);
            $proCount = $proCount + $row['product_quantity'];
            $newStock = $row['stock']-$row['product_quantity'];
            $stmtStock = $con->prepare("UPDATE products SET stock=:new_stock WHERE product_id=:product_id");
            $stmtStock->execute(['new_stock'=>$newStock,'product_id'=>$row['product_id']]);
            $stmtProSales = $con->prepare("UPDATE products SET sells=:sells WHERE product_id=:product_id");
            $stmtProSales->execute(['sells'=>$row['product_quantity'],'product_id'=>$row['product_id']]);
            $orderTable .= '<tr>
                        <td style="border: 1px solid black">'.$row['product_name'].'</td>
                        <td style="border: 1px solid black">'.$row['product_quantity'].'</td>
                        <td style="border: 1px solid black"> Rs.'.$row['product_quantity']*$row['product_price'].'</td>
            </tr>';
        }
        $orderTable .= '
            <tr>
                <td style="border: 1px solid black" colspan="2">Total</td>
                <td style="border: 1px solid black">Rs.'.$sum_total.'</td>
            </tr>
        ';
        $orderTable .= '</table>';
        $message .= $orderTable;
        $message .= '<p>You can anytime check your order status in the Order List under User Profile. Also all the further communication will be carried out by email order@rushabhnovelty.com.</p>';
        $message .= '<p>To Cancel an Order just drop us an Email at order@rushabhnovelty.com mentioning the order number with the items to be cancelled.</p>';
        $message .= '<p>In case of any queries feel free to reach us at order@rushabhnovelty.com</p>';
        $message .= '<p>Regards,</p>';
        $message .= '<p>Rushabh Novelty.</p>';

        $stmtProCount = $con->prepare("UPDATE sales SET product_count=:product_count,total_amount=:total WHERE id=:id");
        $stmtProCount->execute(['product_count'=>$proCount,'id'=>$salesID['id'],'total'=>$sum_total]);

        $stmtDelete = $con->prepare("DELETE FROM user_cart where user_id=:user_id");
        $stmtDelete->execute(['user_id'=>$_SESSION['rushabh_novelty_user']]);

        $stmtEmail = $con->prepare("SELECT name,email,mobile,house_name,street,landmark,city,state,pincode from users WHERE user_id=:user_id");
        $stmtEmail->execute(['user_id'=>$_SESSION['rushabh_novelty_user']]);
        $u_mail = $stmtEmail->fetch();

        $to = $u_mail['email'];
        $userName = $u_mail['name'];
        $userMobile = $u_mail['mobile'];
        $userAddress = ''.$u_mail['house_name']+',<br>'+$u_mail['street']+',<br>'+$u_mail['landmark']+',<br>'+$u_mail['city']+',<br>'+$u_mail['state']+',<br>'+$u_mail['pincode'];
        $subject = "Order Placed Successfully";
        $from_name = "Rushabh Novelty";
        $from_email = "order@".$_SERVER['SERVER_NAME'];
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Reply-To: ".$from_email."\r\n";
        $headers .= "Return-Path: ".$from_email."\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\r\n";
        $headers .= "From: =?UTF-8?B?". base64_encode($from_name) ."?= <$from_email>\r\n";
        $headers .= "X-Mailer: PHP/". phpversion();


        // $headers = "From: Rushabh Novelty <order@rushabhnovelty.com>\r\n";
        // $headers .= "Content-type: text/html\r\n";
        mail($to,$subject,$message,$headers,"-forder@{$_SERVER['SERVER_NAME']}");

        $subjectAdmin = "New Order Arrived";
        $messageAdmin = "New Order Placed by ".$userName;
        $messageAdmin .= "<p>Email: ".$to." <br> Mobile: ".$userMobile." <br> Address: <br>";
        $messageAdmin .= $u_mail['house_name'].',<br>'.$u_mail['street'].',<br>'.$u_mail['landmark'].',<br>'.$u_mail['city'].',<br>'.$u_mail['state'].',<br>'.$u_mail['pincode']."</p>";
        $messageAdmin .= "\n";
        $messageAdmin .= $orderTable;
        mail('order@rushabhnovelty.com',$subjectAdmin,$messageAdmin,$headers);

       // $_SESSION['success'] = 'Details Updated Successfull';
        header("location:order_placed.php");
    }
    catch(PDOException $e){
        echo 'Something went wrong'.$e;
    }
?>