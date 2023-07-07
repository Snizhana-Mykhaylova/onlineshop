<?php

include './functions.php';
@$productID = $_POST["productID"];
@$quantity = $_POST['quantity'];

session_start();

if (!empty($productID) && !empty($quantity)) {

    $queryProductsInCart = "SELECT * from artikel WHERE ArtikelID = $productID";
    $product = getProducts($queryProductsInCart);

    // Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {

        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {


            if (array_key_exists($productID, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity

                $_SESSION['cart'][$productID] += $quantity;
            } else {
                // Product is not in cart so add it

                $_SESSION['cart'][$productID] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart

            $_SESSION['cart'] = array($productID => $quantity);
        }
    }


    // Prevent form resubmission...
    header('location:cart.php');
    exit;
}

// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}

if (isset($_GET['increment']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['increment']])) {

    var_dump($_GET);
    var_dump($_SESSION['cart']);
    $cart = $_SESSION['cart'];
    foreach ($cart as $k => $quantity) {

        if ($k == $_GET['increment']) {
            $zahlQuantity = floatval($quantity);
            $zahlQuantity++;

            if (isset($_SESSION['cart'][$_GET['increment']]) && $quantity > 0) {
                // increment new quantity
                $_SESSION['cart'][$_GET['increment']] = $zahlQuantity;
                var_dump($_SESSION['cart']);
            }
        }
    }
}
$zahlQuantity = NULL;

if (isset($_GET['decrement']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['decrement']])) {

    var_dump($_GET);
    var_dump($_SESSION['cart']);
    $cart = $_SESSION['cart'];
    foreach ($cart as $k => $quantity) {

        if ($k == $_GET['decrement']) {
            $zahlQuantity = floatval($quantity);
            $zahlQuantity--;

            if (isset($_SESSION['cart'][$_GET['decrement']]) && $zahlQuantity > 0) {
                // increment new quantity
                $_SESSION['cart'][$_GET['decrement']] = $zahlQuantity;
                var_dump($_SESSION['cart']);
            }
        }
    }
}


// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: placeorder.php');
    exit;
}

template_header();


echo <<<EOT
<!-- Main Content  -->
 <main>
        <div class="container">
          <div class="formBox">
            
            <form action="placeorder.php" method="post">
          
              <section class="itemRewiew">
                <h3 class="captureSmall">1. Item Review</h3>

                <!-- Rewiew List  -->
                <ul class="rewiewList">
EOT;

// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
$ordertotal = 0.00;
$rabat =  0.00;
$MWST = 0.00;


// If there are products in cart
if ($products_in_cart) {

    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $index = 0;

    foreach ($products_in_cart as $id => $quant) {

        // Fetch the products from the database and return the result as an Array
        $sqlQuery = "SELECT * from artikel WHERE ArtikelID = $id;";
        $product = getProducts($sqlQuery);

        $preis = $product[0]['Einzelpreis'];

        echo "<li class='rewiewItem' id='rewiewItem'>";
        echo "<img width='50' height='50' class='rewiewImg' src='./bilder/waren/img_" . $product[0]['ArtikelID'] . ".png' alt=''>";
        echo "<div class='itemText'> <p class='itemName'>" . $product[0]['Artikelname'] . "</p> </div>";
        echo "<p class='preis'>$" . number_format($preis, 2, ',', '.') . "</p>";
        echo "<p class='preis'>" . $quant . "</p>";
        echo "<a class=button href='cart.php?remove=" . $product[0]['ArtikelID'] . "' class='remove'>Remove</a>";
        echo "<a class=button href='cart.php?increment=" . $product[0]['ArtikelID'] . "' class='increment'>+</a>";
        echo "<a class=button href='cart.php?decrement=" . $product[0]['ArtikelID'] . "' class='decrement'>-</a>";
        echo "</li>";

        // Calculate the zwischensumme 
        $zwischensumme = $preis  * $quant;
        $subtotal += $zwischensumme;
    }
} else {
    echo "<h2 style='text-align:center;'>You have no products added in your Shopping Cart</h2>";
}

$rabat = $subtotal > 300 ? $subtotal * 0.05 : 0.00;
$MWST = $subtotal > 0.00 ? $subtotal * 0.19 : 0.00;
$ordertotal = $subtotal + $MWST - $rabat;


// Oder Total section 
echo "<div class='orderTotal'>";
echo "<h3 class='captureSmall'>Order totals</h3>";
echo "<ul>";
echo "<li style='justify-content: space-between;' class='flex orderTotalItem'>";
echo "<p>Subtotal:</p>";
echo "<p class='preis'>$" . number_format($subtotal, 2, ',', '.') . "</p>";
echo "</li>";

echo "<li style='justify-content: space-between;' class='flex orderTotalItem'>";
echo "<p>Discount:</p>";
echo "<p class='preis'>$" . number_format($rabat, 2, ',', '.') . "</p>";
echo "</li>";
echo "<li style='justify-content: space-between;' class='flex orderTotalItem'>";
echo "<p>Estimated sales tax:</p>";
echo "<p class='preis'>$" . number_format($MWST, 2, ',', '.') . "</p>";
echo "</li>";
echo "<li style='justify-content: space-between;' class='flex orderTotalItem'>";
echo "<p class='captureSmall'>Order total:</p>";
echo "<p class='preis'>$" . number_format($ordertotal, 2, ',', '.') . "</p>";
echo "</li>";
echo "</ul>";
echo "</div>";


template_cart();

echo "<input class='submit' type='submit' value='Complete order' />";

echo " </form>";
echo "</div>";
echo "</div>";
echo "</main>";
template_footer();
