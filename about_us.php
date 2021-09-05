<?php include 'components/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'components/header.php'; ?>
<body onload="loadingGif()">
    <div id="loading"></div>
    
    <header>
        <?php include 'components/nav-page.php'; ?>
    </header>

    <div class="webcontainer">
        <div class="container center">
            <h1>ABOUT US</h1>
        </div>
        <div class="divider"></div>
        <div>
            <div class="center">
                <img src="images/about_us_logo.jpg" alt="Rushabh Novelty Logo" class="responsive-image" width="350" height="250">
            </div>

            <p>Rushabh Novelty is a trusted brand for stationery supply since the past 25 years. We have a variety of fancy and unique stationery, suiting all occasions and events. We have items for all age groups, with a range of colours and prints in each product.</p>

            <p>Over the years, we have made long-term relationships with over 1500 - 2000 different customers who have entrusted us with our product supplies year after year. </>

            <p>Our products are rich in quality, attractive, and functional in use. From school stationery kits to fancy decorative art kits, we have it all. We keep updating our products according to the trend and are finely chosen by us personally. We offer a great value to our clients and look forward to build a long-term relationship with you too.</>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>
    <?php include 'components/script.php'; ?>
    <?php include 'scripts/nav_script.php'; ?>
    <script>
        var preloader = document.getElementById('loading');

        function loadingGif(){
            preloader.style.display = 'none';
        }
    </script>
</body>
</html>