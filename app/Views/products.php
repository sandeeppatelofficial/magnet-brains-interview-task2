<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Product Listing Page</title>
</head>

<body>
  <div class="container">
    <div class="row py-5">
      <div class="col-lg-10 col-md-10 col-12">
        <h1 class="">Product Listing Page</h1>
      </div>
      <div class="col-lg-2 col-md-2 col-12">
        <a href="<?= base_url('carts') ?>" class="btn btn-primary">View Cart</a>
      </div>


    </div>
    <div class="row">
      <?php
      if ($products) {
        foreach ($products as $product) {
          echo '
        <div class="col-lg-3 col-md-3 col-sm-12">
        <div class="card" style="width: 18rem;">
          <img src="' . $product["image"] . '" class="card-img-top" alt="' . $product["title"] . '" style="height:200px;">
          <div class="card-body">
            <h5 class="card-title">' . $product["title"] . '</h5>
            <p class="card-text">' . substr($product["description"], 0, 200) . '</p>
            <div class="d-flex justify-content-between">
            <a href="javascript:void(0);" onclick="add_to_cart(' . $product["id"] . ')" class="btn btn-primary">Add to Cart</a>
             <div><span class="badge bg-danger">₹' . $product["price"] . '</span></div>
             </div>
          </div>
        </div>
      </div>
      ';
        }
      }else{
        
        echo "<h3>Products is Empty</h3>";
      }

      ?>
    </div>
  </div>


  <!-- Optional JavaScript; choose one of the two! -->


  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    function add_to_cart(id) {
      if (id > 0) {
        $.ajax({
          url: '<?= base_url('add_to_cart') ?>',
          type: 'POST',
          data: {
            'id': id,
          },
          success: function(response) {
            if (response == 0) {
              alert('Product Remove to cart');
            } else {
              alert('Product added to cart successfully');
            }
          }
        });
      } else {
        alert("Invalid product id");
      }

    }
  </script>
</body>

</html>