<?php include'components/session.php'; ?>

<!DOCTYPE html>
<html lang="en">
    <style>
        html, body {
        height: 100%;
        }
    </style>
    <?php include 'components/header.php'; ?>
    <!-- <link rel="stylesheet" href="styles/user_pofile.css"> -->
<body onload="loadingGif()">
    <!-- <div id="loading"></div> -->
    <header>
    <?php include 'components/nav-page.php'; ?>
    </header>

    <div style="margin-top:5px;margin-left: 15px;margin-right: 15px;margin-bottom:5px;height: 100%;">
    <?php
        if(isset($_SESSION['rushabh_novelty_user'])){
    ?>
        <div class="center">
            <h3>Your Orders</h3>
            <div class="divider"></div>
        </div>
        <div style="overflow-x:auto;overflow-y: scroll; height:90%;">
            <?php 
                $con = $pdo->open();
                $fetch_total = $con->prepare("SELECT count(*) as total from user_order where user_id=:user_id");
                $fetch_total->execute(['user_id'=>$_SESSION['rushabh_novelty_user']]);
                $total = $fetch_total->fetch();

                $stmt = $con->prepare("SELECT products.product_id, products.product_name, products.product_description, products.product_price, product_photos.pic1,user_order.id,user_order.product_quantity,user_order.order_status,user_order.order_date,user_order.order_date_time,category.category_name,sales_id,count(*) as total from products, user_order, category, product_photos WHERE products.product_id = user_order.product_id AND products.category_id=category.catergory_id AND products.product_id=product_photos.product_id AND user_order.user_id=:user_id AND user_order.sales_id=:sales GROUP BY user_order.id ORDER BY order_date_time DESC");
                $stmt->execute(['user_id'=>$_SESSION['rushabh_novelty_user'],'sales'=>$_GET['sales']]);

                if($total['total']>0){
            ?>
            
            <table class="highlight centered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Order Date</th>
                        <th>Order Status</th>
                    </tr>
                </thead>
    
                <tbody>
                        <?php
                            foreach($stmt as $rows){
                        ?>
                            <tr>
                            <td>
                                <a href="product_details.php?category=<?php echo $rows['category_name'];?>&&id=<?php echo$rows['product_id'];?>">
                                    <div class="row" style="margin-bottom: 0px;">
                                        <div class="col s12 m4 l3" style="padding-right: 0px;">
                                            <img src="images/product_images/<?php echo $rows['pic1'];?>" height="80px" width="100px" style="border:1px solid black;">
                                        </div>
                                        <div class="col s12 m6 l9" style="padding-left: 0px; padding-right: 0px;">
                                            <?php echo $rows['product_name'];?>
                                        </div>
                                    </div>
                                </a>
                            </td>
                            <td><?php echo $rows['product_quantity'];?></td>
                            <td><?php echo date('d-m-Y', strtotime($rows['order_date']));?></td>
                            <td><?php echo $rows['order_status'];?></td>
                            
                        </tr>
                        <?php
                            }
                        }
                        else{
                        ?>
                        <div class="s12 m12 l12">
                            <div class="container center">
                                <div class="card" style="height:300px;">
                                    <div class="card-content">
                                            <p><h3>You haven't order anything yet</h3></p>
                                            <p>
                                                <a href="index.php" class="btn-large">shop</a>
                                            </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        <?php  
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <?php
    }
    else{
        ?>
        <div class="s12 m12 l12">
            <div class="container center">
                <div class="card" style="height:300px;">
                    <div class="card-content">
                            <p><h3>Login to view your orders</h3></p>
                            <p>
                                <a href="login.php" class="btn-large">Login</a>
                            </p>
                    </div>
                </div>
            </div>
        </div>
    <?php
        }
    ?>

    </div>
    <?php include 'components/footer.php'; ?>
    <?php include 'components/script.php'; ?>
    <?php include 'scripts/nav_script.php'; ?>
    <script>
        var preloader = document.getElementById('loading');

        function loadingGif(){
            preloader.style.display = 'none';
        }

        $(document).ready(function(){

            $(document).on('click','.sub_button',function(){
                var action = "add";
                var sub_email = document.getElementById('subemail').value;
                console.log("cccc");
                $.ajax({
                    url:"subscribe.php",
                    method:"POST",
                    data:{action:action,sub_email:sub_email},
                    success:function(data){
                        document.getElementById('subemail').value="";
                        $("#f_success").html(data);
                    }
                });
                        
            });
        });
    </script>
</body>
</html>


