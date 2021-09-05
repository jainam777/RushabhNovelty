<?php include 'components/session.php';?>
<!DOCTYPE html>
<html lang="en">
    <?php 
        if(isset($_GET['id']) && isset($_GET['category']) && isset($_SESSION['rushabh_novelty_user'])){
            
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
        <div class="row">
            <div class="col s12 m12 l12 center">
                <div class="callout" id="callout" style="display:none">
                    <span id="cart_message" class="message"></span>
                    <button type="button" id="close_btn" class="close waves-effect btn-flat"><i class="material-icons">close</i></button>
                </div>
                <?php
                    if(!isset($_SESSION['rushabh_novelty_user'])){ 
                ?>
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
                <div class="img-div">
                <img id="featured-img" class="responsive-img materialboxed img-container" data-zoom-image="<?php echo (!empty($product['pic1'])) ? 'images/product_images/'.$product['pic1'] : 'images/no-image.png'; ?>" src="<?php echo (!empty($product['pic1'])) ? 'images/product_images/'.$product['pic1'] : 'images/no-image.png'; ?>" />
                   
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
                        
                    </div>
                    <img src="images/icon/64/forward.png" alt="" class="arrow" id="slideright">
                </div>
            </div>

            <div class="col s12 m12 l5 offset-l1 section">
                <p><h3><?php echo $product['product_name'] ?></h3></p>

                <p style="font-size:1.25rem;">
                <?php
                    if($product['rating']==0){
                        echo '<span>Ratings: No Ratings</span>';
                    }else{
                        ?>
                    <span>Ratings: <span class="btn yellow black-text"><?php echo $product['rating'] ?></span>
                        <?php
                            for($i=0;$i<$product['rating'];$i++){ 
                                echo '<i class="fa fa-star yellow-text" aria-hidden="true"></i> ';}
                            ?>  
                    </span>
                    <?php
                    }
                    ?>
                </p>

                <p>
                    <span style="font-size:1.25rem;">Description:</span><br>
                    <span><?php echo $product['product_description'] ?></span>
                </p>

                <p style="font-size:1.25rem;">MRP: <i class="fa fa-inr" aria-hidden="true"></i> <?php echo $product['product_price'] ?>/-</p>
                
                <p style="font-size:18px;margin-top: 5px;">Colour: <?php echo $product['colour'] ?>
                </p>
                
                <div>
                <h3>Rate the product:- </h3>
                    <i class="fa fa-star fa-3x rate_star" data-index="0" aria-hidden="true"></i>
                    <i class="fa fa-star fa-3x rate_star" data-index="1" aria-hidden="true"></i>
                    <i class="fa fa-star fa-3x rate_star" data-index="2" aria-hidden="true"></i>
                    <i class="fa fa-star fa-3x rate_star" data-index="3" aria-hidden="true"></i>
                    <i class="fa fa-star fa-3x rate_star" data-index="4" aria-hidden="true"></i>
                </div>
                <div class="row center">
                    <!-- <form class="col s12"> -->
                    <div class="row">
                        <div class="input-field col s12">
                        <textarea id="pro_review" class="materialize-textarea"></textarea>
                        <label for="pro_review">Review</label>
                        </div>
                        <button class="btn waves-effect waves-light" id="rate_review" name="action">Submit
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                    <!-- </form> -->
                </div>
                <div class="center">
                    <h3 id="user_rating_msg"></h3>
                </div>
            </div>
            
            <div class="col s12 m12 l12 center">
            <br>
                <h3><span>Product Details</span></h3>
                <div class="divider"></div>
            </div>
            <div class="col s12 m12 l12 section">
            
            <ul class="collapsible expandable">
                <li>
                    <div class="collapsible-header"><i class="fa fa-cogs" aria-hidden="true"></i>Properties<i class="fa fa-angle-down right" aria-hidden="true"></i></div>
                    <div class="collapsible-body">
                        <table class="highlight">
                            <tbody>
                            <tr>
                                <td>Recommended Load</td>
                                <td><?php echo $product['weight'] ?> kg</td>
                            </tr>
                            <tr>
                                <td>Material</td>
                                <td><?php echo $product['material']?></td>
                            </tr>
                            <tr>
                                <td>Primary Room</td>
                                <td><?php echo $_GET['category'] ?></td>
                            </tr>
                            <tr>
                                <td>Colour</td>
                                <td><?php echo $product['colour'] ?></td>
                            </tr>
                            <tr>
                                <td>Size</td>
                                <td>Standard</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="fa fa-certificate" aria-hidden="true"></i>Warranty<i class="fa fa-angle-down right" aria-hidden="true"></i></div>
                    <div class="collapsible-body">
                        <ul type="circle">
                            <li>The product comes with a 12 month warranty against any manufacturing defects and any other issues with the materials that have been used.</li>
                            <li>The warranty does not cover damages due to usage of the product beyond its intended use and wear & tear in the natural course of product usage.</li>
                            <li>Please note that the above policies do not apply to all pincodes. To see the policy for your location, enter your pincode in the box above.</li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">whatshot</i>Third<i class="fa fa-angle-down right" aria-hidden="true"></i></div>
                    <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                </li>
            </ul>
            </div>

        </div>
    </div>

    <?php include 'components/footer.php'; ?>
    <?php include 'components/script.php'; ?>
    <?php include 'scripts/nav_script.php'; ?>

    <script type="text/javascript">
    var preloader = document.getElementById('loading');
    
    $(document).ready(function(){
        var rating = 0;
        var ratedIndex = -1;
        resetStateColours();

        $('.rate_star').on('click',function(){
            ratedIndex = parseInt($(this).data('index'));
            var action = 'rate';
            rating = ratedIndex+1;
            var product_id = '<?php echo $_GET['id']; ?>';
        });

        $('#rate_review').on('click',function(){
            var action = 'rate';
           // rating = ratedIndex+1;
            var review = document.getElementById('pro_review').value;
            var product_id = '<?php echo $_GET['id']; ?>';
            $.ajax({
                url:"store_user_rating.php",
                method:"POST",
                data:{action:action,rating:rating,review:review,product_id:product_id},
                dataType: 'json',
                success:function(data){
                    $('#user_rating_msg').html(data.message);
                    if(data.error == true){
                        document.getElementById('user_rating_msg').classList.add("red-text");
                    }else{
                        document.getElementById('user_rating_msg').classList.add("green-text");
                        setTimeout(function(){
                            document.location.href = 'user_orders.php';
                        }, 1000);
                    }                   
                }
            });
        });

        

        $('.rate_star').mouseover(function(){
            resetStateColours();

            var currentIndex = parseInt($(this).data('index'));

            for (var i=0; i<=currentIndex; i++){
                $('.rate_star:eq('+i+')').css('color','yellow');
            }
        });

        $('.rate_star').mouseleave(function(){
            resetStateColours();

            if(ratedIndex != -1){
                for (var i=0; i<=ratedIndex; i++){
                    $('.rate_star:eq('+i+')').css('color','yellow');
                }
                
            }
        });

        function resetStateColours(){
            $('.rate_star').css('color','gray');
        }
    });

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