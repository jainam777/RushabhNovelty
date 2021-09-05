<?php include 'components/session.php';?>
<!DOCTYPE html>
<html lang="en">
<?php if(isset($_POST['searchbox'])){ 
        if(!empty($_POST['searchbox'])){
            // if(!isset($_SESSION['rushabh_novelty_user'])){

            // }
    ?>

<?php include 'components/header.php'; ?>
<link rel="stylesheet" href="styles/all_products.css">
<body onload="loadingGif()">
    <div id="loading"></div>
    <header>
    <?php include 'components/nav-page.php'; ?>
    </header>
    <br>
    <div class="webcontainer">
        <div class="row">
            <div class="col s12 m12 l12" style="padding-bottom:5px;">
                <div class="center">
                    <?php echo '<h3 style="text-transform: uppercase;">'.$_POST['searchbox'].'</h3>'; ?>
                    <div class="divider"></div>
                </div>
                <br>
                <?php
                    $con = $pdo->open();
                    $stmt = $con->prepare("SELECT count(*) as total_rows from products where product_name LIKE :pro_name");
                    $stmt->execute(['pro_name' => '%'.$_POST['searchbox'].'%']);
                    $result = $stmt->fetch();
                    if($result['total_rows']>0){
                ?>
                <div class="hide-on-med-and-down" style="padding-top:5px;">
                    
                    <div class="left">
                          <h5>Filter Products</h5>
                    </div>

                    <div class="input-field right">
                        <select id="sort" class="common_selector">
                            <option value="" disabled selected>Choose your option</option>
                            <option value="high">Price: High to Low</option>
                            <option value="low">Price: Low to High</option>
                            <option value="new">New Arrived</option>
                        </select>
                        <label>Sort By</label>
                    </div>
                </div>
                <div class="row hide-on-large-only">
                    
                    <div class="col s6 m6">
                        <form action="#" method="post">
                        <ul id="slide-out" class="sidenav" style="padding-left:10px; padding-right:10px;">
                           <li> 
                               <!-- <p>Price Range</p> -->
                            Price Range
                            <input type="hidden" id="hidden_minimum_price_mobile" value="0" />
                            <input type="hidden" id="hidden_maximum_price_mobile" value="10000" />
                            <div class="center"><input type="text" id="amount_mobile" readonly style="border:0; color:#f6931f; font-weight:bold; margin: 0px 0 0px 0;"></div>
                            <div id="slider-range_mobile"></div>
                            <!-- </p> -->
                            <br>
                            </li>
    
                        <li><div class="divider"></div></li>
    
                    </form>
                        </ul>
                        <a href="#" data-target="slide-out" class="sidenav-trigger btn-small white black-text"><i class="fa fa-filter" aria-hidden="true"></i> Filter</a>
                    </div>
                    <div class="col s6 m6">
                        <div class="input-field right">
                            <select id="sortmobile" class="common_selector">
                                <option value="" disabled selected><i class="fa fa-sort-amount-desc left" aria-hidden="true"></i>Sort By</option>
                                <option value="high">Price: High - Low</option>
                                <option value="low">Price: Low - High</option>
                                <option value="new">New Arrived</option>
                            </select>
                            <!-- <label>Sort By</label> -->
                        </div>
                    </div>
                </div>
                <div class="col s12 m12 l12">
                    <div class="divider"></div>
                </div>
            </div>
            <div class="col m2 l2 hide-on-med-and-down">
                <form action="#" method="post">
                    Price Range
                    <input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="10000" />
                    <div class="center"><input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold; margin: 0px 0 0px 0;"></div>
                    <div id="slider-range"></div>
                    <!-- </p> -->
                    <br>
                    <div class="divider black"></div>
                   

                </form>
            </div>

            <div class="col s12 m12 l10">
            <div class="row" id="show_products">

                <?php 
                    $output = '';
                    $con=$pdo->open();
                    try{

                        $stmt = $con->prepare("SELECT products.product_id, products.stock, products.product_name, products.product_description, products.product_price, category.category_name, subcategory.subcategory_name, product_photos.pic1 from products, category, subcategory, product_photos WHERE products.category_id = category.catergory_id and products.subcategoty_id = subcategory.subcategory_id and products.product_id = product_photos.product_id and products.product_name LIKE :pro_name");
                        $stmt->execute(['pro_name' => '%'.$_POST['searchbox'].'%']);
                        // $val = $stmt->fetch();
                        // $pro_id = $val['product_id'];
                        foreach($stmt as $rows){
                            $output .= '
                                <div class="col s12 m6 l4">
                                    <div class="card">
                                        <a href="product_details.php?category='.$rows['category_name'].'&&id='.$rows['product_id'].'">
                                            <div class="card-image">
                                                <img class="hide-on-med-and-down" src="images/product_images/'.$row['pic1'].'" style="border: 1px solid black" width="280px" height="400px">
                                                <img class="hide-on-large-only" src="images/product_images/'.$row['pic1'].'" style="border: 1px solid black" width="180px" height="300px">
                                            </div>
                                            <div class="card-content black-text">
                                                <span class="card-title truncate">'.$rows['product_name'].'</span>
                                                <p class="truncate">'.$rows['product_description'].'</p>
                                                
                                            </div>
                                        </a>
                                        <div class="card-action">';
                                        // if($rows['stock']>0){
                                        $output .='
                                            <a class="add_to_cart waves-effect waves-orange btn-flat add'.$rows['product_id'].'" style="margin-right: 0px;padding-left: 5px;padding-right: 5px;" type="submit" id="'.$rows['product_id'].'">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart</a>
                                            <a class="buy_now buy-button-margin waves-effect waves-orange btn-flat" style="margin-right: 0px;padding-left: 8px;padding-right: 8px;" type="submit" id="'.$rows['product_id'].'">Buy Now</a>';
                                        // }else{
                                        //     $output .='<p class="center red-text" style="margin-top: 7px;margin-bottom: 7px;">OUT OF STOCK</p>';
                                        // }
                                        $output .='
                                            
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                    }
                    catch(PDOException $e){
                        echo "There is some problem in the connection" .$e->getMessage();
                    }
                ?>
                <?php echo $output; ?>
            </div>
            <?php 
                }
                else{
                echo'
                   <div class="webcontainer center" style="height:260px;">
                   <h2>'.$_POST['searchbox'].' is not available</h2>
                   </div>

                   <script>
                   var preloader = document.getElementById("loading");

                   function loadingGif(){
                       preloader.style.display = "none";
                   }
                   </script>
                   ';

                }
            ?>
            
            </div>
        </div>
    </div>
    <?php include 'components/footer.php'; ?>
    <?php include 'components/script.php'; ?>
    <?php include 'scripts/nav_script.php'; ?>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    var preloader = document.getElementById('loading');

    function loadingGif(){
        preloader.style.display = 'none';
    }

    $(document).ready(function(){

        var sort_by = '';
        $('#sort').change(function(){
            var sort_by = $(this).val();
            var cat = '<?php echo $rows['category_name'] ?>';
            var sub = '<?php echo $rows['subcategory_name'] ?>';
            // var cat = 'Living Room';
            // var sub = 'Sofa Sets';
            $.ajax({
                url:"fetch_data.php",
                method:"POST",
                data:{sort_by:sort_by,category:cat,subcategory:sub},
                success:function(data){
                    $('#show_products').html(data);
                }
            });
            filter_products();
        });

        var sort = '';
        $('#sortmobile').change(function(){
            var action = 'fetch_data';
            var sort_by = $(this).val();
            var cat = '<?php echo $rows['category_name'] ?>';
            var sub = '<?php echo $rows['subcategory_name'] ?>';
            // var cat = 'Living Room';
            // var sub = 'Sofa Sets';
            $.ajax({
                url:"fetch_data.php",
                method:"POST",
                data:{action:action,sort_by:sort_by,category:cat,subcategory:sub},
                success:function(data){
                    $('#show_products').html(data);
                }
            });
            
            filter_products_mobile();
        });

        filter_products();

        function filter_products(){
            var action = 'search';
            var pro_name='<?php echo $_POST['searchbox'] ?>';
            var minimum_price = $('#hidden_minimum_price').val();
            var maximum_price = $('#hidden_maximum_price').val();
            // var pro_type = get_filter('pro_type');
            // var pro_material = get_filter('pro_material');
            var sort_by = $("#sort").val();
            console.log("check: "+sort_by);
            console.log("max:"+maximum_price);
            //var sort_by = 'low';
            var cat = '<?php echo $rows['category_name'] ?>';
            var sub = '<?php echo $rows['subcategory_name'] ?>';
            $.ajax({
                url:"fetch_data.php",
                method:"POST",
                data:{action:action,pro_name:pro_name,minimum_price:minimum_price, maximum_price:maximum_price,sort_by:sort_by,category:cat,subcategory:sub},
                success:function(data){
                    $('#show_products').html(data);
                }
            });
        }

        function filter_products_mobile(){
            var action = 'search';
            var pro_name='<?php echo $_POST['searchbox'] ?>';
            var minimum_price = $('#hidden_minimum_price_mobile').val();
            var maximum_price = $('#hidden_maximum_price_mobile').val();
            var pro_type = get_filter('pro_type');
            var pro_material = get_filter('pro_material');
            var sort_by = $("#sortmobile").val();
            console.log("check: "+sort_by);
            //var sort_by = 'low';
            var cat = '<?php echo $rows['category_name'] ?>';
            var sub = '<?php echo $rows['subcategory_name'] ?>';
            $.ajax({
                url:"fetch_data.php",
                method:"POST",
                data:{action:action,pro_name:pro_name,minimum_price:minimum_price, maximum_price:maximum_price,sort_by:sort_by,category:cat,subcategory:sub},
                success:function(data){
                    $('#show_products').html(data);
                }
            });
        }

        function get_filter(class_name){
            var filter = [];
            $('.'+class_name+':checked').each(function(){
                filter.push($(this).val());
            });
            console.log(filter);
            return filter;
        }

        $('.common_selector').click(function(){
            console.log("hello");
            filter_products();
            
        });

        $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 10000,
        values: [ 0, 10000 ],
        slide: function( event, ui ) {
            $( "#amount" ).val( "₹" + ui.values[ 0 ] + " - ₹" + ui.values[ 1 ] );
        },
         stop:function(event, ui){
              $( "#amount" ).val( "₹" + ui.values[ 0 ] + " - ₹" + ui.values[ 1 ] );
              $('#hidden_minimum_price').val(ui.values[0]);
              $('#hidden_maximum_price').val(ui.values[1]);
              filter_products();
        }
        });
        $( "#amount" ).val( "₹" + $( "#slider-range" ).slider( "values", 0 ) +
        " - ₹" + $( "#slider-range" ).slider( "values", 1 ) );

        $( "#slider-range_mobile" ).slider({
        range: true,
        min: 0,
        max: 10000,
        values: [ 0, 10000 ],
        slide: function( event, ui ) {
            $( "#amount_mobile" ).val( "₹" + ui.values[ 0 ] + " - ₹" + ui.values[ 1 ] );
        },
        stop:function(event, ui){
              $( "#amount_mobile" ).val( "₹" + ui.values[ 0 ] + " - ₹" + ui.values[ 1 ] );
              $('#hidden_minimum_price_mobile').val(ui.values[0]);
              $('#hidden_maximum_price_mobile').val(ui.values[1]);
              filter_products_mobile();
        }
        });
        $( "#amount_mobile" ).val( "₹" + $( "#slider-range_mobile" ).slider( "values", 0 ) +
        " - ₹" + $( "#slider-range_mobile" ).slider( "values", 1 ) );

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
                        document.getElementById(product_id).classList.add("green-text");
                        document.getElementById(product_id).textContent=data.btn_message;
                    }
                    else{
                        document.getElementById(product_id).classList.add("red-text");
                        document.getElementById(product_id).textContent=data.btn_message;
                    }
                }
            });
            cart_count();
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

    });
</script>


</body>
    <?php
        }
        else{
            header("location: index.php");
        }
    }
    ?>
</html>
