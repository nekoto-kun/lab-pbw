<?php
require_once('data.php');
require_once('models/product.php');
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

  <title>BT Peripherals</title>

  <style>
    .card>img {
      object-fit: cover;
      object-position: center;
      height: 240px;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <div class="d-flex flex-row">
      <div class="flex-fill">
        <h1>BT Peripherals</h1>
        <h4>Products count: <?= Product::getCount() ?></h4>
      </div>
      <div class="justify-content-end align-self-center">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProduct">Add Product</button>
      </div>
    </div>

    <form action="confirm.php" method="post">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 mt-5">
        <?php
        foreach ($products as $product) : ?>
          <div class="col mb-3">
            <div class="card">
              <img src="<?= $product->getImage() ?>" class="card-img-top img-fluid">
              <div class="card-body">
                <h5 class="card-title">
                  <a href="show.php?name=<?= $product->getName() ?>"><?= $product->getName() ?></a>
                </h5>
                <h6 class="card-subtitle text-muted price"><?= $product->getPriceVAT() ?></h6>
                <p>
                  <?php if ($product instanceof Processor) : ?>
                    <span class="badge bg-primary">
                      <?= $product->getCores() ?> core(s)
                    </span>
                  <?php elseif ($product instanceof RAM) : ?>
                    <span class="badge bg-success">
                      <?= $product->getSize() ?>
                    </span>
                  <?php elseif ($product instanceof Storage) : ?>
                    <span class="badge bg-danger">
                      <?= $product->getType() ?>
                    </span>
                  <?php elseif ($product instanceof VGA) : ?>
                    <span class="badge bg-warning">
                      <?= $product->getSize() ?>
                    </span>
                  <?php endif ?>
                </p>
              </div>
              <div class="card-footer">
                <input type="text" value="0" name="<?= $product->getName() ?>" class="form-control" placeholder="Quantity">
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
      <button type="submit" class="btn btn-primary">Order</button>
    </form>
  </div>

  <!-- Add product modal -->
  <div class="modal fade" id="addProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addProductLabel">Add new product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="process.php" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="productName" placeholder="Product name" name="name" required>
              <label for="productName" class="form-label">Product name</label>
            </div>
            <div class="mb-3">
              <label for="productPrice" class="form-label">Price</label>
              <div class="input-group">
                <span class="input-group-text" id="productPrice">Rp</span>
                <input type="number" class="form-control" placeholder="Price" aria-label="Price" aria-describedby="productPrice" min="0" name="price" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="productImageUrl" class="form-label">Image URL</label>
              <div class="input-group">
                <span class="input-group-text" id="productImageUrl"><i class="fa fa-link"></i></span>
                <input type="text" class="form-control" placeholder="URL" aria-label="URL" aria-describedby="productImageUrl" name="imageUrl" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="productCategory" class="form-label">Category</label>
              <select class="form-select" aria-label="Category" id="productCategory" name="category">
                <option value="" selected>Choose a category</option>
                <option value="processor">Processor</option>
                <option value="storage">Storage</option>
                <option value="memory">Memory</option>
                <option value="vga">VGA</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Confirm</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <script>
    const formatter = new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'IDR'
    });

    const elements = document.querySelectorAll('.price');

    [...elements].forEach((element) => {
      element.innerHTML = formatter.format(element.innerHTML);
    });
  </script>
</body>

</html>