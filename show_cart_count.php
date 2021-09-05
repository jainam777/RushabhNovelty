<?php
    include'components/session.php';

    if(isset($_POST['user_id'])){
        $con = $pdo->open();
        $stmt = $con->prepare("SELECT count(*) as cart from user_cart where user_id=:id");
        $stmt->execute(['id'=>$_SESSION['rushabh_novelty_user']]);
        $rows = $stmt->fetch();
        $count = $rows['cart'];
        echo $count;
    }


?>