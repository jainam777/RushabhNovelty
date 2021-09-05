<?php include 'components/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<style>
        html, body {
        height: 100%;
        }
    </style>
<?php include 'components/header.php'; ?>
<link rel="stylesheet" href="styles/product_cart.css">
    <body>
    <header>
        <?php include 'components/nav-page.php'; ?>
    </header>
    <div class="webcontainer" style="height: 80%;">
        <div class="row" style="height: 80%;">
            <div class="col s12 m12 l12" style="height: 80%;">
                <div class="card horizontal" style="height: 100%;margin-top: 30px;" >
                    <div class="card-stacked">
                        <div class="card-content">
                            <div class="container center">
                                <p><h3>Order Placed Successfully</h3></p>
                                <p>Thankyou for shopping from our website</p>
                                <p>You will receive an email about the confirm order</p>
                                <br>
                                <p>
                                <a href="user_orders.php" class="btn-large">View Order</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>
    <?php include 'components/script.php'; ?>
    <?php include 'scripts/nav_script.php'; ?>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    </body>
</html>