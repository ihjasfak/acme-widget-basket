<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Acme Widget Basket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <h2 class="mb-4">Acme Widgets</h2>
        <div id="product-list" class="row g-4"></div>

        <h3 class="mt-5">Shopping Cart</h3>
        <div id="cart-items" class="mt-3"></div>
        <div class="mt-4">
            <h4>Total: <span id="cart-total">$0.00</span></h4>
            <div id="cart-offers" class="text-success small mt-2"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="cart.js"></script>
</body>

</html>