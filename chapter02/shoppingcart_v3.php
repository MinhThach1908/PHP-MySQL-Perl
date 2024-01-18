<?php
session_start();

// Mảng chứa th?ng tin sản phẩm
$products = array(
    array("id" => 1, "name" => "Áo Polo", "price" => 25),
    array("id" => 2, "name" => "Quần Jeans", "price" => 50),
    array("id" => 3, "name" => "Giầy Sneakers", "price" => 40)
);

// Kiểm tra nếu giỏ h?ng chưa được tạo, th? tạo mới
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// H?m th?m sản phẩm v?o giỏ h?ng
function addToCart($productId)
{
    global $products;

    foreach ($products as $product) {
        if ($product['id'] == $productId) {
            $_SESSION['cart'][] = $product;
            echo "Đã thêm " . $product['name'] . " vào giỏ hàng.";
            return;
        }
    }

    echo "San phẩm không tồn tại.";
}

// Hàm hiển thị giỏ h?ng
function viewCart()
{
    if (empty($_SESSION['cart'])) {
        echo "Giỏ hàng trống.";
    } else {
        echo "<h2>Giỏ hàng của bạn:</h2>";
        $totalPrice = 0;

        foreach ($_SESSION['cart'] as $item) {
            echo $item['name'] . " - $" . $item['price'] . "<br>";
            $totalPrice += $item['price'];
        }

        echo "<strong>Tổng giá trị: $" . $totalPrice . "</strong>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }

        h1, h2 {
            color: #007bff;
        }

        form {
            margin-bottom: 20px;
        }

        button {
            margin-top: 10px;
        }

        p {
            margin-bottom: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Trang mua sắm PHP</h1>

    Form thêm sản phẩm vào giỏ hàng -->
    <form method="post" class="form-inline">
        <div class="form-group mr-2">
             <label for="productId">Chọn sản phẩm:</label>
             <select name ="productId" id="productId">
                 <?php foreach ($products as $product): ?>
                      <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?> - $<?php echo $product['price']; ?></option>
                 <?php endforeach; ?>
             </select>
        </div>
        <button type="submit" name="addToCart">Thêm vào giỏ hàng</button>
    </form>

    <!-- Hiển thị giỏ hàng -->
    <?php
    if (isset($_POST['addToCart']) && isset($_POST['productId'])) {
    addToCart($_POST['productId']);
    }
    ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

