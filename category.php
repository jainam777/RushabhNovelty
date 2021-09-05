<?php include 'components/session.php'; ?>
<!DOCTYPE html>
<html lang="en">


<?php include 'components/header.php'; ?>

<body onload="loadingGif()">
    <div id="loading">
    </div>

    <header>
        <?php include 'components/nav.php'; ?>
    </header>

    <?php
    if(isset($_GET['category'])){
        $categoryName = $_GET['category'];
        $con = $pdo->open();
        try{
            $stmtCategory = $con->prepare("SELECT count(*) as total,category_name,category_img from category WHERE category_name=:cat_name");
            $stmtCategory->execute(['cat_name'=>$categoryName]);
            $catCount = $stmtCategory->fetch();
            $category=$catCount['category_name'];
            $navCategoryAdd = str_replace(' ','',$category);
            if($catCount['total']==1){

    ?>
        <div class="webcontainer" id="<?php echo $navCategoryAdd; ?>">
    <div class="row">
        <div class="col s12 m12 l12 center">
            <h3><?php echo $category; ?></h3>
            <div class="divider"></div>
            <br>
            <img class="responsive-img" style="width:100%;" src="images/category_images/<?php echo $catCount['category_img'] ?>" alt="">
        </div>
        
        <div class="col s12 m12 l12">
        <br>
        <div class="divider"></div>
        <?php
            $con = $pdo->open();
            try{
                $stmt = $con->prepare("SELECT subcategory.subcategory_id,subcategory.subcategory_name,category.category_name FROM subcategory INNER JOIN category ON subcategory.category_id=category.catergory_id where category.category_name=:category_name");
                $stmt->execute(['category_name'=>$category]);
                $_SESSION['pro_category']=$category;
            }
            catch(PDOException $e){
                echo "There is some problem in connection:" .$e.getMessage();
            }
        ?>
            <div id="selectbox" class="input-field">
                <select class="browser-default" onchange="location = this.value;" style="border: 5px solid black !important;height: 4.5rem !important;">
                    <option value="#" selected disabled>Select your option</option>
                    <?php
                        while($rows = $stmt->fetch()){
                            $subcat = $rows['subcategory_name'];
                            echo'<option value="all_products.php?category='.$_SESSION['pro_category'].'&subcategory='.$subcat.'">'.$subcat.'</option>';
                        } 
                        
                    ?>
                </select>
                <!-- <label>Filter:</label> -->
            </div>
            <!-- <div class="divider"></div> -->
        </div>
        <br>
        <?php
            try{
                $stmtSub = $con->prepare("SELECT subcategory.subcategory_id,subcategory.subcategory_name,category.category_name FROM subcategory INNER JOIN category ON subcategory.category_id=category.catergory_id where category.category_name=:category_name");
                $stmtSub->execute(['category_name'=>$category]);
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
                            $stmt = $con->prepare("SELECT products.product_id, products.product_name, products.stock, products.product_description, products.product_price, category.category_name, subcategory.subcategory_name, product_photos.pic1 from products, category, subcategory, product_photos WHERE products.category_id = category.catergory_id and products.subcategoty_id = subcategory.subcategory_id and products.product_id = product_photos.product_id and category.category_name =:category_name and subcategory.subcategory_name =:subcategory ORDER BY products.pro_date DESC LIMIT 4");
                            $stmt->execute(['subcategory'=>$rows['subcategory_name'],'category_name'=>$category]);
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
                                            <button class="add_to_cart orange-text waves-effect waves-orange btn-flat add'.$row['product_id'].' " style="margin-right: 0px;padding-left: 5px;padding-right: 5px;" type="submit" id="'.$row['product_id'].'">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span id="add_cart">Add to cart</span>
                                            </button>
                                            <button class="buy_now orange-text waves-effect waves-orange btn-flat" style="margin-right: 0px;padding-left: 8px;padding-right: 8px;margin-left: 3px;" type="submit" id="'.$row['product_id'].'">Buy Now</button>';
                                        // }else{
                                        //     echo '<p class="center red-text" style="margin-top: 7px;margin-bottom: 7px;">OUT OF STOCK</p>';
                                        // }
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
<?php
        }
        else{
        ?>
             <script> location.replace("index.php"); </script>
        <?php
            }
        }catch(PDOException $e){

        }

    }
    else{
        ?>
        <script> location.replace("index.php"); </script>
         <?php 
    }
   
?>

    
    
    <?php include 'components/footer.php'; ?>
    <?php include 'components/script.php'; ?>
    <?php include 'scripts/nav_script.php'; ?>
    <!-- <script>
          document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.carousel');
    var instances = M.Carousel.init(elems, options);
  });
    </script> -->
    
    <script>

        var preloader = document.getElementById('loading');

        function loadingGif(){
            preloader.style.display = 'none';
        }

        $(document).on('click','.add_to_cart',function(){
            var action = "add";
            var product_id = $(this).attr("id");
            var user_id = '<?php if(isset($_SESSION['rushabh_novelty_user'])) {echo $_SESSION['rushabh_novelty_user'];}else{echo 0;} ?>';
            $.ajax({
                url:"add_to_cart.php",
                method:"POST",
                data:{action:action,user_id:user_id,product_id:product_id},
                dataType: 'json',
                success:function(data){
                    if(data.error == false){
                      //  document.getElementById(product_id).classList.add("green-text");
                        //document.getElementById(product_id).textContent=data.btn_message;
                       // document.getElementsByClassName(product_id+"add").classList.add("green-text");
                     //   document.querySelectorAll("."+product_id+"add").textContent=data.btn_message;
                        var x, i;
                        x = document.querySelectorAll(".add"+product_id);//document.querySelectorAll("[class='add"+product_id+"']");
                        for (i = 0; i < x.length; i++) {
                            x[i].classList.add("green-text");
                            x[i].textContent = data.btn_message;
                        }

                    }
                    else{
                        // document.getElementById(product_id).classList.add("red-text");
                        // document.getElementById(product_id).textContent=data.btn_message;

                       // document.getElementsByClassName(product_id+"add").classList.add("green-text");
                        //document.getElementsByClassName(product_id+"add")[0].textContent=data.btn_message;
                      //  document.querySelectorAll("."+product_id+"add").textContent=data.btn_message;
                        var x, i;
                        x = document.querySelectorAll(".add"+product_id);// document.querySelectorAll("[class='"+product_id+"add']");
                        for (i = 0; i < x.length; i++) {
                            x[i].classList.add("red-text");
                            x[i].textContent = data.btn_message;
                        }
                    }

                }
            });
            cart_count();
          //  cart_count_mobile();
        });

        $(document).on('click','.buy_now',function(){
            var action = "add";
            var product_id = $(this).attr("id");
            var user_id = '<?php if(isset($_SESSION['rushabh_novelty_user'])) {echo $_SESSION['rushabh_novelty_user'];}else{echo 0;} ?>';
            $.ajax({
                url:"add_to_cart.php",
                method:"POST",
                data:{action:action,user_id:user_id,product_id:product_id},
                dataType: 'json',
                success:function(data){
                    if(data.error == true){
                        var x, i;
                        x = document.querySelectorAll(".add"+product_id);
                        for (i = 0; i < x.length; i++) {
                            x[i].classList.add("red-text");
                            x[i].textContent = data.btn_message;
                        }
                    }else{
                    document.location.href = "product_cart.php";
                    }
                }
            });
            cart_count();
            //cart_count_mobile();
        });

        $(document).on('click','.cust-tab',function(){
            preloader.style.display = 'block';
            var category_id = $(this).attr("id");
            $.ajax({
                url:"product_category_body.php",
                method:"POST",
                data:{category_id:category_id},
                success:function name(data) {
                    var home='no';
                    preloader.style.display = 'none';
                   if(home==data){
                       document.location.href = "index.php";
                   }else{
                    $('#show_category_body').html(data);
                   }
                }
            });
        });

        var $li = $('#desk-tab li').click(function() {
            $li.removeClass('selected');
            $(this).addClass('selected');
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

    </script>
</body>

</html>