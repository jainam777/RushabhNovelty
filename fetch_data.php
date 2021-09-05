<?php


    include 'components/session.php';
    
    $output = '';
    $con=$pdo->open();

    if(isset($_POST["action"])){
        if($_POST['action']=='search'){
            $query="SELECT products.product_id, products.stock, products.product_name, products.product_description, products.product_price, category.category_name, subcategory.subcategory_name, product_photos.pic1 from products, category, subcategory, product_photos WHERE products.category_id = category.catergory_id and products.subcategoty_id = subcategory.subcategory_id and products.product_id = product_photos.product_id and products.product_name LIKE :pro_name";
        }
        else{
            $query="SELECT products.product_id, products.stock, products.product_name, products.product_description, products.product_price, category.category_name, subcategory.subcategory_name, product_photos.pic1 from products, category, subcategory, product_photos WHERE products.category_id = category.catergory_id and products.subcategoty_id = subcategory.subcategory_id and products.product_id = product_photos.product_id and category.category_name =:category and subcategory.subcategory_name =:subcategory";
        }
        if(isset($_POST["pro_type"])){
            $pro_type_filter = implode("','",$_POST["pro_type"]);
            $query .=" and products.product_type IN('".$pro_type_filter."')";
        }

        if(isset($_POST["pro_material"])){
            $pro_material_filter = implode("','",$_POST["pro_material"]);
            $query .=" and material IN('".$pro_material_filter."')";
        }

        if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
        {
            $query .= " AND products.product_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'";
        }

        if(isset($_POST['sort_by'])){
            if($_POST['sort_by']=="low"){
                $query .=" ORDER BY products.product_price ASC LIMIT ".$_POST['start'].",".$_POST['end']."";
            }
            if($_POST['sort_by']=="high"){
                $query .=" ORDER BY products.product_price DESC LIMIT ".$_POST['start'].",".$_POST['end']."";
            }
            if($_POST['sort_by']=="rating"){
                $query .=" ORDER BY products.rating DESC";
            }
            if($_POST['sort_by']=="new"){
                $query .=" ORDER BY products.pro_date DESC";
            }
        }else{
            $query .=" ORDER BY products.pro_date DESC LIMIT ".$_POST['start'].",".$_POST['end']."";
        }

        if($_POST['sort_by']!="low" && $_POST['sort_by']!="high" && $_POST['action']!='search'){
            $query .=" ORDER BY products.pro_date DESC LIMIT ".$_POST['start'].",".$_POST['end']."";
        }

        if($_POST['sort_by']!="low" && $_POST['sort_by']!="high" && $_POST['action']=='search'){
            $query .=" ORDER BY products.pro_date DESC";
        }
        
        //,'min_price' => $_POST['minimum_price'],'max_price' => $_POST['maximum_price']

        try{
            $stmt = $con->prepare($query);
            if($_POST['action']=='search'){
                $stmt->execute(['pro_name'=>'%'.$_POST['pro_name'].'%']);
            } 
            else{
                $stmt->execute(['category' => $_POST['category'],'subcategory' => $_POST['subcategory']]);
            }
            $result = $stmt->fetchAll();
            $total_row = $stmt->rowCount();
            if($total_row > 0){
                foreach($result as $rows){
                    $output .= '
                        <div class="col s12 m6 l4">
                            <div class="card">
                                <a target="_blank" href="product_details.php?category='.$_POST['category'].'&&id='.$rows['product_id'].'">
                                    <div class="card-image">
                                        <img class="hide-on-med-and-down" src="images/product_images/'.$rows['pic1'].'" style="border: 1px solid black" width="280px" height="400px">
                                        <img class="hide-on-large-only" src="images/product_images/'.$rows['pic1'].'" style="border: 1px solid black" width="180px" height="300px">
                                    </div>
                                    <div class="card-content black-text">
                                        <span class="card-title truncate">'.$rows['product_name'].'</span>
                                        <p class="truncate">'.$rows['product_description'].'</p>
                                    
                                    </div>
                                </a>
                                <div class="card-action">';
                                // if($rows['stock']>0){
                                $output .='
                                    <button class="add_to_cart orange-text waves-effect waves-orange btn-flat add'.$rows['product_id'].'" style="margin-right: 0px;padding-left: 5px;padding-right: 5px;" type="submit" id="'.$rows['product_id'].'">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart</button>
                                    <button class="buy_now orange-text waves-effect waves-orange btn-flat buy-button-margin" style="margin-right: 0px;padding-left: 8px;padding-right: 8px;" type="submit" id="'.$rows['product_id'].'">Buy Now</button>';
                                // }else{
                                //     $output .='<p class="center red-text" style="margin-top: 7px;margin-bottom: 7px;">OUT OF STOCK</p>';
                                // }
                                $output .='
                                    
                                </div>
                            </div>
                        </div>
                        
                    ';
                }
                // $output .='<div col l12>
                //             <button class="btn"></button>
                //         </div>';
            }
            else{
                $output = '<h3>No Products</h3>';
            }
           
        }
        catch(PDOException $e){
            echo "There is some problem in the connection" .$e;
        }
        echo $output;
            
    }
?>