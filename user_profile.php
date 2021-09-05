<?php include 'components/session.php';?>
<!DOCTYPE html>
<html lang="en">
    
    <?php include 'components/header.php'; ?>
    <link rel="stylesheet" href="styles/user_pofile.css">
    <?php if(isset($_SESSION['rushabh_novelty_user'])){
    
    ?>
<body onload="loadingGif()">
    <div id="loading"></div>
    <header>
        <?php include 'components/nav-page.php'; ?>
        <nav class="webtabcolor">
            <div class="nav-wrapper webcontainer ">
                <div class="row">
                    <div class="col s10 m10 l0 offset-l1 offset-s1 offset-m1 center">
                       <h3 style="margin-top: 0px; margin-bottom: 0px;padding-top: 20px;" class="webtextcolor"><b>User Profile</b></h3>
                    </div>
                    <div class="col s1 m1 l1 hide-on-med-and-down">
                        <a href="logout.php" class="btn">Logout</a>
                    </div>
                    <div class="col s1 m1 l1 hide-on-large-only">
                        <a href="logout.php" class="flat-btn"><i class="material-icons">login</i></a>
                        
                    </div>
                </div>
            </div>
        </nav>
    </header> 
    <div class="s12 m12 l12 center">
            <?php
                if(isset($_SESSION['rushabh_novelty_f_error'])){
                    echo '
                        <div>
                            <p class="red-text">'.$_SESSION['rushabh_novelty_f_error'].'</p>
                        </div>
                    ';
                    unset($_SESSION['rushabh_novelty_f_error']);
                }
                if(isset($_SESSION['rushabh_novelty_f_success'])){
                    echo '
                        <div >
                            <p class="green-text" style="font-size:1.3em;">'.$_SESSION['rushabh_novelty_f_success'].'</p>
                        </div>
                    ';
                    unset($_SESSION['rushabh_novelty_f_success']);
                }
            ?>
    </div>
    <div class="s12 m12 l12 center">
            <p id="error_message" class="red-text" style="font-size:1.3em;"></p>
    </div>
    <div>
    <div class="container" style="margin-top:10px;padding-left: 180px;padding-right: 180px;">
        <!-- <div class="col s12 m12 l6"> -->
            <div class="center">
                <i class="large grey-text text-darken-2 material-icons logo">account_circle</i>
            </div>
            <?php
                $con = $pdo->open();
                $stmt = $con->prepare("SELECT * from users where user_id=:user_id");
                $stmt->execute(['user_id'=>$_SESSION['rushabh_novelty_user']]);
                $rows = $stmt->fetch(); 
            ?>
            <form action="update_profile.php" method="post" style="margin-top:30px;" onsubmit="return validateMobileForm()">
                <div class="input-field col s12">
                    <i class="material-icons prefix">person</i>
                    <input type="text" name="fname" id="fname" value="<?php echo $rows['name'] ?>" class="validate" required>
                    <label class="active" for="fname">Name*</label>
                </div>
                <br>
                <div class="input-field col s12">
                    <i class="material-icons prefix">local_phone</i>
                    <input type="text" name="user_phone" id="user_phone" value="<?php echo $rows['mobile'] ?>" class="validate" required>
                    <label class="active" for="user_phone">Mobile Number*</label>
                </div>
                <br>
                <div class="input-field col s12">
                    <i class="material-icons prefix">local_phone</i>
                    <input type="text" name="alt_phone" id="alt_phone" value="<?php echo $rows['alt_mobile']; ?>" class="validate">
                    <label class="active" for="alt_phone">Alternate Mobile Number</label>
                </div>
                <br>
                <div class="input-field col s12">
                    <i class="material-icons prefix">email</i>
                    <input id="email" name="email" type="email" value="<?php echo $rows['email'] ?>" class="validate" required>
                    <label class="active" for="email">Email*</label>
                </div>
                <br>
                <div class="center">
                    <a href="change_current_pwd.php" class="btn">Change Password</a>
                </div>
                <br>
                <div class="divider black"></div>
                <p>Address:</p>
                <div class="input-field col s12">
                    <i class="material-icons prefix">house</i>
                    <input type="text" name="house_name" id="house_name" value="<?php echo $rows['house_name'] ?>" class="validate" required>
                    <label class="active" for="house_name">House No./Name*</label>
                </div>
    
                <div class="input-field col s12">
                    <i class="material-icons prefix">place</i>
                    <input type="text" name="street" id="street" value="<?php echo $rows['street'] ?>" class="validate" required>
                    <label class="active" for="street">Street*</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">near_me</i>
                    <input type="text" name="landmark" id="landmark" value="<?php echo $rows['landmark'] ?>" class="validate" required>
                    <label class="active" for="landmark">landmark*</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">emoji_transportation</i>
                    <input type="text" name="city" id="city" value="<?php echo $rows['city'] ?>" class="validate" required>
                    <label class="active" for="city">City*</label>
                </div>
                
                <div class="input-field col s12">
                    <i class="material-icons prefix">location_city</i>
                    <input type="text" name="state" id="state" value="<?php echo $rows['state'] ?>" class="validate" required>
                    <label class="active" for="state">State*</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">gps_fixed</i>
                    <input type="text" name="pincode" id="pincode" value="<?php echo $rows['pincode'] ?>" class="validate" required>
                    <label class="active" for="pincode">Pincode*</label>
                </div>
                
                <div class="divider"></div>
                <br>
                <div class="col s12 center">
                    <button class="btn waves-effect waves-light" onclick="validateForm()" type="submit" name="action">
                    Update Profile</button>
                            <!-- <a href="#" class="btn">Sign Up</a><br> -->
                </div>
                <br>
    
            </form>
            
        </div>
        <div class="divider"></div>
        <div style="margin-top:5px;margin-left: 15px;margin-right: 15px;margin-bottom:5px;">
            <div class="center">
                <h3>Your Orders</h3>
                <div class="divider"></div>
            </div>
            <div style="overflow-x:auto;">
                <?php 
                    $con = $pdo->open();
                    $fetch_total = $con->prepare("SELECT count(*) as total from user_order where user_id=:user_id");
                    $fetch_total->execute(['user_id'=>$_SESSION['rushabh_novelty_user']]);
                    $total = $fetch_total->fetch();

                    $stmt = $con->prepare("SELECT * from sales WHERE user_id=:user_id ORDER BY date_time DESC LIMIT 5");
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
                            <?php
                                }
                                echo '<tr><td colspan="7"><a class="btn" href="user_orders.php">View All Order</a></td></tr>';
                            }
                            else{
                                echo "<div class='center' style='margin-top:10px;margin-bottom:10px;'>You haven't order anything yet</div>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
   </div>
    <script src="scripts/mobile_validator.js"></script>
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
<?php 
    }
    else{
        header("location: index.php");
    }
?>
</html>