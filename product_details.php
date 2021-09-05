<?php include 'components/session.php';?>
<!DOCTYPE html>
<html lang="en">
    <?php 
        if(isset($_GET['id']) && isset($_GET['category'])){
            
            $con = $pdo->open();
            $stmt = $con->prepare("SELECT count(*) AS total from products WHERE product_id=:pro_id");
            $stmt->execute(['pro_id'=>$_GET['id']]);
            $stmtCat = $con->prepare("SELECT count(*) AS total from category WHERE category_name=:category");
            $stmtCat->execute(['category'=>$_GET['category']]);
            $pro_count = $stmt->fetch();
            $cat_count = $stmtCat->fetch();
            if($pro_count['total']>0 && $cat_count['total']){
    ?>
    <?php include 'components/header.php'; ?>
    <link rel="stylesheet" href="styles/product_deatils.css">

    
<body onload="loadingGif()">

<div id="loading" style="display:none;">
</div>
    <header>
        <?php include 'components/nav-page.php'; ?>
    </header>
    <br>

    <div class="webcontainer">
    <!-- The featured-img-modal -->
    <div id="myModal" class="featured-img-modal">
        <span class="close">&times;</span>
        <img class="featured-img-modal-content" id="img01">
        <div id="caption"></div>
    </div>
        <div class="row">
            <div class="col s12 m12 l12 center">
                <div class="callout" id="callout" style="display:none">
                    <span id="cart_message" class="message"></span>
                    <button type="button" id="close_btn" class="close red-text waves-effect btn-flat left-align hide-on-med-and-down" style="bottom: 0px;top: 86px;left: 800px;"><i class="material-icons">close</i></button>
                    <!-- <button type="button" id="close_btn" class="close waves-effect btn-flat"><i class="material-icons">close</i></button> -->
                </div>
                <?php
                    if(!isset($_SESSION['rushabh_novelty_user'])){ 
                ?>
                <!-- <div class="container">
                    <span id="login_msg" class="red-text">Login to add item to your cart</span>
                </div> -->
                <?php 
                    }
                ?>
                <div class="divider"></div>
                <br>
            </div>
            <?php
                $con = $pdo->open();
                try{
                    $stmt = $con->prepare("SELECT * from products,product_photos WHERE products.product_id=:proid  and product_photos.product_id =:proid");
                    $stmt->execute(['proid' => $_GET['id']]);
                    $product = $stmt->fetch();
                }
                catch(PDOException $e){
                    echo 'There is some problem with the connection' .$e->getMessage();
                }       
            ?>
            
            <div class="col s12 m12 l6">
            
                <!-- The pro_img_modal -->
            
                <div class="img-div">
                <!-- materialboxed -->
                <img id="featured-img" class="materialboxed responsive-img img-container hide-on-med-and-down" data-zoom-image="<?php echo (!empty($product['pic1'])) ? 'images/product_images/'.$product['pic1'] : 'images/no-image.png'; ?>" src="<?php echo (!empty($product['pic1'])) ? 'images/product_images/'.$product['pic1'] : 'images/no-image.png'; ?>" />
            
                <img id="featured-img-mobile" class="responsive-img img-container hide-on-large-only" src="<?php echo (!empty($product['pic1'])) ? 'images/product_images/'.$product['pic1'] : 'images/no-image.png'; ?>" />

                </div>
                <div id="slide-wrapper">
                    <img id="slideleft" class="arrow" src="images/icon/64/back.png" alt="">
                    <div id="slider">
                        <!-- <img class="thumbnail active-img" src="images/product_images/<?php echo $product['pic1'] ?>" alt=""> -->
                        <a href="#" data-image="<?php echo (!empty($product['pic1'])) ? 'images/product_images/'.$product['pic1'] : 'images/no-image.png'; ?>" data-zoom-image="<?php echo (!empty($product['pic1'])) ? 'images/product_images/'.$product['pic1'] : 'images/no-image.png'; ?>">
                            <img class="thumbnail active-img" src="<?php echo (!empty($product['pic1'])) ? 'images/product_images/'.$product['pic1'] : 'images/no-image.png'; ?>" alt="">
                        </a>
                        <a href="#" data-image="<?php echo (!empty($product['pic2'])) ? 'images/product_images/'.$product['pic2'] : 'images/no-image.png'; ?>" data-zoom-image="<?php echo (!empty($product['pic2'])) ? 'images/product_images/'.$product['pic2'] : 'images/no-image.png'; ?>">
                            <img class="thumbnail" src="<?php echo (!empty($product['pic2'])) ? 'images/product_images/'.$product['pic2'] : 'images/no-image.png'; ?>" alt="">
                        </a>
                        <a href="#" data-image="<?php echo (!empty($product['pic3'])) ? 'images/product_images/'.$product['pic3'] : 'images/no-image.png'; ?>" data-zoom-image="<?php echo (!empty($product['pic3'])) ? 'images/product_images/'.$product['pic3'] : 'images/no-image.png'; ?>">
                            <img class="thumbnail" src="<?php echo (!empty($product['pic3'])) ? 'images/product_images/'.$product['pic3'] : 'images/no-image.png'; ?>" alt="">
                        </a>
                        <a href="#" data-image="<?php echo (!empty($product['pic4'])) ? 'images/product_images/'.$product['pic4'] : 'images/no-image.png'; ?>" data-zoom-image="<?php echo (!empty($product['pic4'])) ? 'images/product_images/'.$product['pic4'] : 'images/no-image.png'; ?>">
                            <img class="thumbnail" src="<?php echo (!empty($product['pic4'])) ? 'images/product_images/'.$product['pic4'] : 'images/no-image.png'; ?>" alt="">
                        </a>
                        <a href="#" data-image="<?php echo (!empty($product['pic5'])) ? 'images/product_images/'.$product['pic5'] : 'images/no-image.png'; ?>" data-zoom-image="<?php echo (!empty($product['pic5'])) ? 'images/product_images/'.$product['pic5'] : 'images/no-image.png'; ?>">
                            <img class="thumbnail" src="<?php echo (!empty($product['pic5'])) ? 'images/product_images/'.$product['pic5'] : 'images/no-image.png'; ?>" alt="">
                        </a>
                        <a href="#" data-image="<?php echo (!empty($product['pic6'])) ? 'images/product_images/'.$product['pic6'] : 'images/no-image.png'; ?>" data-zoom-image="<?php echo (!empty($product['pic6'])) ? 'images/product_images/'.$product['pic6'] : 'images/no-image.png'; ?>">
                            <img class="thumbnail" src="<?php echo (!empty($product['pic6'])) ? 'images/product_images/'.$product['pic6'] : 'images/no-image.png'; ?>" alt="">
                        </a>
                        <a href="#" data-image="<?php echo (!empty($product['pic7'])) ? 'images/product_images/'.$product['pic7'] : 'images/no-image.png'; ?>" data-zoom-image="<?php echo (!empty($product['pic7'])) ? 'images/product_images/'.$product['pic7'] : 'images/no-image.png'; ?>">
                            <img class="thumbnail" src="<?php echo (!empty($product['pic7'])) ? 'images/product_images/'.$product['pic7'] : 'images/no-image.png'; ?>" alt="">
                        </a>
                        <a href="#" data-image="<?php echo (!empty($product['pic8'])) ? 'images/product_images/'.$product['pic8'] : 'images/no-image.png'; ?>" data-zoom-image="<?php echo (!empty($product['pic8'])) ? 'images/product_images/'.$product['pic8'] : 'images/no-image.png'; ?>">
                            <img class="thumbnail" src="<?php echo (!empty($product['pic8'])) ? 'images/product_images/'.$product['pic8'] : 'images/no-image.png'; ?>" alt="">
                        </a>
                        <a href="#" data-image="<?php echo (!empty($product['pic9'])) ? 'images/product_images/'.$product['pic9'] : 'images/no-image.png'; ?>" data-zoom-image="<?php echo (!empty($product['pic9'])) ? 'images/product_images/'.$product['pic9'] : 'images/no-image.png'; ?>">
                            <img class="thumbnail" src="<?php echo (!empty($product['pic9'])) ? 'images/product_images/'.$product['pic9'] : 'images/no-image.png'; ?>" alt="">
                        </a>
                        <a href="#" data-image="<?php echo (!empty($product['pic10'])) ? 'images/product_images/'.$product['pic10'] : 'images/no-image.png'; ?>" data-zoom-image="<?php echo (!empty($product['pic10'])) ? 'images/product_images/'.$product['pic10'] : 'images/no-image.png'; ?>">
                            <img class="thumbnail" src="<?php echo (!empty($product['pic10'])) ? 'images/product_images/'.$product['pic10'] : 'images/no-image.png'; ?>" alt="">
                        </a>
                        
                    </div>
                    <img src="images/icon/64/forward.png" alt="" class="arrow" id="slideright">
                </div>
            </div>

            <div class="col s12 m12 l5 offset-l1 section">
                <p><h3><?php echo $product['product_name'] ?></h3></p>
                <p>
                    <span style="font-size:1.25rem;">Description:</span><br>
                    <span><?php echo $product['product_description'] ?></span>
                </p>

                <p>
                    <span style="font-size:1.25rem;">GST NO:</span>
                    <span><?php echo $product['gst_no'] ?></span>
                </p>
                <p>
                    <span style="font-size:1.25rem;">HSN Code:</span>
                    <span><?php echo $product['hsn_code'] ?></span> 
                </p>
                <!--<p>-->
                <!--    <span style="font-size:1.25rem;">Quantity of product:</span>-->
                <!--    <span><?php echo $product['quantity_of_product'] ?></span> -->
                <!--</p>-->
                <p style="font-size:1.25rem;">MRP: <i class="fa fa-inr" aria-hidden="true"></i> <?php echo $product['product_price'] ?>/-</p>
                
                <div class="row" style="margin-bottom: 0px;">
                    <div class="col s4 m3 l3">
                        <p style="font-size:1.25rem;">Quantity:</p>
                    </div>
                    <div class="input-field col s4 m3 l3" style="font-size:1.25rem;margin-top: 10px;">
                        <input type="text" name="product_quantity" id="product_quantity" value="1">
                        
                    </div>
                </div>
                <!--<div class="row" style="margin-bottom: 0px;">-->
                <!--    <div class="col s4 m4 l4">-->
                <!--        <p style="font-size:1.25rem;padding-right: 0px;">Special Note:</p>-->
                <!--    </div>-->
                <!--    <div class="input-field col s8 m8 l8" style="font-size:1.25rem;margin-top: 10px;padding-left: 0px;">-->
                <!--        <input type="text" name="special_note" id="special_note">-->
                        
                <!--    </div>-->
                <!--</div>-->
                
                <!-- <div class="row">
                    <div class="col s4 m3 l3">
                        <p style="font-size:1.25rem;">Colour:</p>
                    </div>
                    <div class="input-field col s4 m3 l3" style="font-size:1.25rem;">
                        <select class="browser-default" id="product_colour">
                            <?php
                                $stmtColour = $con->prepare("SELECT DISTINCT colour from products WHERE product_name=:product_name");
                                $stmtColour->execute(['product_name'=>$product['product_name']]);
                                foreach($stmtColour as $rowColour){
                                    if($product['colour'] == $rowColour['colour']){
                                        echo "<option selected='selected' value=".$rowColour["colour"].">".$rowColour['colour']."</option>";
                                    }
                                    else{
                                        echo "<option value=".$rowColour["colour"].">".$rowColour["colour"]."</option>" ;
                                    }
                                }
                            ?>

                        </select>
                    </div>
                </div> -->
                
                <div class="row">
                <?php
                    // if($product['stock']>0){
                ?>
                    <div class="col s6 m6 l6">    
                        <button class="btn-large waves-effect waves-light buy_now" id=<?php echo $product['product_id']; ?> type="submit" name="action"><span class="icon-btn"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Buy Now</span></button>
                    </div>
                    <div class="col s6 m6 l6">
                        <button class="btn-large waves-effect waves-light add_to_cart" id=<?php echo $product['product_id']; ?> type="submit" name="action"><span class="icon-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart</span></button>
                    </div>
                    <div id="show_products">

                    </div>
                <?php
                    // }
                    // else{
                ?>
                    <!-- <div class="col s12 m12 l12">
                        <p class="red-text center">OUT OF STOCK</p>
                    </div>
                    <div class="col s6 m6 l6">    
                        <button class="btn-large waves-effect waves-light disabled" type="submit" name="action"><span class="icon-btn"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Buy Now</span></button>
                    </div>
                    <div class="col s6 m6 l6">
                        <button class="btn-large waves-effect waves-light disabled" type="submit" name="action"><span class="icon-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart</span></button>
                    </div> -->
                <?php
                    // }
                ?>
                </div>
            </div>

            <!-- Recently Viewed -->
            <div class="section">
                <div class="row">
                    <div class="col s12 m12 l12 center">
                        <h3><span>Similar Products</span></h3>
                        <div class="divider"></div>
                    </div>
                </div>
                <div class="row wrapper1">
                    
                    <?php
                        $con = $pdo->open();
                        try{
                            $stmtProTotal = $con->prepare("SELECT count(*) as pro_total FROM products WHERE subcategoty_id=:sub_id AND product_id!=:proid");
                            $stmtProTotal->execute(['sub_id' => $product['subcategoty_id'],'proid'=> $_GET['id']]);
                            $proTotal = $stmtProTotal->fetch();
                            $stmt = $con->prepare("SELECT products.product_id, products.product_name, products.product_description, products.product_price, category.category_name, subcategory.subcategory_name, product_photos.pic1 from products, category, subcategory, product_photos WHERE products.category_id = category.catergory_id and products.subcategoty_id = subcategory.subcategory_id and products.product_id = product_photos.product_id and products.subcategoty_id=:sub_id AND products.product_id!=:proid ORDER BY pro_date DESC LIMIT 10");
                            $stmt->execute(['sub_id' => $product['subcategoty_id'],'proid'=> $_GET['id']]);
                            if($proTotal['pro_total']>0){
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
                                            <div class="card-action">
                                            <button class="add_to_cart orange-text waves-effect waves-orange btn-flat add'.$row['product_id'].' " style="margin-right: 0px;padding-left: 5px;padding-right: 5px;" type="submit" id="'.$row['product_id'].'">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span id="add_cart">Add to cart</span>
                                            </button>
                                            <button class="buy_now waves-effect orange-text waves-orange btn-flat" style="margin-right: 0px;padding-left: 8px;padding-right: 8px;margin-left: 3px;" type="submit" id="'.$row['product_id'].'">Buy Now</button>
                                            </div>
                                        </div>
                                    </div>
                                ';
                                }
                            }else{
                                echo '<div class="container center"><h4>No Similar Product Available</h4></div>';
                            }
                        $pdo->close();
                        }
                        catch(PDOException $e){
                            echo 'There is some problem with the connection' .$e->getMessage();
                        }       
                    ?>

                </div>
            </div>

            <!-- Similar Products -->
            <div class="section">
                <div class="row">
                    <div class="col s12 m12 l12 center">
                        <h3><span><?php echo $_GET['category']; ?></span></h3>
                        <div class="divider"></div>
                    </div>
                </div>
                <div class="row wrapper1">
                <?php
                        $con = $pdo->open();
                        try{
                            $stmtProTotal = $con->prepare("SELECT count(*) as pro_total FROM products, category, subcategory, product_photos WHERE products.category_id = category.catergory_id and products.subcategoty_id = subcategory.subcategory_id and products.product_id = product_photos.product_id and category.category_name=:category AND products.product_id!=:proid");
                            $stmtProTotal->execute(['category' => $_GET['category'],'proid'=>$_GET['id']]);
                            $proTotal = $stmtProTotal->fetch();
                            $stmt = $con->prepare("SELECT products.product_id, products.product_name, products.product_description, products.product_price, category.category_name, subcategory.subcategory_name, product_photos.pic1 from products, category, subcategory, product_photos WHERE products.category_id = category.catergory_id and products.subcategoty_id = subcategory.subcategory_id and products.product_id = product_photos.product_id and category.category_name=:category AND products.product_id!=:proid ORDER BY pro_date DESC LIMIT 10");
                            $stmt->execute(['category' => $_GET['category'],'proid'=>$_GET['id']]);
                            if($proTotal['pro_total']>0){
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
                                            <div class="card-action">
                                            <button class="add_to_cart orange-text waves-effect waves-orange btn-flat add'.$row['product_id'].' " style="margin-right: 0px;padding-left: 5px;padding-right: 5px;" type="submit" id="'.$row['product_id'].'">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span id="add_cart">Add to cart</span>
                                            </button>
                                            <button class="buy_now waves-effect orange-text waves-orange btn-flat" style="margin-right: 0px;padding-left: 8px;padding-right: 8px;margin-left: 3px;" type="submit" id="'.$row['product_id'].'">Buy Now</button>
                                            </div>
                                        </div>
                                    </div>
                                ';
                                }
                            }
                            else{
                                echo '<div class="container center"><h4>No More Products Available for '.$_GET['category'].'</h4></div>';
                            }
                        $pdo->close();
                        }
                        catch(PDOException $e){
                            echo 'There is some problem with the connection' .$e->getMessage();
                        }       
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>
    <?php include 'components/script.php'; ?>
    <?php include 'scripts/nav_script.php'; ?>

    <script type="text/javascript" src="scripts/image_zoom.js"></script>
    <script type="text/javascript">

    var preloader = document.getElementById('loading');

    $("#featured-img").elevateZoom(
            {gallery:'slider',
            galleryActiveClass: 'active',
            scrollZoom : false,
            zoomLevel: 1,
            cursor: "plus"}
            );
    

    function loadingGif(){
        preloader.style.display = 'none';
    }

        
        let thumbnails = document.getElementsByClassName('thumbnail')

		let activeImages = document.getElementsByClassName('active-img')

		for (var i=0; i < thumbnails.length; i++){

			thumbnails[i].addEventListener('click', function(){
				console.log(activeImages)
				
				if (activeImages.length > 0){
					activeImages[0].classList.remove('active-img')
				}
				

				this.classList.add('active-img')
				document.getElementById('featured-img').src = this.src;
                document.getElementById('featured-img-mobile').src = this.src;
                document.getElementById('featured-img').setAttribute("data-zoom-image",this.src);
			})
		}

		let buttonRight = document.getElementById('slideright');
		let buttonLeft = document.getElementById('slideleft');

		buttonLeft.addEventListener('click', function(){
			document.getElementById('slider').scrollLeft -= 180
		})

		buttonRight.addEventListener('click', function(){
			document.getElementById('slider').scrollLeft += 180
        })


        $(document).on('change','#product_colour',function(){
            var colour = $(this).val();
               var action = "colour";
               var product_name = '<?php echo $product['product_name'];?>';
               var category = '<?php echo $_GET['category']; ?>';
               console.log(colour);
               $.ajax({
                method:"POST",
                url:"change_product_colour.php",
                data:{action:action,colour:colour,product_name:product_name,category:category},
                dataType: 'json',
                success:function(data){
                    var cat = data.category_name;
                    var pro_id = data.pro_id;
                   document.location.href = "product_details.php?category="+cat+"&&id="+pro_id;
                },
                error: function (textStatus, errorThrown) {
                    console.log(textStatus+errorThrown);
                }
               });
        });
        
        $(document).on('click','.buy_now',function(){
            var action = "add";
            var user_id = '<?php if(isset($_SESSION['rushabh_novelty_user'])) {echo $_SESSION['rushabh_novelty_user'];}else{echo 0;} ?>';
            var product_id = $(this).attr("id");
            var pro_quantity = document.getElementById("product_quantity").value;
            $.ajax({
                url:"add_to_cart.php",
                method:"POST",
                data:{action:action,user_id:user_id,product_id:product_id,pro_quantity:pro_quantity},
                dataType: 'json',
                success:function(data){
                    if(data.error == true){
                        $('#callout').show();
                        $('.message').html(data.message);
                        document.getElementById("callout").classList.add("red-text");
                        document.getElementById("close_btn").classList.add("waves-red");
                    }else{
                        document.location.href = "product_cart.php";
                    }
                }
            });
            cart_count();

        });

        
        $(document).on('click','.add_to_cart',function(){
            var action = "add";
            var user_id = '<?php if(isset($_SESSION['rushabh_novelty_user'])) {echo $_SESSION['rushabh_novelty_user'];}else{echo 0;} ?>';
            var product_id = $(this).attr("id");
            var pro_quantity = document.getElementById("product_quantity").value;
            $.ajax({
                url:"add_to_cart.php",
                method:"POST",
                data:{action:action,user_id:user_id,product_id:product_id,pro_quantity:pro_quantity},
                dataType: 'json',
                success:function(data){
                    // $('#show_products').html(data);
                    $('#callout').show();
                    $('.message').html(data.message);
                    if(data.error == false){
                        document.getElementById("callout").classList.add("green-text");
                        document.getElementById("close_btn").classList.add("waves-green");
                        var x, i;
                        x = document.querySelectorAll(".add"+product_id);
                        for (i = 0; i < x.length; i++) {
                            x[i].classList.add("green-text");
                            x[i].textContent = data.btn_message;
                        }
                    }
                    else{
                        document.getElementById("callout").classList.add("red-text");
                        document.getElementById("close_btn").classList.add("waves-red");
                        var x, i;
                        x = document.querySelectorAll(".add"+product_id);
                        for (i = 0; i < x.length; i++) {
                            x[i].classList.add("red-text");
                            x[i].textContent = data.btn_message;
                        }
                    }
                }
            });
            cart_count();

        });


        function cart_count(){
            var user_id = '<?php if(isset($_SESSION['rushabh_novelty_user'])) {echo $_SESSION['rushabh_novelty_user'];}else{echo 0;} ?>';
            $.ajax({
                url:"show_cart_count.php",
                method:"POST",
                data:{user_id:user_id},
                success:function(data){
                    $('#show_count').html(data);
                    $('#show_count_mobile').html(data);
                }
            });            
        }

        $(document).on('click', '.close', function(){
            $('#callout').hide();
        });

        
    </script>
</body>
<?php   }
        else{
            header("Location:index.php");    
        }
    }
    else{
        header("Location:index.php");
    }
?>
</html>