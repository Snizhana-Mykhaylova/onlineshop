<?php
// This file will be the home page that will contain a featured image and 4 recently added products.

include './functions.php';
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
            <a href="./kategorieSite.php?KategorieNR=2">
                <button class="button">Shop now</button>
            </a>
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