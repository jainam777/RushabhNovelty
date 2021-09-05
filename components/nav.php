<!DOCTYPE html>
<nav class="nav-wrapper webcolor nav-height nav-padding">
    <div>
    <!-- <i class="material-icons left">weekend</i>Running Horse Furniture  style="height:80px;"-->
        <a href="index.php" class="brand-logo nav-hide hide-on-med-and-down"><img src="images/logo.jpeg" height="75"><span class="webcolor-text">RUSHABH NOVELTY</span></a>
        <a href="index.php" class="brand-logo hide-on-med-and-down"><img src="images/logo.jpeg" height="75"></a>
        <a href="index.php" class="brand-logo hide-on-large-only"><img src="images/logo.jpeg" height="45"></a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger">
            <i class="material-icons webtextcolor">menu</i>
        </a>
        <ul class="right hide-on-med-and-down">
            <li>
                <a href="index.php" class="webtextcolor"><b>Home</b></a>
            </li>
            <li>
                <a href="contact_us_form.php" class="webtextcolor"><b>Contact Us</b></a>
            </li>
            <li>
                <a href="about_us.php" class="webtextcolor"><b>About Us</b></a>
            </li>
            <li>

                <?php
                    if(isset($_SESSION['rushabh_novelty_user'])){
                        $con = $pdo->open();
                        $stmt = $con->prepare("SELECT name from users where user_id=:id");
                        $stmt->execute(['id'=>$_SESSION['rushabh_novelty_user']]);
                        $row = $stmt->fetch();
                        echo'<a id="show-dropdown" href="user_profile.php"><span class="webtextcolor"><b>'.$row['name'].'</b></span><i class="material-icons webtextcolor right logo">account_circle</i></a>';
                    }else{
                        echo'<a href="login.php"><span class="webtextcolor"><b>Login</b></span><i class="material-icons webtextcolor right logo">account_circle</i></a>';
                    }
                ?>
            </li>
            <li>    
                <?php
                    if(isset($_SESSION['rushabh_novelty_user'])){
                        $con = $pdo->open();
                        $stmt = $con->prepare("SELECT count(*) as cart from user_cart where user_id=:id");
                        $stmt->execute(['id'=>$_SESSION['rushabh_novelty_user']]);
                        $rows = $stmt->fetch();
                        $count=$rows['cart'];
                        echo'
                            <span id="show_count" class="badge webtextcolor" style="margin-left: 0px; margin-right: 5px;">'.$count.'</span>
                            <a href="product_cart.php"><i class="material-icons webtextcolor logo">shopping_cart</i></a>
                        ';
                    }else{
                        echo'<a href="product_cart.php"><i class="material-icons webtextcolor logo">shopping_cart</i></a>';
                    }
                    $pdo->close();
                ?>
            </li>
            <li>          
                <form action="product_search.php" method="POST">
                    <ul>
                        <li>
                            <!-- searchcss -->
                            <div class="input-field">
                                <input class="webtextcolor" name="searchbox" id="searchnav" style="border-bottom: 1px solid #444444; padding-left: 8px;" type="text" placeholder="search your product" required>
                            </div>
                            
                        </li>
                        <li>
                            <button class="waves-effect waves-teal btn-flat" name="search_button" type="submit"><i class="material-icons webtextcolor logo" style="color:white;top: auto;bottom: 10px;">search</i>
                            </button>
                            
                        </li>
                    </ul>
                </form>
            </li>
        </ul>
        <ul class="hide-on-large-only right">            
            <li>
            <?php
                    if(isset($_SESSION['rushabh_novelty_user'])){
                        $con = $pdo->open();
                        $stmt = $con->prepare("SELECT count(*) as cart from user_cart where user_id=:id");
                        $stmt->execute(['id'=>$_SESSION['rushabh_novelty_user']]);
                        $rows = $stmt->fetch();
                        $count=$rows['cart'];
                        
                        ?>
                            <span id="show_count_mobile" class="badge webtextcolor" style="margin-left: 0px; margin-right: 5px;"><?php echo $count ?></span>
                            <a href="product_cart.php"><i class="material-icons webtextcolor">shopping_cart</i></a>
                        <?php
                        
                    }else{
                        ?>
                        <a href="product_cart.php"><i class="material-icons webtextcolor">shopping_cart</i></a>
                        <?php
                    }
                    $pdo->close();
                ?>
            </li>

            <li>
                <a href="#" id="show"><i class="material-icons webtextcolor">search</i></a>
            </li>
        </ul>
    </div>
</nav>

<nav class="menu" style="display: none;">
    <div class="nav-wrapper center white">
        <form action="product_search.php" method="POST" class="row center">
            <div class="input-field center col s12 l12">
                <input name="searchbox" id="searchnav1" type="search" placeholder="search your product" required>
                <label class="label-icon" for="search"><i class="material-icons black-text">search</i></label>
                <i class="material-icons">close</i>
            </div>
        </form>
    </div>
</nav>

<div class="webtabcolor">
    <div class="center webtabcolor" id="desk-tab">
        <ul class="cust-tabs cust-tabs-fixed-width cust-tab-demo z-depth-2 webtabcolor">
            <li class="cust-tab webtextcolor" id="home">
                <a href="index.php"><b><span class="webtextcolor">Home</span></b></a>
            </li>
            <?php
                $navCategory = array();
                $navCategoryLive = array();
                $con = $pdo->open();
                try{
                    $stmt = $con->prepare("SELECT * FROM category");
                    $stmt->execute();
                    foreach($stmt as $row){
                        echo'
                        <li class="cust-tab">
                        <a href="category.php?category='.$link=$row['category_name'].'"><b><span class="webtextcolor">'.$row["category_name"].'</span></b></a>
                    </li>
                        ';
                        $navCategory[] = str_replace(' ','',$row['category_name']);
                        $navCategoryLive[] = $row['category_name'];
                    }
                }
                catch(PDOException $e){
                    echo "There is some problem in connection" .$e->getMessage();
                }

            ?>
        </ul>
    </div>
</div>

<ul class="sidenav" id="mobile-demo">
    <li class="webtextcolor">
        <p class="white-text center" style="margin-top:0px;margin-bottom:5px; padding-left:5px;">
            <a href="index.php"><img src="images/logo_mobile.jpg" height="70"></a>
        </p>
    </li>

    <li>
        <?php
            if(isset($_SESSION['rushabh_novelty_user'])){
                $con = $pdo->open();
                $stmt = $con->prepare("SELECT name from users where user_id=:id");
                $stmt->execute(['id'=>$_SESSION['rushabh_novelty_user']]);
                $row = $stmt->fetch();
                echo'<a href="user_profile.php"><span>'.$row['name'].'</span><i class="material-icons grey-text text-darken-2 right" style="margin-left:0px;margin-right:0px;">account_circle</i></a>';
            }else{
                ?>
                <a href="login.php"><i class="material-icons grey-text text-darken-2 right" style="margin-left:0px;margin-right:0px;">account_circle</i><span>Login</span></a>
                <?php
            }
        ?>
    </li>
    <li>
        <a href="user_orders.php">My Orders</a>
    </li>
    <li>
        <a href="product_cart.php">My Cart</a>
    </li>
    <li>
        <div class="divider" style="color:#263238;"></div>
    </li>
    <li>
        <a href="about_us.php">About Us</a>
    </li>
    <li>
        <a href="contact_us_form.php">Contact Us</a>
    </li>
    <li>
        <div class="divider" style="color:#263238;"></div>
    </li>
    <?php if(isset($_SESSION['rushabh_novelty_user'])){ ?>
    <li>
        <a href='logout.php'>Logout<i class="material-icons grey-text text-darken-2 right" style="margin-left:0px;margin-right:0px;">login</i></a>
    </li>
    <li>
        <div class="divider" style="color:#263238;"></div>
    </li>
    <?php 
        }
    ?>
</ul>
<script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0,val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } 
    //   else if (e.keyCode == 13) {
    //     /*If the ENTER key is pressed, prevent the form from being submitted,*/
    //     e.preventDefault();
    //     if (currentFocus > -1) {
    //       /*and simulate a click on the "active" item:*/
    //       if (x) x[currentFocus].click();
    //     }
    //   }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var countries = [
"ZIPPER",
"11X15 BRIGHT THICK TINTED PAPER",
"11X15 CARTRIDGE DRAWING PAPER THICK",
"11X15 T.K PAPER EXTRA THICK",
"123 GOLD FOIL BALLOON",
"123 SILVER FOIL BALLOON",
"2 TON WOODEN BOUNDARY",
"6 PCS GLITTER FEATHER",
"6IN1 SCISSOR LOL",
"821 PUNCH",
"822 PUNCH",
"823 PUNCH",
"828 PUNCH",
"829 PUNCH",
"833 BUTTERFLY EYE SHADOW NAIL SET",
"8805 PUNCH",
"99XXL PUNCH",
"9PC STAR CAKE TOPPER",
"A3 BUBBLE PAPER",
"A3 CANVAS TEXTURE MOUNT BOARD",
"A3 CHEX DRAWING TEXTURE PAPER",
"A3 CORAL TEXTURE MOUNT BOARD PAPER",
"A3 COTTON LILAC DRAWING TEXTURE PAPER",
"A3 DECKLEEDGE DRAWING PAPER",
"A3 DRAWING TEXTURE PAPER CANVAS",
"A3 DRAWING TEXTURE PAPER CARD CORAL",
"A3 FIBER NATURAL TILLA PAPER",
"A3 FOAM PAPER SINGLE COLOUR",
"A3 GLITTER FOAM PAPER SINGLE COLOUR",
"A3 GLITTER MULTI FOAM PAPER",
"A3 GOLDEN SHINING CARD PAPER",
"A3 HAND MARBAL PRINT HANDMADE PAPER",
"A3 IVORY CARD PAPER",
"A3 JET BLACK CARDSTOCK PAPER",
"A3 KRAFT BOARD",
"A3 N0020W WATER COLOR PAD",
"A3 NEW BRIGHT TINTED COLOUR PAPER",
"A3 ORIGINAL FINE LINE TEXTURE CARD PAPER",
"A3 RAYMOND TEXTURE MOUNT BOARD",
"A3 ROUGH DRAWING PAPER",
"A3 SILVER SHINING CARD PAPER",
"A3 SKETCHING PAPER",
"A3 SPOTTY SILVER TEXTURE CARD PAPER",
"A3 SUPERIOR TEXTURE CARD PAPER",
"A3 TEXTURE CARD STOCK PAPER",
"A3 TEXTURE WATER DRAWING CARD SHEETS",
"A3 WATER COLOUR DRAWING CARD PAPER",
"A4 3D PLASTIC SHEET PAPER",
"A4 BRIGHT COLOUR CARD PAPER",
"A4 BRIGHT COLOUR RULED CARD PAPER",
"A4 BRIGHT FLOWER PRINT CARD SHEET PAPER",
"A4 BRIGHT TINTED CARD PAPER",
"A4 BUBBLE PAPER",
"A4 CANVAS TEXTURE DRAWING CARD PAPER",
"A4 CARTRIDGE DRAWING PAPER EXTRA THICK",
"A4 CHEX DRAWING TEXTURE PAPER",
"A4 CORAL DRAWING TEXTURE PAPER",
"A4 CORAL TEXTURE MOUNT BOARD PAPER",
"A4 CORROGATED GOLD PAPER",
"A4 COTTON LILAC DRAWING TEXTURE PAPER",
"A4 CREATED PAPER",
"A4 DECKLEEDGE DRAWING PAPER",
"A4 DESIGNER GOLD PAPER",
"A4 DRAWING TEXTURE PAPER CANVAS",
"A4 EMBOSS FOAM PAPER",
"A4 ENO GREETING CORROGATED PAPER",
"A4 FELT PAPER",
"A4 FIBRE NATURAL TILLA PAPER",
"A4 FLOWER HAND MADE PRINTED CARD PAPER",
"A4 FLOWER TEXTURE HANDMADE CARD PAPER",
"A4 FOAM PAPER SINGLE COLOUR",
"A4 GLITTER CORROGATED PAPER",
"A4 GLITTER FOAM PAPER SINGLE COLOUR",
"A4 GLITTER SAND CARD PAPER",
"A4 GOLDEN SHINING CARD PAPER",
"A4 JET BLACK CARD STOCK PAPER",
"A4 KHADI LINEN PAPER",
"A4 KRAFT BOARD",
"A4 MARBLE PRINT HAND MADE PAPER",
"A4 METALLIC ASSORTED CARD PAPER",
"A4 MSB0046 SKETCHING JOURNAL BOOK",
"A4 MTC HONEY COMB TEXTURE PAPER",
"A4 MTC PAYAL EMBOSSED CARD SHEET",
"A4 MULTI FOAM PAPER",
"A4 N0020W WATER COLOR PAD",
"A4 ORIGINAL FINE LINE TEXTURE CARD PAPER",
"A4 PRE PRINTED BANDHARI DESIGN (10 SHEETS PAPER)",
"A4 PRE PRINTED BUTTERFLY (10 SHEETS PAPER)",
"A4 PRE PRINTED KERI (10 SHEETS PAPER)",
"A4 PRE PRINTED LOTUS (10 SHEETS PAPER)",
"A4 PRE PRINTED PAPER ENBLEM 10 SHEET (10 SHEETS)",
"A4 PRINTED ORIGAMI PAPER",
"A4 RAYMOND DRAWING PAPER",
"A4 RAYMOND TEXTURE MOUNT BOARD",
"A4 ROUGH DRAWING PAPER",
"A4 SILVER SHINING CARD PAPER",
"A4 SINGLE COLOUR GLITTER FOAM PAPER STICKER",
"A4 SKETCHING PAPER",
"A4 SPOTTY SILVER TEXTURE CARD PAPER",
"A4 SQUARE BOARD SHEET LASER CUT",
"A4 SUPERIOR TEXTURE CARD PAPER",
"A4 TEXTURE CARDSTOCK PAPER",
"A4 TEXTURE MOUNT BOARD PAPER",
"A4 TRANSPARENT TEXTURE PAPER",
"A4 TRANSULENT PAPER",
"A4 VELVET PAPER",
"A4 WATER COLOUR DRAWING CARD PAPER",
"A4 WHITE BOARD",
"ABC COLOR WOODEN TRAY",
"ABC FOAM STICKERS",
"ABC FOIL BALLOON",
"ABC GLITTER STICKER",
"ABC GOLD FOIL BALLOON",
"ABC PLAIN WOODEN TRAY",
"ABC SILVER FOIL BALLOON",
"ABC STONE STICKERS",
"ABSTRACT EXPRESSIUN",
"ACRYLIC CAKE TOPPER",
"ACRYLIC COLOR PAINT",
"ACRYLIC PAINT",
"ACRYLIC PAINTING PALETTE",
"ACRYLIC",
"ACRYLLIC BRUSH SET",
"ACRYLLIC PAINTING SHEET",
"AEROPLANE TOY",
"AEROTIX",
"ALPHABET STAMP KIT",
"ALPHABET",
"ALUMINIUM RULER",
"ALUMINIUM WIRE",
"ANIMAL PENCIL SET",
"ANIMAL PENCIL",
"APRON",
"ARCH TAPE",
"ART BOX",
"ART PAINT",
"ART RESIN HARDNER",
"ART SHAPER",
"ART TOOLS",
"AUTO PENCIL",
"AVENGER ERASER",
"B/0 ERASER",
"BABY PURSE",
"BABY SHOWER KIT",
"BALLOON PUMP",
"BALLOON STAND",
"BALLOON",
"BARBIE BOTTLE",
"BARBIE ERASER",
"BARREL SLIME",
"BATH BOOK",
"BEADS",
"BEST WISH CARD",
"BIKE SHARPENER",
"BINDER H&D MEDIUM",
"BINDING TAPE CUTTER",
"BISCUIT NOTEBOOK",
"BISCUIT PEN",
"BLACK & WHITE EYES",
"BLACK BRUSH SET",
"BLACK GESSO",
"BLACK SPONGE BRUSH",
"BLENDER",
"BLINK PEN",
"BLOW PEN",
"BLUE TACK",
"BODY CRAYONS",
"BOMEJIA ARTIST CANVAS BOARD",
"BOOBOO BALLOON",
"BOOK MARK PAPER",
"BOOK+PEN",
"BOOKMARK",
"BOREX POWDER",
"BOTTLE POUCH",
"BOTTLE",
"BOUNCE BALL",
"BOUNDARY",
"BOW FLOWER",
"BOX FINELINER",
"BOX",
"BRIGHT COLOR CARD PAPER",
"BROWN PAPER BAG",
"BRUSH PEN",
"BRUSH SET",
"BRUSH TOUCH MARKER SET",
"BRUSH",
"BUTTERFLY DIARY",
"BUTTERFLY PRINTED PAPER BAG",
"CAKE DECORATING SET",
"CAKE TOPPER",
"CALCULATOR MEMO PAD",
"CALCULATOR",
"CALLIGRAPHY DIP PEN SET",
"CALLIGRAPHY PEN",
"CANVAS",
"CAPSULE PEN",
"CAR SHARPENER",
"CARD CLAY",
"CARD MAGNET",
"CARD RING",
"CD99L PUNCH",
"CHALK MARKER",
"CHALK PAINT",
"CHAPTA WOODEN STICK",
"CHARCOAL PENCIL",
"CHARCOAL PENCIL",
"CHOCLATE DIARY",
"CHUCHU BALL",
"CLAY TOOL SET",
"CLAY",
"CLIPBOARD",
"CLOTH CRAFT FLOWER",
"CLOTH POLAN FLOWER",
"CLOTH ROSE FLOWER",
"COCONUT CAKE TOPPER",
"COCONUT TREE",
"COIN PURSE",
"COLOR BALL PEN",
"COLOR CARD",
"COLOR CHARCOAL PENCIL",
"COLOR EASEL",
"COLOR EYES",
"COLOR FEATHER",
"COLOR JUTE LACE",
"COLOR MOTI",
"COLOR PEN",
"COLOR SAND",
"COLOR SCHOOL GLUE",
"COLOR SLIME",
"COLOR WOODEN STICK",
"COLORING BRUSH MARKERS",
"COLORING PAPER TAPE",
"COLORING PENCIL SET",
"COLOUR PENCIL SET",
"CONFETTI BALLOON",
"COPPER LEAF",
"COPPER WIRE",
"CORRECTION TAPE",
"COSMETIC NAIL SET",
"COTTON RIBBONS",
"COUNTER JUMP ROPE",
"CRAFT LACE",
"CRAFT LASER PAPER",
"CRAFT POSTED",
"CRAFT",
"CRAZY BALL",
"CREATIVE LAB",
"CRYSTAL PRINT LIGHT BALL",
"CUBE POSTED",
"CUBE PUZZLE",
"CUPCAKE DECORATING SET",
"CUT OUT BANNER",
"CUT POSTED",
"CUTTER",
"DAFA PEN KNIFE",
"DART WHITE BOARD",
"DAYS OF WEEK BLACK BOARD",
"DAYS OF WEEK FOLDING BLACK BOARD",
"DAYS OF WEEK WOODEN CLIP",
"DECO TAPE",
"DECORATION",
"DESIGNER PAPER",
"DETAIL LINER",
"DIAMOND LED SLIME",
"DIAMOND STICKERS",
"DIARY",
"DICE",
"DIGITAL",
"DINO EYE",
"DINOSUR ERASER",
"DINOSUR PEN",
"DISCO LASER",
"DIY ACCESSORIES MAKING KIT",
"DIY ALBUM BINDER",
"DIY ALBUM KIT",
"DIY BOOK KIT",
"DIY BOX ALBUM",
"DIY CARD KIT",
"DIY COLOR DECO",
"DIY COLOR UMBRELLA",
"DIY CORRUGATED BOX",
"DIY CORRUGATED CARD",
"DIY CRAFT LACE",
"DIY GIFTS PACK",
"DIY GREETING CARD KIT",
"DIY LETS MAKE CARD",
"DIY ORNATE FRAME",
"DIY PAPER BALL",
"DIY PAPER BOX",
"DIY PAPER FLOWER KIT",
"DIY PAPER GLOBES",
"DIY PAPER TASSELS",
"DIY PHOTO BOARD",
"DIY SCRAP BOOK KIT",
"DIY SEQUENCE",
"DIY STAR",
"DIY VINTAGE FRAME",
"DIY WOOD BOX STORAGES",
"DIY WOODEN BEADS",
"DIY",
"DOLL FILE BAG",
"DONUT EARPHONE",
"DOREMAN WATER COLOUR",
"DOREMON MARKER PEN",
"DOREMON SILKY CRAYONS",
"DOTT RIBBON",
"DOTT SILICON POUCH",
"DOTTED FEATHER",
"DRAWING PEN",
"DREAM ART COLOR",
"DRUM WOODEN STICK",
"DUCK FEATHER DIARY",
"DUCK GEL PEN",
"DUCK TABLE SHARPENER",
"DUCK WOODEN CLIP",
"EARPHONE",
"EASEL BLACK BOARD",
"EASEL CANVAS BOARD",
"EASEL STAND",
"EGG FOAM PUTTY",
"ELECTRIC BALLOON PUMP",
"ELECTRIC ERASER",
"EMBLISHMENT",
"EMBOSS BALLOON",
"EMBOSSER SET",
"EMPTY BOTTLE",
"EMPTY BRUSH",
"EPOXY ART",
"EPOXY RESIN",
"EPOXY",
"ERASER DONUTS",
"ERASER PUBG",
"ERASER WITH CRAYONS",
"ERASER",
"EXPERIMENTAL MAGNET KIT",
"EYE",
"EYES FOAM STICKER",
"EYES PUFFER BALL",
"FABRIC MARKER",
"FACE PAINT",
"FAN BRUSH SET",
"FEATHER",
"FELT STICKERS",
"FILBERT",
"FILE BAG",
"FINELINE WITH BRUSH PEN",
"FINELINER PEN",
"FINGER PAINT",
"FINGER RING",
"FISH SLIME",
"FLAG BANNER",
"FLAMINGO CAKE TOPPER",
"FLAMINGO DIARY",
"FLAMINGO PAPER BAG",
"FLAMINGO PARTY FLAG",
"FLAMINGO POUCH",
"FLAMINGO SCISSOR",
"FLAMINGO WOODEN CLIP",
"FLAT",
"FLEX CLICK CALLIGRAPHY",
"FLEXIBLE PENCIL",
"FLOWER DIARY",
"FLOWER PRINT PAPER BAG",
"FLOWER",
"FOAM CRAFT FLOWER",
"FOAM CUT OUT",
"FOAM CUTOUT STICKERS",
"FOAM STICK",
"FOIL BALLOON",
"FOIL STRINGS",
"FOOD WOODEN CLIP",
"FOOT BALL SHARPENER",
"FOOTBALL PENCIL SET",
"FRUIT CAKE TOPPER",
"FRUIT CLIP",
"FRUIT ERASER",
"FRUIT MESSAGE BOARD",
"FRUIT PEN",
"FUR",
"GAME",
"GARDEN GRASS KIT",
"GARDEN GRASS SHEET",
"GARLAND BALLOON",
"GEL MEDIUM GLOSS",
"GEL PEN",
"GEOMETRY BOX",
"GEOMETRY SET",
"GESSO BRUSH SET",
"GESSO",
"GLITTER BUTTON DIARY",
"GLITTER DIARY",
"GLITTER FEATHER PAPER BAG",
"GLITTER FEATHER",
"GLITTER FLOWER",
"GLITTER FOAM CUTOUT STICKERS",
"GLITTER GLUE",
"GLITTER MASKING TAPE",
"GLITTER PAPER FLOWER",
"GLITTER PARTY FAVORS",
"GLITTER PARTY FLAG",
"GLITTER POWDER",
"GLITTER PRINTED MASKING TAPE",
"GLITTER RIBBON",
"GLITTER SHAPE DIARY",
"GLITTER STICKERS",
"GLITTER STONE STICKERS",
"GLITTER TAPE",
"GLITTER VALUE CRAFT",
"GLOW FACE PAINT",
"GLOW IN DARK METAL MAGIC RING",
"GLOW SLIME MAKING KIT",
"GLOW TUBE BODY PAINT",
"GLUE",
"GOLD ACRYLIC STENCIL",
"GOLD CAKE TOPPER",
"GOLD FLOWER MAKING TAPE",
"GOLD FOIL BALLOON",
"GOLD LEAF",
"GOLD MOTI",
"GOLD SILVER PAPER FLOWER",
"GOLD TOUCH MARKER",
"GOUACHE COLOR",
"GRAPHITE PENCIL",
"GRASS",
"GREEN FLOWER MAKING TAPE",
"GRID NOTE BOOK",
"GRIP PENCIL",
"GUN ERASER",
"GUN",
"H.B GOLD ACRYLIC CAKE TOPPER",
"H.B PAPER BAG",
"H.B PARTY BANNER",
"H.B PARTY SASH",
"H.B PLAIN PARTY FLAG",
"H.B STONE CAKE TOPPER",
"H.B. CAP",
"H.B. PARTY FLAG",
"H.B",
"HAIR CHALK",
"HAND PENCIL",
"HAND ROCKET",
"HANDMADE STICKER",
"HANGING DÉCOR",
"HANGING PARTY FAVOR",
"HAPPY BRITHDAY CARD",
"HEAD PHONE",
"HEART BALLOON",
"HEART FEATHER DIARY",
"HEART JUMBO BALLOON",
"HEART LASER CUT MDF EMBLISHMENT",
"HEART SEQUENCE",
"HEART SILICON MOULD",
"HEART SILICON POUCH",
"HEART SPONGE",
"HEART STONE STICKERS",
"HEART",
"HELICOPTER SHARPENER",
"HELIUM BALLOON",
"HEXAGON SILICON MOULD",
"HIGHLIGHTER",
"HOLLOGRAPHIC DIARY",
"HOLLOGRAPHIC",
"HOLLOGRAPHY POUCH",
"HOLLOGRAPHY ZIPPER",
"HOLOGHRAPIC RIBBON",
"HOLOGRAPHY FUR POUCH",
"HOLOGRAPHY ZIPPER",
"HOT PUMP",
"HOTOY",
"I LOVE YOU BALLOON",
"ICE CREAM ERASER",
"ICE CREAM WOODEN CLIP",
"ICE JEWELLERY DECO",
"ICECREAM HAND FAN",
"ICE-CREAM STICK",
"IMPASTO",
"ITS BOY FOIL BALLOON",
"ITS GIRL FOIL BALLOON",
"JELLY ZIPPER",
"JUMBO CRAYONS",
"JUMBO MDF MULTI PURPOSE TRAY",
"JUMBO PENCIL",
"JUMBO WOODEN CLIP",
"JUMBO",
"JUMP ROPE DIGITAL",
"JUMP ROPE",
"JUNGLE ART KIT",
"JUTE DOTT ZIPPER",
"JUTE FLOWER ZIPPER",
"JUTE LACE",
"JUTE LINING ZIPPER",
"JUTE SHEET",
"KANDI WOODEN STICK",
"KEEP CALM DIARY",
"KITTY",
"KNIFE ERASER",
"KNIFE SET",
"LACE",
"LASER CUT MDF EMBLISHMENT",
"LASER CUT",
"LASER LIGHT",
"LASER",
"LEAF FOIL",
"LED BALLOON",
"LED CAKE TOPPER",
"LED EMBOSS BALLOON",
"LED FINGER RING",
"LEGO SILICON POUCH",
"LETTERS",
"LIGHT BALL",
"LINE POSTED",
"LINING PAPER BAG",
"LINING POSTED",
"LOCK DIARY",
"LOL 8IN1",
"LOL RAINBOW RING LIGHT SURPRISE",
"LOL",
"LOLLIPOP SPONGE BRUSH",
"LONG CRAYONS",
"LONG STONE STICKERS",
"LOOM BAND",
"LOOM KIT",
"LOOSE MAGNET",
"LOOSE TOUCH MARKER",
"LOVE EMBOSS BALLOON",
"LOVE YOU JUMBO BALLOON",
"LUGGAGE TAG",
"LUNCH BOX STEEL",
"LUNCH BOX",
"MAGIC BOUNCE PUTTY",
"MAGIC COTTON SAND",
"MAGIC DECO ART PAINT",
"MAGIC LED SLIME",
"MAGIC MARKER",
"MAGIC NINJA",
"MAGIC PEN",
"MAGIC PEN+REFILL",
"MAGIC RING",
"MAGIC SLATE + BLACKBOARD",
"MAGIC SLATE",
"MAGIC SNOW TUBE",
"MAGIC SNOW",
"MAGIC WATER DOODLE",
"MAGNET",
"MAGNETIC MEMO PAD",
"MAGNETIC PENCIL BOX",
"MAGNETIC PUTTY",
"MAGNETIC WOODEN STICKERS",
"MAGNIFIER GLASS",
"MARBLE PRINT BALLOON",
"MARBLE STONE",
"MARKER SET",
"MARKER",
"MASKING TAPE",
"MASSAGE LIGHT BALL",
"MDF",
"ME2 PUFFER BALL",
"ME2",
"MEASURING TAPE",
"MEDIUM MATT",
"MEMO PAD",
"MERMAID PEN",
"MERMAID WOODEN CLIP",
"MESSAGE BOARD STAND",
"MESSAGE BOARD",
"MESSAGE CARD",
"MESSAGE FLOWER",
"METAL ART TOOLS",
"METAL BELL",
"METAL BOOKMARK",
"METAL BOTTLE",
"METAL PENCIL BOX",
"METAL TORCH",
"METALLIC BALLOON",
"METALLIC KAKDI BALLOON",
"METALLIC METAL MAGIC RING",
"METALLIC MULTI BALLOON",
"METALLIC PARTY FAN",
"METALLIC SLIME",
"METALLIC",
"MILK BOTTLE",
"MINI DETAIL LINER",
"MINI HUG CARD",
"MINI STAPLER SET",
"MODELLING CLAY",
"MODELLING PASTE",
"MONKEY BOOK+PEN",
"MONTMARTE BRUSH",
"MONTMARTE",
"MOODY FACE",
"MOON BOUNCE BALL",
"MOON SEQUENCE",
"MOTI PENCIL",
"MOTI STONE STICKERS",
"MOTI",
"MOULD",
"MRJT0025",
"MULTI COLOR PEN",
"MULTI CRAYONS",
"MULTI FEATHER",
"MULTI MOTI",
"MULTI PARTY FAVORS",
"MULTI POSTED",
"MULTI PURPOSE WOOD TRAY",
"MULTI",
"MULTIPURPOSE ART BOX",
"MUSIC ERASER",
"MUTLICOLOR JUMBO PENCIL",
"NAIL ART",
"NAIL STICKERS",
"NATURAL WORLD MIX",
"NEON BOUNCE BALL",
"NEON COLOR PEN",
"NEON GLOW IN DARK BODY PAINT",
"NEON LIGHT BALL",
"NEON MARKER",
"NEON PAPER TAPE",
"NEON PEN",
"NEON POUCH",
"NEON SCISSOR",
"NEON VALUE CRAFT",
"NEON",
"NOISE PUTTY",
"NOTE BOOK 3781",
"NOTE BOOK 3783",
"NOTE BOOK",
"NUMBER STAMP",
"ODORLESS THINNER",
"OIL COLOR BRUSH SET",
"OIL COLOR",
"ORGANIC",
"ORIGAMI PAPER",
"OVAL LASER CUT MDF EMBLISHMENT",
"OVAL",
"PAINT MARKER",
"PAINTING APRONS",
"PAINTING BRUSH SET",
"PAINTING BRUSH",
"PAINTING KNIFE",
"PAINTING PALLETE",
"PAINTING SHEET",
"PALLETE BRUSH SET",
"PALLON CRAFT FLOWER",
"PANDA FUR DIARY",
"PAPER BAG",
"PAPER BHUSHA",
"PAPER BUNTING KIT",
"PAPER CRAFT FLOWER",
"PAPER CUTTER",
"PAPER FLOWER",
"PAPER SOAP",
"PAPER STRAW",
"PAPER STRIPS",
"PAPER TAPE",
"PAPER TAZZELS",
"PAPER THREAD",
"PAPER",
"PAPER",
"PARIS DIARY",
"PARTY BANNER",
"PARTY FAN",
"PARTY FAVORS",
"PARTY FLAG",
"PARTY POPPER",
"PARTY SWIRL",
"PARTY WHISTLE",
"PARTYS EYE MASK",
"PASTEL BALLOON",
"PEARL FLOWER",
"PEARL",
"PEN + DIARY",
"PEN KNIFE",
"PEN",
"PENCIL + CRAYONS",
"PENCIL BOX",
"PENCIL GRIPPER",
"PENCIL LEAD",
"PENCIL POUCH",
"PENCIL SET",
"PENCIL",
"PEPPA PIG BOTTLE",
"PEPPA PIG",
"PHOTO BOOT",
"PHOTO FRAME",
"PIGMENT",
"PIPUDI BALLOON",
"PLAIN BALLOON",
"PLAIN EASEL",
"PLAIN PAPER BAG",
"PLAIN POSTED",
"PLAIN WOODEN CLIP",
"PLAIN WOODEN STICK",
"PLAIN",
"PLANNER DIARY",
"PLASTIC CARLING RIBBON",
"PLASTIC CRAYONS",
"PLASTIC GRASS",
"PLASTIC STENCIL DESIGN",
"POCKET BOOK+PEN(B)",
"POCKET FEATHER DIARY + PEN (B)",
"POM POM EYES",
"POM POM",
"POMPOM CAKE TOPPER",
"POOP SLIME",
"POSTED",
"POSTER PAINT",
"POUCH ERASER",
"PRINCE",
"PRINCESS ERASER",
"PRINCESS",
"PRINT SEQUINS BOOK+PEN(B)",
"PRINT",
"PRINTED BOUNCE BALL",
"PRINTED CANVAS BOARD",
"PRINTED FLOWER ZIPPER(S)",
"PRINTED MASKING TAPE",
"PRINTED PAPER BAG",
"PRINTED",
"PUBG",
"PUFFER BALL",
"PUFFER",
"PUMP BALLOON",
"PUNCH + SCISSOR",
"PUNCH SET",
"PUNCH",
"PUZZLE SHARPENER",
"PUZZLE",
"QY1004",
"RAINBOW COLOR PAPER BAG",
"RAINBOW FEATHER DIARY",
"RAINBOW FEATHER",
"RAINBOW FUR DIARY",
"RAINBOW",
"RECTANGLE",
"RESIN HARDNER",
"RESIN",
"RETARDER",
"RIBBON COLOR",
"RIBBON STONE",
"RIBBON",
"RIBBON+ BOW FLOWER",
"ROLLER STAMP",
"ROLLER STAMP",
"ROLLING CRAYONS",
"ROOM DECO STICKERS",
"ROSE PRINT ZIPPER",
"ROSE",
"ROUND CARD MAGNET",
"ROUND LASER CUT MDF EMBLISHMENT 6",
"ROUND",
"RUBBER CHARMS",
"RUBBER STICKER",
"RULER",
"SAKURA CRAFT LACE FLOWER",
"SATIN RIBBON",
"SCENTED MARKER",
"SCHOOL GLUE",
"SCIENCE KIT",
"SCISSOR",
"SCRATCH PAPER",
"SCRATCH",
"SD TATTOO STICKER",
"SEQUINS DIARY",
"SEQUINS PRINT DIARY",
"SEQUINS",
"SHAKER BOTTLE",
"SHAPE",
"SHAPES MAGNET",
"SHARPENER",
"SILICON DIARY",
"SILICON MOULD",
"SILICON POUCH",
"SILICON",
"SILKY CRAYONS",
"SILVER FOIL BALLOON",
"SILVER LEAF FOIL",
"SILVER",
"SKETCH & DRAW",
"SKETCH BOOK",
"SKETCH PEN",
"SKETCHING JOURNAL BOOK",
"SKYIST PEN",
"SLIME ACTIVATER",
"SLIME MAKING KIT",
"SLIME",
"SMILE JUMBO BALLOON",
"SMILE WOODEN SHOW PIECES",
"SMILEY BEADS",
"SMILEY EMBOSS BALLOON",
"SMILEY HIGHLIGHTER",
"SMILEY MAGNET",
"SMILEY",
"SNOW MAKING KIT",
"SOFT CLAY",
"SOFT PASTEL GREY",
"SOFT",
"SPACE DIARY",
"SPIRAL DIARY",
"SPIRAL POSTED",
"SPIRAL",
"SPONGE BRUSH",
"SPONGE",
"SPORT BOTTLE",
"SPORTS ERASER",
"SPT BOTTLE",
"SQUARE",
"SQUEEZE PEN",
"SQUISH",
"STAMP INK PAD",
"STAMP SET",
"STAMP",
"STAND",
"STAR LASER CUT MDF EMBLISHMENT 4",
"STAR",
"STECOSCOPIC STICKERS",
"STEEL BOTTLE",
"STEEL MUG",
"STENCIL",
"STICK",
"STICKER",
"STICKY HAND",
"STICKY NOTE",
"STONE",
"STRAW",
"STRIP",
"SUBJECT BOOK",
"SUN",
"SUPER CLEAR GLUE",
"SWEET",
"SYMPHONY NAIL SET",
"T.COSTER",
"TABLE SHARPENER",
"TAG FOR YOU CARD",
"TAPE ROLL",
"TATTOO PEN",
"TATTOO",
"TB",
"TEDDY SHARPENER",
"TEDDY",
"TELESCOPE",
"TEMPERA PAINT",
"THANK YOU CARD",
"TOOL SET",
"TOOTH BRUSH ERASER",
"TOOTHPICK",
"TOP",
"TOUCH MARKER SET",
"TOUCH MARKER",
"TRANSPARENT POUCH",
"TRANSPARENT SCHOOL GLUE",
"TRANSPARENT",
"TRAY",
"TRIANGLE",
"TS",
"TWIST",
"TWISTED CRAYONS",
"TY",
"TZ",
"UNICORN BOTTLE",
"UNICORN BRACELET",
"UNICORN DIARY",
"UNICORN EARPHONE",
"UNICORN ERASER",
"UNICORN LIGHT PEN",
"UNICORN PEN",
"UNICORN SCISSOR",
"UNICORN",
"VALUE CRAFT",
"VELCRO",
"VELVET",
"VINTAGE DIARY",
"WALLET",
"WASHABLE FINGER PAINT",
"WATCH",
"WATER COLOR PAD",
"WATER LIGHT PEN",
"WATER POUCH",
"WATER SOLUBLE COLOR PENCIL",
"WATER",
"WATERCOLOR PAINT",
"WEEK",
"WHISTLE PENCIL",
"WHISTLE",
"WHITE BOARD MARKER",
"WHITE GESSO",
"WHITE MARKER",
"WHITE",
"WILLOW",
"WOOD TRAY",
"WOOD",
"WOODEN BOUNDARY",
"WOODEN CLIP",
"WOODEN LETTER",
"WOODEN STICK",
"WOODEN",
"WORLD",
"WRIST BALL",
"WXAQ",
"WXQE",
"WXQQ",
"Y009",
"YC",
"YD",
"YUB",
"YUPO",
"ZIGZAG SCISSOR SET",
"ZIPP"
];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("searchnav"), countries.sort());
autocomplete(document.getElementById("searchnav1"), countries.sort());

 
</script>
