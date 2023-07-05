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

// // Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
// if (isset($_POST['update']) && isset($_SESSION['cart'])) {
//     // Loop through the post data so we can update the quantities for every product in cart
//     foreach ($_POST as $k => $v) {
//         if (strpos($k, 'quantity') !== false ) {
//             $id = str_replace('quantity-', '', $k);
//             $quantity = $v;
//             // Always do checks and validation
//             if (isset($_SESSION['cart'][$id]) && $quantity > 0) {
//                 // Update new quantity
//                 $_SESSION['cart'][$id] = $quantity;
//             }
//         }
//     }
//     // Prevent form resubmission...
//     header('location: cart.php');
//     exit;
// }

// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: placeorder.php');
    exit;
}


template_header_cart();


echo <<<EOT
<!-- Main Content  -->
 <main>
        <div class="container">
          <div class="formBox">
            
            <form action="">
          
              <section class="itemRewiew">
                <h3 class="captureSmall">1. Item Review</h3>

                <!-- Rewiew List  -->
                <ul class="rewiewList">
EOT;

// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
$total = 0.00;
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
        $sqlQuery = "SELECT * from artikel WHERE ArtikelID = $id";
        $product = getProducts($sqlQuery);


        // Calculate the subtotal
        $subtotal += floatval($product[0]['Einzelpreis'])  * $quant;
        // echo $subtotal;

        $total += (float)$subtotal;

        echo "<li class='rewiewItem' id='rewiewItem'>";
        echo "<img width='50' height='50' class='rewiewImg' src='./bilder/waren/img_" . $product[0]['ArtikelID'] . ".png' alt=''>";
        echo "<div class='itemText'> <p class='itemName'>" . $product[0]['Artikelname'] . "</p> </div>";
        echo "<p class='preis'>" . $subtotal . "</p>";
        echo "<input
                      class='itemAnzahl'
                      type='number'
                      name='quantity'
                      min='1'
                      max='100'
                      step='1'
                      value=$quant
                    />";

        echo "<a class=button href='cart.php?remove=" . $product[0]['ArtikelID'] . "' class='remove'>Remove</a>";

        echo "</li>";
    }
} else {
    echo "<h2 style='text-align:center;'>You have no products added in your Shopping Cart</h2>";
}

$rabat = $total > 300 ? $total * 0.05 : 0.00;
$MWST = $total > 0.00 ? $total * 0.19 : 0.00;
$ordertotal = $total + $MWST - $rabat;


// Oder Total section 
echo "<div class='orderTotal'>";
echo "<h3 class='captureSmall'>Order totals</h3>";
echo "<ul>";
echo "<li class='flex orderTotalItem'>";
echo "<p>Subtotal:</p>";
echo "<p class='preis'>$$total</p>";
echo "</li>";

echo "<li class='flex orderTotalItem'>";
echo "<p>Discount:</p>";
echo "<p class='preis'>$$rabat</p>";
echo "</li>";
echo "<li class='flex orderTotalItem'>";
echo "<p>Estimated sales tax:</p>";
echo "<p class='preis'>$$MWST</p>";
echo "</li>";
echo "<li class='flex orderTotalItem'>";
echo "<p class='captureSmall'>Order total:</p>";
echo "<p class='preis'>$$ordertotal</p>";
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
