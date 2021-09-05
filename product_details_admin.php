<?php session_start();
    include 'components/conn.php';
?>
<!DOCTYPE html>
<html lang="en">
    <?php 
     //  if(isset($_GET['id'])){
            
            $con = $pdo->open();
            $stmt = $con->prepare("SELECT count(*) AS total from products WHERE product_id=:pro_id");
            $stmt->execute(['pro_id'=>$_GET['id']]);
            $pro_count = $stmt->fetch();
            //if($pro_count['total']>0){
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
    <div id="myModal" class="featured-img-modal">
        <span class="close">&times;</span>
        <img class="featured-img-modal-content" id="img01">
        <div id="caption"></div>
    </div>
        <div class="row">
            <div class="col s12 m12 l12 center">
                <div class="callout" id="callout" style="display:none">
                    <span id="cart_message" class="message"></span>
                    <button type="button" id="close_btn" class="close waves-effect btn-flat"><i class="material-icons">close</i></button>
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
                
                    $stmtCat = $con->prepare("SELECT category_name FROM category WHERE catergory_id=:id");
                    $stmtCat->execute(['id'=>$product['category_id']]);
                    $category = $stmtCat->fetch();
                }
                catch(PDOException $e){
                    echo 'There is some problem with the connection' .$e->getMessage();
                }       
            ?>
            
            <div class="col s12 m12 l6">
                <div class="img-div">
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
                <p>
                    <span style="font-size:1.25rem;">Quantity of product:</span>
                    <span><?php echo $product['quantity_of_product'] ?></span> 
                </p>

                <p style="font-size:1.25rem;">MRP: <i class="fa fa-inr" aria-hidden="true"></i> <?php echo $product['product_price'] ?>/-</p>
                                
                <!-- <div class="row">
                    <div class="col s12 m12 l12">
                        <p style="font-size:1.25rem;">Colour: <?php echo $product['colour'] ?></p>
                    </div>
                </div> -->
                
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
            scrollZoom : true,
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
        

        $(document).on('click', '.close', function(){
            $('#callout').hide();
        });

        
    </script>
</body>
<?php   //}
        // else{
        //     header("Location:home.php");    
        // }
    // }
    // else{
    //     header("Location:index.php");
    // }
?>
</html>