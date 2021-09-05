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
    <br>
    <!-- home tab -->
    <div id="show_category_body">
        <?php include 'home.php'; ?>
    </div>

     <!-- End of home div -->
    
    
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

        // $(document).on('click','.cust-tab',function(){
        //     preloader.style.display = 'block';
        //     var category_id = $(this).attr("id");
        //     $.ajax({
        //         url:"product_category_body.php",
        //         method:"POST",
        //         data:{category_id:category_id},
        //         success:function name(data) {
        //             var home='no';
        //             preloader.style.display = 'none';
        //            if(home==data){
        //                document.location.href = "index.php";
        //            }else{
        //             $('#show_category_body').html(data);
        //            }
        //         }
        //     });
        // });

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