<!DOCTYPE html>
<nav class="nav-wrapper webcolor nav-padding nav-height">
    <div>
        <a href="index.php" class="brand-logo hide-on-med-and-down"><img src="images/logo.jpeg" height="65"><span class="webcolor-text">RUSHABH NOVELTY</span></a>
        
        <a href="index.php" class="brand-logo hide-on-large-only"><img src="images/logo.jpeg" height="50"></a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger">
            <i class="material-icons webtextcolor">menu</i>
        </a>
        <ul class="right hide-on-med-and-down">
            <li>
                <a href="index.php" class="webtextcolor"><b>Home</b></a>
            </li>
            <li>
                <a href="contact_us_form.php" class="webtextcolor"><b>Contact Us</b></a>
            </li>
            <li>
                <a href="about_us.php" class="webtextcolor"><b>About Us</b></a>
            </li>
        </ul>
        <ul class="hide-on-large-only right">
            <li>
                <a href="index.php"><i class="material-icons webtextcolor">home</i></a>
            </li>
        </ul>
    </div>
</nav>

<ul class="sidenav" id="mobile-demo">
    <li class="webcolor">
        <p class="white-text center" style="margin-top:0px;margin-bottom:5px; padding-left:5px;">
            <a href="index.php"><img src="images/logo_mobile.jpg" height="70"></a>
        </p>
    </li>
    <li>
        <?php
            if(isset($_SESSION['rushabh_novelty_user'])){
                $con = $pdo->open();
                $stmt = $con->prepare("SELECT name from users where user_id=:id");
                $stmt->execute(['id'=>$_SESSION['rushabh_novelty_user']]);
                $row = $stmt->fetch();
                echo'<a href="user_profile.php"><span>'.$row['name'].'</span><i class="material-icons grey-text text-darken-2 right" style="margin-left:0px;margin-right:0px;">account_circle</i></a>';
            }else{
                ?>
                <a href="login.php"><i class="material-icons grey-text text-darken-2 right" style="margin-left:0px;margin-right:0px;">account_circle</i><span>Login</span></a>
                <?php
            }
        ?>
    </li>
    <li>
        <a href="user_orders.php">My Orders</a>
    </li>
    <li>
        <a href="product_cart.php">My Cart</a>
    </li>
    <li>
        <div class="divider" style="color:#263238;"></div>
    </li>
    <li>
        <a href="about_us.php">About Us</a>
    </li>
    <li>
        <a href="contact_us_form.php">Contact Us</a>
    </li>
    <li>
        <div class="divider" style="color:#263238;"></div>
    </li>
    <?php if(isset($_SESSION['rushabh_novelty_user'])){ ?>
    <li>
        <a href='logout.php'>Logout<i class="material-icons grey-text text-darken-2 right" style="margin-left:0px;margin-right:0px;">login</i></a>
    </li>
    <li>
        <div class="divider" style="color:#263238;"></div>
    </li>
    <?php 
        }
    ?>
</ul>
