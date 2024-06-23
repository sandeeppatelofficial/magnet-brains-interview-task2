<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Payment status</title>
</head>

<body>
    <div class="container">
        <div class="row py-5">
            <div class="col-lg-10 col-md-10 col-12">
                <h1 class="">Thanks You</h1>
            </div>
        </div>
        <div class="row">

            <div class="card py-5">
                <table class="table">
                   
                    <tbody>
                        <tr>
                            <th scope="row">Order Code</th>
                            <td><?= $order['order_code'] ?></td>
                           
                        </tr>
                        <tr>
                            <th scope="row">Total Amount</th>
                            <td>₹<?= $order['cart_total'] ?></td>
                           
                        </tr>
                        <tr>
                            <th scope="row">Transaction Id</th>
                            <td><?= $order['trans_id'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Payment status</th>
                            <td><?= $order['payment_status'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>