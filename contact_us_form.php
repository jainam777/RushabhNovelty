<?php include 'components/session.php';?>
<!DOCTYPE html>
<html lang="en">

<?php include 'components/header.php'; ?>
<body onload="loadingGif()">

    <div id="loading"></div>
    <header>
    <?php include 'components/nav-page.php'; ?>
    </header>

    <script defer src="scripts/contact.js"></script>
<div class="row container section scrollspy" id="contact_us">
    <a name="contact_us">
        <div class="col s12 m12 l12 center">
            <h3><span>Contact us</span></h3>
            <div class="divider"></div>
        </div>
        <div class="col s12 m5 l6">
            <h3>Have a query?</h3>
            <h4>Following are the ways to contact us</h4>
            <p>
                <span><i class="material-icons left">email</i>Email: contact@rushabhnovelty.com</span>
            </p>
            <p><span><i class="material-icons left">phone</i>Phone Number: 022-23434531/+91 9029292869</span></p>
            <p>
                <span><i class="material-icons left">location_on</i>Address:<br><br>
                        <span class="hide-on-small-only" style="text-align:justify;">
                        Rushabh novelty, 
                        118 Sarang street Gr floor, <br> 
                        Near sadanand hotel,
                        opp crowford market,<br>  
                        Mumbai-3. 
                        </span>
                        <span class="hide-on-med-and-up" style="text-align:justify;">
                        Rushabh novelty, 
                        118 Sarang street Gr floor,
                        Near sadanand hotel,
                        opp crowford market,
                        Mumbai-3. 
                        </span>
                </span>
            </p>
        </div>
        <div class="col s12 m5 l6 offset-m2">
            <h3 class="center">Get In Touch With Us</h3>
            <form action="save_user_query.php" method="POST" id="contact_form" onsubmit="return validateContactForm()">

                <div class="input-field">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="user_name" type="text" name="customer_name" class="validate" required>
                    <label class="active" for="user_name">Name</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">email</i>
                    <input id="user_email" type="email" name="email" class="validate" required>
                    <label class="active" for="user_email">Email</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">phone</i>
                    <input id="user_phone" type="text" name="mobile" class="validate" required>
                    <label class="active" for="user_phone">Mobile Number</label>
                </div>
                <div class="input-field">
                    <select required name="query">
                    <option value="" disabled selected>Choose your option</option>
                    <option value="Complaint">Complaint</option>
                    <option value="Query">Query</option>
                    <option value="Other">Other</option>
                    </select>
                    <label>Reason to contact us</label>
                </div>
                <div class="input-field">
                    <textarea id="icon_prefix2" id="textarea_message" name="message" class="materialize-textarea" required></textarea>
                    <label class="active" for="icon_prefix2">Your Message</label>
                </div>
                <input type="hidden" name="contact_page" value="contact">
                <div class="center">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                    </button>
                </div>
            </form>
        </div>
        <div class="s12 m12 l12 center">
            <?php
                if(isset($_SESSION['rushabh_novelty_f_error'])){
                    echo '
                        <div>
                            <p class="red-text">'.$_SESSION['rushabh_novelty_f_error'].'</p>
                        </div>
                    ';
                    unset($_SESSION['rushabh_novelty_f_error']);
                }
                if(isset($_SESSION['rushabh_novelty_f_success'])){
                    echo '
                        <div >
                            <p class="green-text" style="font-size:1.3em;">'.$_SESSION['rushabh_novelty_f_success'].'</p>
                        </div>
                    ';
                    unset($_SESSION['rushabh_novelty_f_success']);
                }
            ?>
        </div>
        <div class="s12 m12 l12 center">
                <p id="error_message" class="red-text" style="font-size:1.3em;"></p>
        </div>
    </a>
</div>



    <?php include 'components/footer.php'; ?>
    <?php include 'components/script.php'; ?>
    <?php include 'scripts/nav_script.php'; ?>

    <script>

        var preloader = document.getElementById('loading');

        function loadingGif(){
            preloader.style.display = 'none';
        }
        function cart_count(){
            var user_id = '<?php if(isset($_SESSION['rushabh_novelty_user'])) {echo $_SESSION['rushabh_novelty_user'];}else{echo 0;} ?>';
            $.ajax({
                url:"show_cart_count.php",
                method:"POST",
                data:{user_id:user_id},
                success:function(data){
                    $('#show_count').html(data);
                }
            });            
        }

    </script>
</body>
</html>