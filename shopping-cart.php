<?php

require('app/Customer.php');
require('app/Product.php');
require('app/ShoppingCart.php');
require('app/FileUtility.php');

$products_data = FileUtility::openCSV('products.csv');

$products = Product::convertArrayToProducts($products_data);

$customer = new Customer('John Doe', 'john@mail.com');

$shoppingCart = new ShoppingCart($customer);
$shoppingCartItems = $shoppingCart->getAllItems();
?>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>My Cart</title>
</head>
<body>

<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="products-list.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="https://static.wikia.nocookie.net/animalcrossing/images/f/ff/NH-apple-icon.png" alt="" width="40" height="40" class="d-inline-block align-text-top">
        <span class="fs-4">Leapp</span>
      </a>

      <ul class="nav nav-pills">
        <li class="nav-item"><a href="products-list.php" class="nav-link" aria-current="page">Products</a></li>
        <li class="nav-item"><a href="#" class="nav-link active">Shopping Cart</a></li>
      </ul>
    </header>
</div>

<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Welcome <?php echo $customer->getName() ?>!</h1>
        <p class="lead text-muted">Shopping Cart</p>
        <p>
          <a href="products-list.php" class="btn btn-primary my-2">Shop More Products</a>
        </p>
      </div>
    </div>
</section>

<!-- <h1>Welcome <?php echo $customer->getName() ?>!</h1>
<h2>Shopping Cart</h2>
<h4>
    <a href="products-list.php">Shop More Products</a>
</h4> -->

<?php if (count($shoppingCartItems) > 0): ?>

<div class="album py-5 bg-light">
    <div class="container">

<!--    <table>
    <thead>
        <th>Product</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Subtotal</th>
    </thead>
    <tbody> -->

    <?php foreach ($shoppingCartItems as $item): ?>

        <div class="card" style="width: 18rem;">
          <div class="card-body">
            <h5 class="card-title"><small class="fw-lighter">Product: </small><?php echo $item['product']->getName(); ?></h5>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><small class="fw-lighter">Quantity: </small><?php echo $item['quantity']; ?></li>
            <li class="list-group-item"><small class="fw-lighter">Price: </small><?php echo $item['price']; ?></li>
            <li class="list-group-item"><small class="fw-lighter">Subtotal: </small><?php echo $item['subtotal']; ?></li>
          </ul>
        </div>
        <!--
        <tr>
            <td><?php echo $item['product']->getName(); ?></td>
            <td><?php echo $item['quantity']; ?></td>
            <td><?php echo $item['price']; ?></td>
            <td><?php echo $item['subtotal']; ?></td>
        </tr>
        -->
    <?php endforeach; ?>

        <br />

        <h4 class="text-end"><small class="fw-normal">Total: </small><?php echo $shoppingCart->getItemsTotal(); ?></h4>
<!--
        <tr>
            <td colspan="4">
                <?php echo $shoppingCart->getItemsTotal(); ?>
            </td>
        </tr>

    </tbody>
    </table>
-->

    </div>
</div>

<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>