<?php

require('app/Customer.php');
require('app/Product.php');
require('app/FileUtility.php');

$products_data = FileUtility::openCSV('products.csv');

$products = Product::convertArrayToProducts($products_data);

$customer = new Customer('John Doe', 'john@mail.com');
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
      <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="https://static.wikia.nocookie.net/animalcrossing/images/f/ff/NH-apple-icon.png" alt="" width="40" height="40" class="d-inline-block align-text-top">
        <span class="fs-4">Leapp</span>
      </a>

      <ul class="nav nav-pills">
        <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Products</a></li>
        <li class="nav-item"><a href="shopping-cart.php" class="nav-link">Shopping Cart</a></li>
      </ul>
    </header>
</div>

<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Welcome <?php echo $customer->getName() ?>!</h1>
        <p class="lead text-muted">Products</p>
        <p>
          <a href="shopping-cart.php" class="btn btn-primary my-2">Shopping Cart</a>
        </p>
      </div>
    </div>
</section>

<!--<h1>Welcome <?php echo $customer->getName() ?>!</h1>
<h2>Products</h2>
 <h4>
    <a href="shopping-cart.php">Shopping Cart</a>
</h4> -->

<div class="album py-5 bg-light">
    <div class="container">

<?php foreach ($products as $product): ?>

<form action="add-to-cart.php" method="POST">
    <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>" />
    <div class="card" style="width: 18rem;">
      <img src="<?php echo $product->getImage(); ?>" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><?php echo $product->getName(); ?></h5>
        <p class="card-text"><?php echo $product->getDescription(); ?></p>
        <div class="d-flex justify-content-between align-items-center">
            <small class="fw-bold">PHP <?php echo $product->getPrice(); ?></small>
            <div class="input-group">
                <input type="number" name="quantity" class="quantity form-control form-control-sm" placeholder="Qty" aria-label="Qty" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary btn-sm" type="submit" id="button-addon2">Add to Cart</button>
            </div>
        </div>
      </div>
    </div>
</form>

<!-- <form action="add-to-cart.php" method="POST">
    <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>" />
    <h3><?php echo $product->getName(); ?></h3>
    <img src="<?php echo $product->getImage(); ?>" height="100px" />
    <p>
        <?php echo $product->getDescription(); ?><br/>
        <span style="color: blue">PHP <?php echo $product->getPrice(); ?></span>
        Qty <input type="number" name="quantity" class="quantity" value="0" />
        <button type="submit">
            ADD TO CART
        </button>
    </p>
</form> -->

<?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>