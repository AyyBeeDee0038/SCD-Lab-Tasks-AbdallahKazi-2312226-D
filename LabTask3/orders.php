<?php
include('db_connect.php');

$sql = "SELECT orders.order_id, customers.name AS customer_name, orders.order_date, 
               SUM(order_items.quantity) AS total_quantity
        FROM orders
        INNER JOIN customers ON orders.customer_id = customers.customer_id
        INNER JOIN order_items ON orders.order_id = order_items.order_id
        GROUP BY orders.order_id";
$result = $conn->query($sql);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Orders</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="wrapper">
   <div class="card">
    <div class="content">
      <h1 class="title">All Orders</h1>
      <p class="subtitle">Overview of customer orders</p>

      <div class="table-wrap">
        <table class="table">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Customer Name</th>
              <th>Order Date</th>
              <th>Total Quantity</th>
            </tr>
          </thead>
          <tbody>
          <?php
          if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo '<tr>';
                  echo '<td>'.htmlspecialchars($row['order_id']).'</td>';
                  echo '<td>'.htmlspecialchars($row['customer_name']).'</td>';
                  echo '<td>'.htmlspecialchars($row['order_date']).'</td>';
                  echo '<td>'.htmlspecialchars($row['total_quantity']).'</td>';
                  echo '</tr>';
              }
          } else {
              echo '<tr><td colspan="4">No orders found</td></tr>';
          }
          ?>
          </tbody>
        </table>
      </div>

      <div class="actions">
        <a href="index.php" class="btn secondary">Back to Home</a>
        <a href="products.php" class="btn">View Products</a>
        <a href="suppliers.php" class="btn secondary">View Suppliers</a>
      </div>
    </div>
   </div>
  </div>
</body>
</html>

<?php $conn->close(); ?>
