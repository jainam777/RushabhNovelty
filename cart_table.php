<?php
echo'

    <div class="col s12 m12 l8">
        <div class="card horizontal">
            <div class="card-stacked">
                <div class="card-content">
                    <div class="row">';
            
                        $disableButton = false;
                        $options = array('1','2','3');
                        $con = $pdo->open();
                        $fetch_total = $con->prepare("SELECT count(*) as total from user_cart where user_id=:user_id");
                        $fetch_total->execute(['user_id'=>$_SESSION['rushabh_novelty_user']]);
                        $total = $fetch_total->fetch();

                        $stmt = $con->prepare("SELECT products.product_id, products.product_name, products.product_description, products.product_price, product_photos.pic1,user_cart.id,user_cart.product_quantity,products.colour,category.category_name,count(*) as total from products, product_photos, user_cart, category WHERE products.product_id = product_photos.product_id AND products.product_id = user_cart.product_id AND products.category_id=category.catergory_id  AND user_cart.user_id=:user_id GROUP BY user_cart.id ORDER BY cart_date DESC");
                        $stmt->execute(['user_id'=>$_SESSION['rushabh_novelty_user']]);
                        $sum =0;
                        if($total['total']>0){
                            foreach($stmt as $rows){
                                $product_price = $rows['product_quantity']*$rows['product_price'];
                                $sum = $sum + $product_price;
                                $selected = $rows['product_quantity'];

                        // $stmtStock = $con->prepare("SELECT stock FROM products WHERE product_id=:product_id");
                        // $stmtStock->execute(['product_id'=>$rows['product_id']]);
                        // $stock=$stmtStock->fetch();

                        // if($rows['product_quantity']>$stock['stock']){
                        //     $disableButton = false;
                        // }
                                echo'
                                <div class="col s12 m12 l12">
                                ';
                        // if($rows['product_quantity']>$stock['stock']){
                        //     if($stock['stock']<=0){
                        //         echo'<p class="center red-text">OUT OF STOCK</p>';
                        //     }else{
                        //         if($stock['stock']==1){
                        //             echo'<p class="center red-text">Only '.$stock['stock'].' product is available in stock</p>';
                        //         }else{
                        //             echo'<p class="center red-text">Only '.$stock['stock'].' products are available in stock</p>';
                        //         }
                        //     }
                        // }
                                        echo'
                                        <div class="col s12 m12 l5">
                                            <div class="row">
                                                <div class="col s12 m12 l12 center">
                                                    <a href="product_details.php?category='.$rows['category_name'].'&&id='.$rows['product_id'].'">
                                                        <img src="images/product_images/'.$rows['pic1'].'" style="border:1px solid black" alt="" height="240" width="190">
                                                    </a>
                                                </div>
                                                <div class="col s12 m12 l12" style="padding:10px;">
                                        ';
                        // if($rows['product_quantity']<=$stock['stock'] || $stock['stock']>0){
                        // echo'
                        //             <p>Quantity: '.$selected.'</p>';
                                    // <select class="browser-default" id='.$rows['product_id'].'>';
                                    // foreach($options as $option){
                                    //     if($selected == $option){
                                    //         echo "<option selected='selected' value='$option'>$option</option>";
                                    //     }
                                    //     else{
                                    //         echo "<option value='$option'>$option</option>" ;
                                    //     }
                                    // }

                                    // echo'
                                    // </select>';
                            
                        // }
                        // else{
                        //     echo '
                        //     <p>Quantity: '.$selected.'</p>
                        //     ';
                        // }
                        echo'
                                </div>
                            </div>
                        </div>
                        <div class="col s10 m11 l6">
                            <div>
                            <a href="product_details.php?category='.$rows['category_name'].'&&id='.$rows['product_id'].'">
                                <h4>'.$rows['product_name'].'</h4>
                                '.$rows['product_description'].'
                                </a>
                                <br><br>
                                Quantity: 
                                
                                    <div class="row">
                                        <div class="input-field col s6 m6 l6" style="margin-top: 5px;margin-bottom: 0px;">
                                            <input type="text" id="qty_id'.$rows['product_id'].'" name="quantity" value="'.$selected.'"/>
                                            <input type="hidden" name="user_id" value="'.$_SESSION['rushabh_novelty_user'].'"/>
                                            <input type="hidden" name="product_id" value="'.$rows['product_id'].'"/>
                                            <input type="hidden" name="action" value="'.$rows['product_id'].'"/>
                                        </div>
                                        <div class="input-field col s6 m6 l4">
                                            <button class="btn qty_btn" id="'.$rows['product_id'].'" type="submit">Update</button>
                                        </div>
                                    </div>
                            
                                
                                Price: ₹'.$product_price.'
                            </div>
                        </div>
                        <div class="col s1 m1 l1 valign-wrapper">
                            <a class="delete_product waves-effect waves-red btn-flat" id='.$rows['product_id'].' type="submit" style="margin-top:50px;"><i class="material-icons red-text">delete</i></a>
                        </div>
                    </div>
                    <div class="col s12 m12 l12 divider" style="margin-bottom:10px;margin-top:10px;"></div>
                        ';
                    }
                }else{
                    echo '
                    <div class="col s12 m12 l12">
                        <div class="container center">
                            <p><h3>Cart is empty</h3></p>
                        </div>
                    </div>
                    ';
                }
echo'
            </div>
        </div>
    </div>
</div>
</div>
<div class="col s12 m12 l4">
<div class="card horizontal">
    <div class="card-stacked">
        <div class="card-content">
            <h4><b>Price Details</b></h4>
            <div class="divider"></div>
            <div class="row">';
           
                $stmt1 = $con->prepare("SELECT count(*) as cart from user_cart where user_id=:id");
                $stmt1->execute(['id'=>$_SESSION['rushabh_novelty_user']]);
                $rows = $stmt1->fetch();
                $count=$rows['cart'];
                
                echo '

                <div class="col s6 m6 l6">
                    <p class="price-section">Price('.$count.' item)</p>
                </div>
                <div class="col s6 m6 l6">
                    <p class="price-section">₹ '.$sum.'</p>
                    
                </div>
                <div class="col s6 m6 l6">
                    <p class="price-section">Delivery Fees</p>
                </div>
                <div class="col s6 m6 l6">
                    <p class="price-section">₹ 0</p>
                </div>
                <div class="col s12 m12 l12 divider" style="margin-top:10px"></div>
                <div class="col s6 m6 l6">
                    <h4>Total</h4>
                </div>
                <div class="col s6 m6 l6">
                    <h4>₹ '.$sum.'</h4>
                </div>
                <div class="col s12 m12 l12 divider"></div>
            </div>
        </div>';
            if($sum>0){ //&& $disableButton){
        echo'
        <div class="card-action right">
            <a href="contact_and_shipping.php" class="btn">Buy Now</a>
        </div>';
        
        
            }else{
                // if(!$disableButton){
                //     echo '<p class="center red-text">Cart contains a product which is out of stock</p>';
                // }
               
        echo'
        <div class="card-action right">
            <button class="btn disabled">Buy Now</button>
        </div>';
        
        
            }
    echo'
        </div>
    </div>
    
</div>
</div>

';
?>