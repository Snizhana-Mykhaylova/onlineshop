<?php
    // This file will be the home page that will contain a featured image and 4 recently added products.

    include 'functions.php';
    $queryProducts = "SELECT * from artikel LIMIT 6; ";
    $products = getProducts($queryProducts);

    template_header();
?>


<div class="container">
    <div class="greunDiv"></div>
    <section class="baner">
        <div class="banerText">
            <p class="captureSmall">new collection</p>
            <p class="captureGross">Menswear 2020</p>
            <button class="button" onclick="">Shop now</button>
        </div>
    </section>
</div>
<section class="kategorien">
    <div class="container">
        <ul class="flex kontaktenList">
            <li class="kategorienItem">
                <a href="./kategorieSite.php?KategorieNR=1">
                    <img src="./bilder/kategories/frauen.png" alt="frau" />
                    <p>Women</p>
                </a>
            </li>
            <li class="kategorienItem">
                <a href="./kategorieSite.php?KategorieNR=2">
                    <img src="./bilder/kategories/meaner.png" alt="mann" />
                    <p>Men</p>
                </a>
            </li>
            <li class="kategorienItem">
                <a href="./kategorieSite.php?KategorieNR=3">
                    <img src="./bilder/kategories/kinder.png" alt="kind" />
                    <p>Kids</p>
                </a>
            </li>
        </ul>
    </div>
</section>

<section class="waren">
    <div class="container">
        <h2 class="sectionTittel">New arrivals</h2>
        <!-- Verbindung erfolgreich
        array(6) { [0]=> array(7) { ["ArtikelID"]=> string(1) "6" ["Artikelname"]=> string(16) "Basic sweatshirt" ["Beschreibung"]=> string(13) "A cap for men" ["Einzelpreis"]=> string(6) "120.60" ["Bild"]=> string(52) "./onlineshop/bilder/artikel/green_children_pants.png" ["Lagerbestand"]=> string(2) "25" ["KategorieNR"]=> string(1) "3" } [1]=> array(7) { ["ArtikelID"]=> string(1) "7" ["Artikelname"]=> string(19) "Red dangle earrings" ["Beschreibung"]=> string(29) "Red dangle earrings for women" ["Einzelpreis"]=> string(5) "29.95" ["Bild"]=> string(1) "/" ["Lagerbestand"]=> string(2) "35" ["KategorieNR"]=> string(1) "1" } [2]=> array(7) { ["ArtikelID"]=> string(1) "8" ["Artikelname"]=> string(31) "Mid-rise slim cropped fit jeans" ["Beschreibung"]=> string(57) "Mid-rise slim cropped fit jeans - stylish jeans for women" ["Einzelpreis"]=> string(5) "40.00" ["Bild"]=> string(1) "/" ["Lagerbestand"]=> string(2) "80" ["KategorieNR"]=> string(1) "1" } [3]=> array(7) { ["ArtikelID"]=> string(1) "9" ["Artikelname"]=> string(25) "Black and white sport cap" ["Beschreibung"]=> string(14) "A cap for men " ["Einzelpreis"]=> string(5) "18.15" ["Bild"]=> string(1) "/" ["Lagerbestand"]=> string(2) "44" ["KategorieNR"]=> string(1) "2" } [4]=> array(7) { ["ArtikelID"]=> string(2) "10" ["Artikelname"]=> string(10) "Gray shoes" ["Beschreibung"]=> string(22) "Men fashion gray shoes" ["Einzelpreis"]=> string(5) "85.50" ["Bild"]=> string(1) "/" ["Lagerbestand"]=> string(2) "25" ["KategorieNR"]=> string(1) "2" } [5]=> array(7) { ["ArtikelID"]=> string(2) "11" ["Artikelname"]=> string(12) "Chrono watch" ["Beschreibung"]=> string(30) "Chrono watch with blue armband" ["Einzelpreis"]=> string(6) "120.60" ["Bild"]=> string(1) "/" ["Lagerbestand"]=> string(2) "60" ["KategorieNR"]=> string(1) "2" } } -->
        <ul class="flex">

            <?php foreach ($products as $product) : ?>
                <li class="warenItem">
                    <a href="product.php?id=<?= $product['ArtikelID'] ?>"><img src="./bilder/waren/img_<?= $product['ArtikelID'] ?>.png" alt="<?= $product['Artikelname'] ?>" />
                        <p class="beshreibung"><?= $product['Beschreibung'] ?></p>
                        <p class="preis">&dollar;<?= $product['Einzelpreis'] ?></p>
                    </a>

                    <!-- <button class="addToCart">Add to cart</button> -->
                </li>

            <?php endforeach; ?>
        </ul>
    </div>
</section>

<div class="container">
    <section class="subscribe">
        <div>
            <h2 class="subscribeTitel">Subscribe for updates</h2>
            <p>Subscribe for exclusive early sale access and new arrivals.</p>
            <form action="">
                <p class="emailText">Email</p>
                <input class="emailInput" name="email" type="text" placeholder="Your working email" />
                <input class="button" type="submit" value="Subscribe" />
                <p>
                    <input type="checkbox" />I agree to receive communications from
                    Createx Store.
                </p>
            </form>
        </div>
        <img src="./bilder/imageSubscribe.png" alt="" />
    </section>
</div>

<?= template_footer() ?>