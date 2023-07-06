<?php
include './functions.php';
session_start();
$product = null;
$productID = null;

// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // // Fetch the product from the database and return the result as an Array

    $fetchProductsById = "SELECT * from artikel WHERE ArtikelID = $id;";

    $product = getProducts($fetchProductsById);

    $productID = $product[0]["ArtikelID"];

    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
}
template_header();
?>

<style type='text/css'>
    .productItem {
        padding: 100px;
        align-items: flex-start;
        justify-content: center;
    }

    .quantity {
        display: block;
        margin-bottom: 20px;
        margin-top: 20px;
    }

    .margin-bottom20 {
        margin-bottom: 20px;
    }

    .productText {
        margin-left: 400px;
    }
</style>

<div class="container productItem flex">
    <img src="./bilder/waren/img_<?= $product[0]['ArtikelID'] ?>.png" alt="<?= $product[0]['Artikelname'] ?>" />
    <div class="productText">
        <h1 class="productTitel"><?= $product[0]['Artikelname'] ?></h1>

        <p class="producBeschreibung margin-bottom20">
            <?= $product[0]['Beschreibung'] ?>
        </p>

        <span class="preis margin-bottom20">
            &dollar;<?= $product[0]['Einzelpreis'] ?>
        </span>
        <form action="cart.php" method="post">
            <input name="quantity" class="quantity" value="1" min="1" max="<?php echo $product[0]['Lagerbestand'] ?>" placeholder="Quantity" required>
            <input type="hidden" name="productID" value=<?php echo $productID ?>>
            <input type="submit" class="button" value="Add To Cart">
        </form>

    </div>
</div>

<?php


template_footer(); ?>