// if (isset($_GET['update']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['update']])) {
// // Remove the product from the shopping cart

// // var_dump($_GET['update']);
// // var_dump($_SESSION['cart']);
// $cart = $_SESSION['cart'];

// foreach ($cart as $k => $quantity) {

// if ($k == $_GET['update']) {
// $zahlQuantity = floatval($quantity);
// $zahlQuantity++;

// if (isset($_SESSION['cart'][$_GET['update']]) && $quantity > 0) {
// // Update new quantity
// $_SESSION['cart'][$_GET['update']] = $zahlQuantity;
// }
// }

// /*
// if (strpos($k, 'quantity') !== false) {
// $id = str_replace('quantity-', '', $k);
// $quantity = $v;
// // Always do checks and validation
// if (isset($_SESSION['cart'][$id]) && $quantity > 0) {
// // Update new quantity
// $_SESSION['cart'][$id] = $quantity;
// }
// }*/
// }
// }
// // Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
// if (isset($_POST['update']) && isset($_SESSION['cart'])) {
// // Loop through the post data so we can update the quantities for every product in cart
// foreach ($_POST as $k => $v) {
// if (strpos($k, 'quantity') !== false) {
// $id = str_replace('quantity-', '', $k);
// $quantity = $v;
// // Always do checks and validation
// if (isset($_SESSION['cart'][$id]) && $quantity > 0) {
// // Update new quantity
// $_SESSION['cart'][$id] = $quantity;
// }
// }
// }
// // Prevent form resubmission...
// header('location: cart.php');
// exit;
// }