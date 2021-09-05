<div class="webcontainer" id="home">

        <div class="carousel carousel-slider caraousel-height">
            <a class="carousel-item" href="#one!"><img src="images/carousel_1.png" class="responsive-image"></a>
            <a class="carousel-item" href="#two!"><img src="images/carousel_2.png" class="responsive-image"></a>
            <a class="carousel-item" href="#three!"><img src="images/carousel_3.png" class="responsive-image"></a>
        </div>

        <!-- New Arrival -->
        <div class="section">
            <div class="row">
                <div class="col s12 m12 l12 center">
                    <h3><span>New Arrival</span></h3>
                    <div class="divider"></div>
                </div>
            </div>
            <div class="row wrapper">
            <?php
                $con=$pdo->open();
                $stmt = $con->prepare("SELECT products.product_id, products.product_name, products.stock, products.product_description, products.product_price, category.category_name, subcategory.subcategory_name, product_photos.pic1 from products, category, subcategory, product_photos WHERE products.category_id = category.catergory_id and products.subcategoty_id = subcategory.subcategory_id and products.product_id = product_photos.product_id ORDER BY pro_date DESC LIMIT 4");
                $stmt->execute();
                    foreach($stmt as $row){ 
                        echo'
                        
                            <div class="col s12 m4 l3 item">
                                <div class="card">
                                    <a href="product_details.php?category='.$row['category_name'].'&&id='.$row['product_id'].'">
                                        <div class="card-image">
                                            <img class="hide-on-med-and-down" src="images/product_images/'.$row['pic1'].'" style="border: 1px solid black" width="280px" height="400px">
                                            <img class="hide-on-large-only" src="images/product_images/'.$row['pic1'].'" style="border: 1px solid black" width="180px" height="300px">
                                        </div>
                                        <div class="card-content black-text">
                                            <span class="card-title truncate">'.$row['product_name'].'</span>
                                            <p class="truncate">'.$row['product_description'].'</p>
                                        </div>
                                    </a>
                                    <div class="card-action">';
                                    // if($row['stock']>0){
                                        echo'
                                        <button class="add_to_cart waves-effect orange-text waves-orange btn-flat add'.$row['product_id'].' " style="margin-right: 0px;padding-left: 5px;padding-right: 5px;" type="submit" id="'.$row['product_id'].'">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span id="add_cart">Add to cart</span>
                                        </button>
                                        <button class="buy_now waves-effect orange-text waves-orange btn-flat" style="margin-right: 0px;padding-left: 8px;padding-right: 8px;margin-left: 3px;" type="submit" id="'.$row['product_id'].'">Buy Now</button>';
                                    // }else{
                                    //     echo '<p class="center red-text" style="margin-top: 7px;margin-bottom: 7px;">OUT OF STOCK</p>';
                                    // }
                                    echo'
                                   
                                    </div>
                                </div>
                            </div>

                        ';
                    }
                    $pdo->close();
                ?>
            </div>
        </div>


    <?php include 'contact_us.php'; ?>
    </div> 