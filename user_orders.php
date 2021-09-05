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
    <div id="loading"></div>
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

                $stmt = $con->prepare("SELECT * from sales WHERE user_id=:user_id ORDER BY date_time DESC");
                $stmt->execute(['user_id'=>$_SESSION['rushabh_novelty_user']]);

                if($total['total']>0){
            ?>
            
            <table class="highlight centered">
                <thead>
                    <tr>
                    <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Products</th>
                        <th>Total Products</th>
                        <th>Total Amount</th>
                        <th>Order Status</th>
                    </tr>
                </thead>
    
                <tbody>
                        <?php
                            foreach($stmt as $rows){
                        ?>
                            <tr>
                            <td>
                                <?php echo $rows['id'] ?>
                            </td>
                            <td><?php echo date('d-m-Y', strtotime($rows['date_time']));?></td>
                            
                            <td><u><a class="blue-text" href="ordered_products.php?sales=<?php echo $rows['id'] ?>">View Products</a></u></td>
                            <td><?php echo $rows['product_count'];?></td>
                            <td><?php echo $rows['total_amount'];?></td>
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

    </script>
</body>
</html>


