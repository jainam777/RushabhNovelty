<?php
    include 'components/session.php';

    
    $output = '';
    $con=$pdo->open();
    if(isset($_POST['sort_by']) && isset($_POST['category']) && isset($_POST['subcategory'])){
        if(strcmp($_POST['sort_by'],"high")==0){
                    
                    try{
                        $stmt = $con->prepare("SELECT products.product_id, products.product_name, products.product_description, products.product_price, products.rating, category.category_name, subcategory.subcategory_name, product_photos.pic1 from products, category, subcategory, product_photos WHERE products.category_id = category.catergory_id and products.subcategoty_id = subcategory.subcategory_id and products.product_id = product_photos.product_id and category.category_name =:category and subcategory.subcategory_name =:subcategory ORDER BY products.product_price DESC");
                        $stmt->execute(['category' => $_POST['category'],'subcategory' => $_POST['subcategory']]);
                        foreach($stmt as $rows){
                            $output .= '
                                <div class="col s12 m6 l4">
                                    <div class="card">
                                        <a href="product_details.php?category='.$_POST['category'].'&&id='.$rows['product_id'].'">
                                            <div class="card-image">
                                                <img src="images/product_images/'.$rows['pic1'].'" height="180.05">
                                                <span class="card-title truncate">'.$rows['product_name'].'</span>
                                            </div>
                                            <div class="card-content black-text">
                                                <p class="truncate">'.$rows['product_description'].'</p>
                                                <br>
                                                <div class="divider"></div>
                                                <span>Price: <i class="fa fa-inr" aria-hidden="true"></i>'.$rows['product_price'].'/-</span>
                                                <br>
                                                <span>Ratings: '?>
                                                <?php
                                                if($rows['rating']==0){
                                                    echo 'No ratings';
                                                }else{
                                                for($i=0;$i<$rows['rating'];$i++){ 
                                                    $output.= '<i class="fa fa-star yellow-text" aria-hidden="true"></i> ';}
                                                }
                                                    ?> 
                                                <?php $output .= '
                                                </span>
                                                <div class="divider"></div>
                                            </div>
                                        </a>
                                        <div class="card-action">
                                            <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart</a>
                                            <a href="#">Buy Now</a>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                    }
                    catch(PDOException $e){
                        echo "There is some problem in the connection" .$e->getMessage();
                    }
                    echo $output;
        }
        if($_POST['sort_by']=="low"){
            try{
                $stmt = $con->prepare("SELECT products.product_id, products.product_name, products.product_description, products.product_price, products.rating, category.category_name, subcategory.subcategory_name, product_photos.pic1 from products, category, subcategory, product_photos WHERE products.category_id = category.catergory_id and products.subcategoty_id = subcategory.subcategory_id and products.product_id = product_photos.product_id and category.category_name =:category and subcategory.subcategory_name =:subcategory ORDER BY products.product_price ASC");
                $stmt->execute(['category' => $_POST['category'],'subcategory' => $_POST['subcategory']]);
                foreach($stmt as $rows){
                    $output .= '
                        <div class="col s12 m6 l4">
                            <div class="card">
                                <a href="product_details.php?category='.$_POST['category'].'&&id='.$rows['product_id'].'">
                                    <div class="card-image">
                                        <img src="images/product_images/sofa.jpg">
                                        <span class="card-title truncate">'.$rows['product_name'].'</span>
                                    </div>
                                    <div class="card-content black-text">
                                        <p class="truncate">'.$rows['product_description'].'</p>
                                        <br>
                                        <div class="divider"></div>
                                        <span>Price: <i class="fa fa-inr" aria-hidden="true"></i>'.$rows['product_price'].'/-</span>
                                        <br>
                                        <span>Ratings: '?>
                                        <?php
                                        if($rows['rating']==0){
                                            echo 'No ratings';
                                        }else{
                                        for($i=0;$i<$rows['rating'];$i++){ 
                                            $output.= '<i class="fa fa-star yellow-text" aria-hidden="true"></i> ';}
                                        }
                                            ?> 
                                        <?php $output .= '
                                        </span>
                                        <div class="divider"></div>
                                    </div>
                                </a>
                                <div class="card-action">
                                    <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart</a>
                                    <a href="#">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    ';
                }
            }
            catch(PDOException $e){
                echo "There is some problem in the connection" .$e->getMessage();
            }
            echo $output;
        }
        if($_POST['sort_by']=="rating"){
            try{
                $stmt = $con->prepare("SELECT products.product_id, products.product_name, products.product_description, products.product_price, products.rating, category.category_name, subcategory.subcategory_name, product_photos.pic1 from products, category, subcategory, product_photos WHERE products.category_id = category.catergory_id and products.subcategoty_id = subcategory.subcategory_id and products.product_id = product_photos.product_id and category.category_name =:category and subcategory.subcategory_name =:subcategory ORDER BY products.rating DESC");
                $stmt->execute(['category' => $_POST['category'],'subcategory' => $_POST['subcategory']]);
                foreach($stmt as $rows){
                    $output .= '
                        <div class="col s12 m6 l4">
                            <div class="card">
                                <a href="product_details.php?category='.$_POST['category'].'&&id='.$rows['product_id'].'">
                                    <div class="card-image">
                                        <img src="images/product_images/sofa.jpg">
                                        <span class="card-title truncate">'.$rows['product_name'].'</span>
                                    </div>
                                    <div class="card-content black-text">
                                        <p class="truncate">'.$rows['product_description'].'</p>
                                        <br>
                                        <div class="divider"></div>
                                        <span>Price: <i class="fa fa-inr" aria-hidden="true"></i>'.$rows['product_price'].'/-</span>
                                        <br>
                                        <span>Ratings: '?>
                                        <?php
                                        if($rows['rating']==0){
                                            echo 'No ratings';
                                        }else{
                                        for($i=0;$i<$rows['rating'];$i++){ 
                                            $output.= '<i class="fa fa-star yellow-text" aria-hidden="true"></i> ';}
                                        }
                                            ?> 
                                        <?php $output .= '
                                        </span>
                                        <div class="divider"></div>
                                    </div>
                                </a>
                                <div class="card-action">
                                    <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart</a>
                                    <a href="#">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    ';
                }
            }
            catch(PDOException $e){
                echo "There is some problem in the connection" .$e->getMessage();
            }
            echo $output;
        }
        if($_POST['sort_by']=="new"){
            try{
                $stmt = $con->prepare("SELECT products.product_id, products.stock, products.product_name, products.product_description, products.product_price, products.rating, category.category_name, subcategory.subcategory_name, product_photos.pic1 from products, category, subcategory, product_photos WHERE products.category_id = category.catergory_id and products.subcategoty_id = subcategory.subcategory_id and products.product_id = product_photos.product_id and category.category_name =:category and subcategory.subcategory_name =:subcategory ORDER BY products.pro_date ASC");
                $stmt->execute(['category' => $_POST['category'],'subcategory' => $_POST['subcategory']]);
                foreach($stmt as $rows){
                    $output .= '
                        <div class="col s12 m6 l4">
                            <div class="card">
                                <a href="product_details.php?category='.$_POST['category'].'&&id='.$rows['product_id'].'">
                                    <div class="card-image">
                                        <img src="images/product_images/'.$rows['pic1'].'">
                                        <span class="card-title truncate">'.$rows['product_name'].'</span>
                                    </div>
                                    <div class="card-content black-text">
                                        <p class="truncate">'.$rows['product_description'].'</p>
                                        <br>
                                        <div class="divider"></div>
                                        <span>Price: <i class="fa fa-inr" aria-hidden="true"></i>'.$rows['product_price'].'/-</span>
                                        <br>
                                        <span>Ratings: '?>
                                        <?php
                                        if($rows['rating']==0){
                                            echo 'No ratings';
                                        }else{
                                        for($i=0;$i<$rows['rating'];$i++){ 
                                            $output.= '<i class="fa fa-star yellow-text" aria-hidden="true"></i> ';}
                                        }
                                            ?> 
                                        <?php $output .= '
                                        </span>
                                        <div class="divider"></div>
                                    </div>
                                </a>
                                <div class="card-action">
                                    <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart</a>
                                    <a href="#">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    ';
                }
            }
            catch(PDOException $e){
                echo "There is some problem in the connection" .$e->getMessage();
            }
            echo $output;
        }
    }
    else{
        try{
            $stmt = $con->prepare("SELECT products.product_id, products.product_name, products.product_description, products.product_price, products.rating, category.category_name, subcategory.subcategory_name, product_photos.pic1 from products, category, subcategory, product_photos WHERE products.category_id = category.catergory_id and products.subcategoty_id = subcategory.subcategory_id and products.product_id = product_photos.product_id and category.category_name =:category and subcategory.subcategory_name =:subcategory");
            $stmt->execute(['category' => $_POST['category'],'subcategory' => $_POST['subcategory']]);
            foreach($stmt as $rows){
                $output .= '
                    <div class="col s12 m6 l4">
                        <div class="card">
                            <a href="product_details.php?category='.$_POST['category'].'&&id='.$rows['product_id'].'">
                                <div class="card-image">
                                    <img src="images/product_images/sofa.jpg">
                                    <span class="card-title truncate">'.$rows['product_name'].'</span>
                                </div>
                                <div class="card-content black-text">
                                    <p class="truncate">'.$rows['product_description'].'</p>
                                    <br>
                                    <div class="divider"></div>
                                    <span>Price: <i class="fa fa-inr" aria-hidden="true"></i>'.$rows['product_price'].'/-</span>
                                    <br>
                                    <span>Ratings: '?>
                                    <?php
                                    if($rows['rating']==0){
                                        echo 'No ratings';
                                    }else{
                                    for($i=0;$i<$rows['rating'];$i++){ 
                                        $output.= '<i class="fa fa-star yellow-text" aria-hidden="true"></i> ';}
                                    }
                                        ?> 
                                    <?php $output .= '
                                    </span>
                                    <div class="divider"></div>
                                </div>
                            </a>
                            <div class="card-action">
                                <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart</a>
                                <a href="#">Buy Now</a>
                            </div>
                        </div>
                    </div>
                ';
            }
        }
        catch(PDOException $e){
            echo "There is some problem in the connection" .$e->getMessage();
        }
    }
?>