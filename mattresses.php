<div class="webcontainer" id="<?php echo $navCategory[7]; ?>">
    <div class="row">
        <div class="col s12 m12 l12 center">
            <h3><?php echo $navCategoryLive[7]; ?> Furnitures</h3>
            <div class="divider"></div>
            <br>
            <img class="responsive-img" style="width:100%;" src="images/product_images/custom-furniture-design.jpg" alt="">
        </div>
        
        <div class="col s12 m12 l12">
        <br>
        <div class="divider"></div>
        <?php
            $con = $pdo->open();
            try{
                $stmt = $con->prepare("SELECT subcategory.subcategory_id,subcategory.subcategory_name,category.category_name FROM subcategory INNER JOIN category ON subcategory.category_id=category.catergory_id where category.category_name=:category_name");
                $stmt->execute(['category_name'=>$navCategoryLive[7]]);
                $_SESSION['pro_category']=$navCategoryLive[7];
            }
            catch(PDOException $e){
                echo "There is some problem in connection:" .$e.getMessage();
            }
        ?>
            <div id="selectbox" class="input-field">
                <select onchange="location = this.value;">
                    <option value="#" selected disabled>Select your option</option>
                    <?php
                        while($rows = $stmt->fetch()){
                            $subcat = $rows['subcategory_name'];
                            echo'<option value="all_products.php?category='.$_SESSION['pro_category'].'&subcategory='.$subcat.'">'.$subcat.'</option>';
                        } 
                        
                    ?>
                </select>
                <label>Filter:</label>
            </div>
            <!-- <div class="divider"></div> -->
        </div>
        <br>
        <?php
            try{
                $stmtSub = $con->prepare("SELECT subcategory.subcategory_id,subcategory.subcategory_name,category.category_name FROM subcategory INNER JOIN category ON subcategory.category_id=category.catergory_id where category.category_name=:category_name");
                $stmtSub->execute(['category_name'=>$navCategoryLive[7]]);
                foreach($stmtSub as $rows){ ?>
                    
                    <div class="col s12 m12 l12" id="sofa">
                        <div class="section">
                            <div class="row">
                                <div class="col s12 m12 l12 center">
                                    <h3><span><?php echo ''.$rows['subcategory_name'].''; ?></span></h3>
                                    <div class="divider"></div>
                                </div>
                            </div>
                            <div class="row wrapper">
                            <?php
                            $stmt = $con->prepare("SELECT products.product_id, products.stock, products.product_name, products.product_description, products.product_price, products.rating, category.category_name, subcategory.subcategory_name, product_photos.pic1 from products, category, subcategory, product_photos WHERE products.category_id = category.catergory_id and products.subcategoty_id = subcategory.subcategory_id and products.product_id = product_photos.product_id and category.category_name =:category_name and subcategory.subcategory_name =:subcategory LIMIT 4");
                            $stmt->execute(['subcategory'=>$rows['subcategory_name'],'category_name'=>$navCategoryLive[7]]);
                                foreach($stmt as $row){ 
                                    echo'
                                    
                                        <div class="col s12 m4 l3 item">
                                            <div class="card">
                                                <a href="product_details.php?category='.$row['category_name'].'&&id='.$row['product_id'].'">
                                                    <div class="card-image">
                                                        <img src="images/product_images/'.$row['pic1'].'" height="180.05">
                                                        <span class="card-title truncate">'.$row['product_name'].'</span>
                                                    </div>
                                                    <div class="card-content black-text">
                                                        <p class="truncate">'.$row['product_description'].'</p>
                                                        <br>
                                                        <div class="divider"></div>
                                                        <span>Price: <i class="fa fa-inr" aria-hidden="true"></i>'.$row['product_price'].'/-</span>
                                                        <br>
                                                        <span>Ratings:'?>
                                                        <?php
                                                        if($row['rating']==0){
                                                            echo 'No ratings';
                                                        }else{
                                                        for($i=0;$i<$row['rating'];$i++){ 
                                                            echo '<i class="fa fa-star yellow-text" aria-hidden="true"></i> ';}
                                                        }
                                                            ?> 
                                                        <?php echo '
                                                        </span>
                                                        <div class="divider"></div>
                                                    </div>
                                                </a>
                                                <div class="card-action">';
                                                if($row['stock']>0){
                                                    echo'
                                                    <a class="add_to_cart waves-effect waves-orange btn-flat add'.$row['product_id'].' " style="margin-right: 0px;padding-left: 0px;padding-right: 0px;" type="submit" id="'.$row['product_id'].'">
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span id="add_cart">Add to cart</span>
                                                    </a>
                                                    <a class="buy_now waves-effect waves-orange btn-flat" style="margin-right: 0px;" type="submit" id="'.$row['product_id'].'">Buy Now</a>';
                                                }else{
                                                    echo '<p class="center red-text" style="margin-top: 7px;margin-bottom: 7px;">OUT OF STOCK</p>';
                                                }
                                                echo'
                                                
                                                </div>
                                            </div>
                                        </div>
                                    ';
                                }
                            ?>
                            </div>
                            <div class="row">
                                <div class="s12 m12 l12">
                                <?php echo '<a href="all_products.php?category='.$_SESSION['pro_category'].'&subcategory='.$rows['subcategory_name'].'" class="btn max-btn">MORE</a>'; ?>
                                </div>
                            </div>
                        </div>
                    </div>  
                 <?php    
                }
            }
            catch(PDOException $e){
                echo 'There is some problem with the connection'. $e;
            }
            $pdo->close();
        ?>

    </div>

</div>