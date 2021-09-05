<?php include 'components/session.php'; ?> 
<?php
    $output = '';
    if(isset($_POST['category_id'])){
        $categoryId = $_POST['category_id'];
        $con = $pdo->open();
        try{
            $stmtCategory = $con->prepare("SELECT count(*) as total,category_name,category_img from category WHERE catergory_id=:cat_id");
            $stmtCategory->execute(['cat_id'=>$categoryId]);
            $catCount = $stmtCategory->fetch();
            $category=$catCount['category_name'];
            $navCategoryAdd = str_replace(' ','',$category);
            if($catCount['total']==1){
                $output.='
                <div class="webcontainer" id="'.$navCategoryAdd.'">
                    <div class="row">
                        <div class="col s12 m12 l12 center">
                            <h3>'.$category.'</h3>
                            <div class="divider"></div>
                            <br>
                            <img class="responsive-img" style="width:100%;" src="images/category_images/'.$catCount['category_img'].'" alt="">
                        </div>
        
                <div class="col s12 m12 l12">
                <br>
                <div class="divider"></div>';
                //$con = $pdo->open();
                //try{
                    $stmt = $con->prepare("SELECT subcategory.subcategory_id,subcategory.subcategory_name,category.category_name FROM subcategory INNER JOIN category ON subcategory.category_id=category.catergory_id where category.category_name=:category_name");
                    $stmt->execute(['category_name'=>$category]);
                    $_SESSION['pro_category']=$category;
                // }
                // catch(PDOException $e){
                //     $output.= "There is some problem in connection:" .$e.getMessage();
                // }
                $output.='
                    <div id="selectbox" class="input-field col s12">
                        <select onchange="location = this.value;" style="display:inline-block !important;font-size: 100% !important;font-family:sans-serif !important;background-color: rgba(255, 255, 255, 0.9) !important;
                        width: 100% !important;
                        padding: 5px !important;
                        border: 4px solid black !important;
                        border-radius: 2px !important;
                        height: 4.5rem !important;">';
                        $output.=' <option value="#" selected disabled>Select Product Category</option>';
                                while($rows = $stmt->fetch()){
                                    $subcat = $rows['subcategory_name'];
                                    $output.='<option value="all_products.php?category='.$_SESSION['pro_category'].'&subcategory='.$subcat.'">'.$subcat.'</option>';
                                } 
               $output.='</select>
                        <!--label>Filter:</label-->
                    </div>';
            $output.='
                    <!-- <div class="divider"></div> -->
                </div>
                <br>';
            try{
                $stmtSub = $con->prepare("SELECT subcategory.subcategory_id,subcategory.subcategory_name,category.category_name FROM subcategory INNER JOIN category ON subcategory.category_id=category.catergory_id where category.category_name=:category_name");
                $stmtSub->execute(['category_name'=>$category]);
                foreach($stmtSub as $rows){
                    
                $output.='
                    <div class="col s12 m12 l12">
                        <div class="section">
                            <div class="row">
                                <div class="col s12 m12 l12 center">
                                    <h3><span>'.$rows['subcategory_name'].'</span></h3>
                                    <div class="divider"></div>
                                </div>
                            </div>
                            <div class="row wrapper">';

                            $stmt = $con->prepare("SELECT products.product_id, products.product_name, products.product_description, products.product_price, category.category_name, subcategory.subcategory_name, product_photos.pic1, products.stock from products, category, subcategory, product_photos WHERE products.category_id = category.catergory_id and products.subcategoty_id = subcategory.subcategory_id and products.product_id = product_photos.product_id and category.category_name =:category_name and subcategory.subcategory_name =:subcategory LIMIT 4");
                            $stmt->execute(['subcategory'=>$rows['subcategory_name'],'category_name'=>$category]);
                                foreach($stmt as $row){ 
                                    $output.='
                                    
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
                                                    $output.='
                                                    <button class="add_to_cart orange-text waves-effect waves-orange btn-flat add'.$row['product_id'].' " style="margin-right: 0px;padding-left: 5px;padding-right: 5px;" type="submit" id="'.$row['product_id'].'">
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span id="add_cart">Add to cart</span>
                                                    </button>
                                                    <button class="buy_now orange-text waves-effect waves-orange btn-flat" style="margin-right: 0px;padding-left: 8px;padding-right: 8px;margin-left: 3px;" type="submit" id="'.$row['product_id'].'">Buy Now</button>';
                                                // }else{
                                                //     echo '<p class="center red-text" style="margin-top: 7px;margin-bottom: 7px;">OUT OF STOCK</p>';
                                                // }
                                                $output.='
                                                </div>
                                            </div>
                                        </div>
                                    ';
                                }
                            $output.='
                            </div>
                            <div class="row">
                                <div class="s12 m12 l12">
                                <a href="all_products.php?category='.$_SESSION['pro_category'].'&subcategory='.$rows['subcategory_name'].'" class="btn max-btn">MORE</a>
                                </div>
                            </div>
                        </div>
                    </div>';   
                }
            }
            catch(PDOException $e){
                $output.= 'There is some problem with the connection'. $e;
            }
            $pdo->close();
        $output.='

                </div>

            </div>';

        }
        else{
             include 'home.php'; 
        }
        }catch(PDOException $e){

        }

    }
    else{
        include 'home.php'; 
    }
    echo $output;
?>