<?php
include './functions.php';

@$kategorieNR = $_GET['KategorieNR'];

$queryProducts = "SELECT * from artikel WHERE KategorieNR = $kategorieNR;";
$products = getProducts($queryProducts);

template_header();
?>

<div style="padding: 100px 150px;" class="container">

    <ul class="flex">

        <?php foreach ($products as $product) : ?>
            <li class="warenItem">
                <a href="./product.php?id=<?= $product['ArtikelID'] ?>"><img src="./bilder/waren/img_<?= $product['ArtikelID'] ?>.png" alt="<?= $product['Artikelname'] ?>" />
                    <p class="beshreibung"><?= $product['Beschreibung'] ?></p>
                    <p class="preis">&dollar;<?= $product['Einzelpreis'] ?></p>
                </a>

                <!-- <button class="addToCart">Add to cart</button> -->
            </li>

        <?php endforeach; ?>
    </ul>
</div>

<?php template_footer(); ?>