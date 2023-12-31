<?php


//holt 6 Artikel
function getProducts($sql)
{


  try {
    //stellt eine Verbiendung zum SQL server
    $dbh = new PDO(
      "mysql:dbname=onlineshop; host=localhost", //keine Leerzeichen!!
      "root",
      ""
    );

    //schikt die Abfrage an die Datenbank und speichert die Ergebniss in eine Variable
    $rueckgabe = $dbh->query($sql);
    $products = $rueckgabe->fetchALL(PDO::FETCH_ASSOC);
    $dbh = null; //close

    return $products;
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
}


function template_header()
{
  $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
  echo <<<EOT
  <!DOCTYPE html>
  <html>
    <head>
      <title>onlineshop</title>
      <meta charset="utf-8" />
      <link rel="stylesheet" href="homepage.css" />
      <link rel="stylesheet" href="cartpage.css" />
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap"
        rel="stylesheet"
      />
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
    <body>
      <header>
        <div class="container">
          <div class="kontakten">
            <span class="tel">Available 24/7 at (405) 555-0128</span>

          </div>
          <div class="container">
            <section class="menu">
              <div  style="justify-content: space-between;" class="flex">
                <nav>
                  <a href="index.php"><img class="logo" src="./bilder/logo.png" alt="logo" /><a/>
                  <ul  style="justify-content: space-between;" class="flex">
                    <li class="navItem">
                      <a href="./kategorieSite.php?KategorieNR=1">Woman</a>
                    </li>
                    <li class="navItem">
                      <a href="./kategorieSite.php?KategorieNR=2">Men</a>
                    </li>
                    <li class="navItem">
                      <a href="./kategorieSite.php?KategorieNR=3">Kids</a>
                    </li>
                  </ul>
                </nav>


                <a style="margin-right: 20px;" href="./cart.php" />
              <span class="material-symbols-outlined">shopping_cart</span>
              <span>$num_items_in_cart</span>
              <a/>
                
                <div style="align-items: center; flex-direction: column; display: flex;" class="loginContainer">
                  <a href="./login/login.php"> <img id="login-icon" width="32px" height="32px" src="./bilder/login/login-icon.png" alt="login icon"></a>
                  <p id="username-login">
  EOT;
  echo htmlspecialchars(@$_SESSION["username"]);
  echo <<<EOT
                  </p>
              </div>

          </section>
        </div>
      </header>
  EOT;
}

function template_footer()
{
  echo <<<EOT
           <footer class="container">
                <div class="shop">
                    <ul>
                        <li class="captureSmall">Shop</li>
                        <li class="captureSmall"><a href="">New arrivals</a></li>
                    </ul>
                </div>

                <div class="getInTouch">
                    <p class="captureSmall">get in touch</p>
                    <p>Call: (405) 555-0128</p>
                    <p>Email:hello@createx.com</p>
                </div>
            </footer>
        </body>
    </html>

EOT;
}


function template_cart()
{
  echo <<<EOT
              <!-- Shipping & Billing Address -->

              <section class="shippingSection">
                <h2 class="captureSmall">2. Shipping & Billing Address</h2>
                <ul>
                  <div  style="justify-content: space-between;"  style="justify-content: space-between;" class="flex">
                    <li class="shippinItem">
                      <p class="feldName">First Name</p>
                      <input
                        name="name"
                        class="shippinInput"
                        type="text"
                        placeholder="Your first name"
                        required
                      />
                    </li>
                    <li  class="shippinItem">
                      <p class="feldName">Last Name</p>
                      <input
                        class="shippinInput"
                        type="text"
                        placeholder="Your last name"
                        required
                      />
                    </li>
                  </div>

                  <div   style="justify-content: space-between;" class="flex">
                    <li class="shippinItem">
                      <p class="feldName">Email</p>
                      <input
                        class="shippinInput"
                        type="text"
                        placeholder="Your working email"
                      />
                    </li>
                    <li class="shippinItem">
                      <p class="feldName">Phone</p>
                      <input
                        class="shippinInput"
                        type="text"
                        placeholder="Your last name"
                        required
                      />
                    </li>
                  </div>

                  <div   style="justify-content: space-between;" class="flex">
                    <li class="shippinItem">
                      <p class="feldName">Country</p>
                      <input
                        class="shippinInput"
                        type="text"
                        placeholder="Your country"
                        required
                      />
                    </li>
                    <li class="shippinItem">
                      <p class="feldName">City</p>
                      <input
                        class="shippinInput"
                        type="text"
                        placeholder="Your city"
                        required
                      />
                    </li>
                  </div>

                  <div   style="justify-content: space-between;" class="flex">
                    <li class="shippinItem">
                      <p class="feldName">Adress</p>
                      <input
                        class="shippinInput"
                        type="text"
                        placeholder="Your address"
                        required
                      />
                    </li>
                    <li class="shippinItem">
                      <p class="feldName">ZIP Code</p>
                      <input
                        class="shippinInput"
                        type="text"
                        placeholder="Your ZIP Code"
                        required
                      />
                    </li>
                  </div>
                </ul>

                <p>
                  <input type="checkbox" /> Billing and Shipping details are the
                  same
                </p>
              </section>
    EOT;

  echo <<<EOT
              <!-- shipping Method Section -->

              <section class="shippingMethodSection">
                <h3 class="captureSmall">3. Shipping Method</h3>
                <ul>
                  <li  style="justify-content: space-between;" style="justify-content: space-between;" class="shippingMethodItem flex">
                    <div>
                      <p class="schippingMehod">
                        <input name= "shippingMethod" value = "25.00" type="radio" checked="checked" />
                        <span class="shippingMethodName">Courier to your address</span>
                      </p>
                      <p class="methodBeschreibung">Estimated date: September 9</p>
                    </div>
                    <p class="preis">$25.00</p>
                  </li>

                  <li  style="justify-content: space-between;" class="shippingMethodItem flex">
                    <div>
                      <p class="schippingMehod">
                        <input name= "shippingMethod" value = "00.00" type="radio" />
                        <span class="shippingMethodName">Pick up from store</span>
                      </p>
                      <p class="methodBeschreibung">Pick up on September 8 from 12:00</p>
                    </div>
                    <p class="preis" >Free</p>
                  </li>

                  <li  style="justify-content: space-between;" class="shippingMethodItem flex">
                    <div><p>
                      <div><input name= "shippingMethod" value = "25.00" type="radio" />
                      <span class="shippingMethodName"
                        >UPS Ground Shipping</span
                      >
                    </p></div>
                    <p class="methodBeschreibung">Up to one week</p></div>
                    <p class="preis">$10.00</p>
                  </li>

                  <li  style="justify-content: space-between;" class="shippingMethodItem flex">
                    <div><p class="schippingMehod">
                      <input name= "shippingMethod" type="radio" />
                      <span class="shippingMethodName">Pick up at Createx Locker</span>
                    </p>
                    <p class="methodBeschreibung">Pick up on September 8 from 12:00</p></div>
                    <p class="preis">$8.50</p>
                  </li>

                  <li  style="justify-content: space-between;" class="shippingMethodItem flex">
                    <div><p class="schippingMehod">
                      <input name= "shippingMethod" type="radio" />
                      <span class="shippingMethodName">Createx Global Export</span>
                    </p>
                    <p class="methodBeschreibung">3-4 days</p></div>
                    <p class="preis">$15.00</p>
                  </li>
                </ul>
              </section>
        

                         
  EOT;
}


function shopNow()
{
  header("location: ./kategorieSite.php?KategorieNR=2");
}
