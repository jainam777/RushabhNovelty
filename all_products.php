<?php include 'components/session.php';?>
<!DOCTYPE html>
<html lang="en">
<?php 
    if(!isset($_SESSION['rushabh_novelty_user'])){
        $_SESSION['rushabh_novelty_login_error']="Login to view more products";
        ?>
        
         <script> location.replace("login.php"); </script>
        <?php
        exit();
    }else{
        
        if(isset($_GET['category']) && isset($_GET['subcategory'])){ 
            $category=$_GET['category'];
    ?>

<?php include 'components/header.php'; ?>
<link rel="stylesheet" href="styles/all_products.css">
<body onload="loadingGif()">

    <div id="loading">
    </div>
    <header>
        <?php include 'components/nav-page.php'; ?>
        <nav class="webtabcolor">
            <div class="nav-wrapper webcontainer">
                <div class="col s12 m12 l12">
                    <a href="index.php#home" class="breadcrumb webtextcolor"><b>Home</b></a>
                    <?php
                    echo'
                        <a href="index.php#'.$link=str_replace(' ','',$_GET['category']).'" class="breadcrumb webtextcolor"><b>'.$_GET['category'].'</b></a>
                        <a href="all_products.php?category='.$_GET['category'].'&subcategory='.$_GET['subcategory'].'" class="breadcrumb webtextcolor"><b>'.$_GET['subcategory'].'</b></a>';
                    ?>
                </div>
            </div>
        </nav>
    </header>
    <br>
    <div class="webcontainer">
        <div class="row">
            <div class="col s12 m12 l12" style="padding-bottom:5px;">
                <div class="center">
                    <?php echo '<h3 style="text-transform: uppercase;">'.$_GET['subcategory'].'</h3>'; ?>
                    <div class="divider"></div>
                </div>
                <br>
                <div class="hide-on-med-and-down" style="padding-top:5px;">
                    
                    <div class="left">
                          <h5>Filter Products</h5>
                    </div>

                    <div class="input-field right">
                        <select id="sort" class="common_selector">
                            <option value="" disabled selected>Choose your option</option>
                            <option value="high">Price: High to Low</option>
                            <option value="low">Price: Low to High</option>
                            <!-- <option value="new">New Arrived</option> -->
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
                            <input type="hidden" id="hidden_minimum_price_mobile" value="1" />
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
                                <!-- <option value="new">New Arrived</option> -->
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
                    <input type="hidden" id="hidden_minimum_price" value="1" />
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

            </div>
            <div id="show_btn">
                
            </div>
            <div id="show_mobile_btn">
                
            </div>
            </div>
        </div>
    </div>
    <style>
        #loadinggif
        {
        text-align:center; 
        background: url('loading_gif.gif') no-repeat center; 
        height: 150px;
        }
        </style>
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

        var start = 0;
        var end = 9;
        
        var sort_by = '';
        $('#sort').change(function(){

            $('#show_products').html("");
            var sort_by = $(this).val();
            var cat = '<?php echo $category; ?>';
            var sub = '<?php echo $_GET['subcategory']; ?>';
            start = 0;
            $.ajax({
                url:"fetch_data.php",
                method:"POST",
                data:{sort_by:sort_by,category:cat,subcategory:sub,start:start,end:end},
                success:function(data){
                     $('#show_products').append(data);
                }
            });
             filter_products(start,end);
        });

        var sort = '';
        $('#sortmobile').change(function(){
            $('#show_products').html("");
            $('#show_btn').html("");
            var action = 'fetch_data';
            var sort_by = $(this).val();
            var cat = '<?php echo $category; ?>';
            var sub = '<?php echo $_GET['subcategory']; ?>';
            start = 0;
            $.ajax({
                url:"fetch_data.php",
                method:"POST",
                data:{action:action,sort_by:sort_by,category:cat,subcategory:sub,start:start,end:end},
                success:function(data){
                
                    // $('#show_products').append(data);
                    
                }
            });
            
             filter_products_mobile(start,end);
        });

        filter_products(start,end);

        function filter_products(start,end){
            $('.show_products').html('<div id="loadinggif" style=""></div>');
            var action = 'fetch_data';
            var minimum_price = $('#hidden_minimum_price').val();
            var maximum_price = $('#hidden_maximum_price').val();
            var sort_by = $("#sort").val();
            var start = start;
            var end = end;
            var cat = '<?php echo $category; ?>';
            var sub = '<?php echo $_GET['subcategory']; ?>';
            $.ajax({
                url:"fetch_data.php",
                method:"POST",
                data:{action:action,minimum_price:minimum_price, maximum_price:maximum_price,sort_by:sort_by,category:cat,subcategory:sub,start:start,end:end},
                success:function(data){
                    // $('#show_products').append(data);
                    if(data === "<h3>No Products</h3>"){
                        $('#show_btn').html("");
                    }else{
                        $('#show_products').append(data);
                        $('#show_btn').html('<button class="btn max-btn">Load more products</button>');
                    }

                }
            });
        }

        $('#show_btn').click(function(){
            start = start+end;
            filter_products(start,end);
        });

        $('#show_mobile_btn').click(function(){
            start = start+end;
            filter_products_mobile(start,end);
        });

        function filter_products_mobile(start,end){
            $('.show_products').html('<div id="loadinggif" style=""></div>');
            var action = 'fetch_data';
            var minimum_price = $('#hidden_minimum_price_mobile').val();
            var maximum_price = $('#hidden_maximum_price_mobile').val();
            var sort_by = $("#sortmobile").val();
            var start = start;
            var end = end;
            var cat = '<?php echo $category; ?>';
            var sub = '<?php echo $_GET['subcategory']; ?>';
            $.ajax({
                url:"fetch_data.php",
                method:"POST",
                data:{action:action,minimum_price:minimum_price, maximum_price:maximum_price,sort_by:sort_by,category:cat,subcategory:sub,start:start,end:end},
                success:function(data){
                    // $('#show_products').append(data);
                    if(data === "<h3>No Products</h3>"){
                        $('#show_mobile_btn').html("");
                    }else{
                        $('#show_products').append(data);
                        $('#show_mobile_btn').html('<button class="btn max-btn hide-on-large-only" >Load more products</button>');
                    }
                }
            });
        }

        function get_filter(class_name){
            var filter = [];
            $('.'+class_name+':checked').each(function(){
                filter.push($(this).val());
            });
            // console.log(filter);
            return filter;
        }

        $('.common_selector').click(function(){
            // console.log("hello");
            filter_products();
            
        });

        $( "#slider-range" ).slider({
        range: true,
        min: 1,
        max: 10000,
        values: [ 1, 10000 ],
        slide: function( event, ui ) {
            $( "#amount" ).val( "₹" + ui.values[ 0 ] + " - ₹" + ui.values[ 1 ] );
        },
         stop:function(event, ui){
              $('#show_products').html("");
              start=0;
              $( "#amount" ).val( "₹" + ui.values[ 0 ] + " - ₹" + ui.values[ 1 ] );
              $('#hidden_minimum_price').val(ui.values[0]);
              $('#hidden_maximum_price').val(ui.values[1]);
              filter_products(start,end);
        }
        });
        $( "#amount" ).val( "₹" + $( "#slider-range" ).slider( "values", 0 ) +
        " - ₹" + $( "#slider-range" ).slider( "values", 1 ) );

        $( "#slider-range_mobile" ).slider({
        range: true,
        min: 1,
        max: 10000,
        values: [ 1, 10000 ],
        slide: function( event, ui ) {
            $( "#amount_mobile" ).val( "₹" + ui.values[ 0 ] + " - ₹" + ui.values[ 1 ] );
        },
        stop:function(event, ui){
            $('#show_btn').html("");
              $('#show_products').html("");
              start=0;
              $( "#amount_mobile" ).val( "₹" + ui.values[ 0 ] + " - ₹" + ui.values[ 1 ] );
              $('#hidden_minimum_price_mobile').val(ui.values[0]);
              $('#hidden_maximum_price_mobile').val(ui.values[1]);
              filter_products_mobile(start,end);
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
<?php }
        else{
            header("Location:index.php");
        }
  
    }
?>
</html>