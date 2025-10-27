<?php
include('db_connect.php');

$sql = "SELECT products.product_id, products.name AS product_name, 
               categories.category_name, products.price
        FROM products
        INNER JOIN categories ON products.category_id = categories.category_id";
$result = $conn->query($sql);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Products</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="wrapper">
   <div class="card">
    <div class="content">
      <h1 class="title">All Products</h1>
      <p class="subtitle">Browse available products</p>

      <div class="table-wrap">
        <table class="table">
          <thead>
            <tr>
              <th class="col-id">Product ID</th>
              <th>Product Name</th>
              <th>Category</th>
              <th>Price (PKR)</th>
            </tr>
          </thead>
          <tbody>
          <?php
          if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo '<tr>';
                  echo '<td class="col-id">'.htmlspecialchars($row['product_id']).'</td>';
                  echo '<td>'.htmlspecialchars($row['product_name']).'</td>';
                  echo '<td>'.htmlspecialchars($row['category_name']).'</td>';
                  echo '<td>'.htmlspecialchars($row['price']).'</td>';
                  echo '</tr>';
              }
          } else {
              echo '<tr><td colspan="4">No products found</td></tr>';
          }
          ?>
          </tbody>
        </table>
      </div>

      <div class="actions">
        <a href="index.php" class="btn secondary">Back to Home</a>
        <a href="orders.php" class="btn">View Orders</a>
        <a href="suppliers.php" class="btn secondary">View Suppliers</a>
      </div>
    </div>
   </div>
  </div>
</body>
</html>

<?php $conn->close(); ?>
