<?php
include('db_connect.php');

$sql = "SELECT suppliers.name AS supplier_name, suppliers.contact, 
               products.name AS product_supplied
        FROM suppliers
        INNER JOIN products ON suppliers.product_id = products.product_id";
$result = $conn->query($sql);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Suppliers</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="wrapper">
   <div class="card">
    <div class="content">
      <h1 class="title">All Suppliers</h1>
      <p class="subtitle">Supplier contacts and supplied products</p>

      <div class="table-wrap">
        <table class="table">
          <thead>
            <tr>
              <th>Supplier Name</th>
              <th>Contact</th>
              <th>Product Supplied</th>
            </tr>
          </thead>
          <tbody>
          <?php
          if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo '<tr>';
                  echo '<td>'.htmlspecialchars($row['supplier_name']).'</td>';
                  echo '<td>'.htmlspecialchars($row['contact']).'</td>';
                  echo '<td>'.htmlspecialchars($row['product_supplied']).'</td>';
                  echo '</tr>';
              }
          } else {
              echo '<tr><td colspan="3">No suppliers found</td></tr>';
          }
          ?>
          </tbody>
        </table>
      </div>

      <div class="actions">
        <a href="index.php" class="btn secondary">Back to Home</a>
        <a href="orders.php" class="btn">View Orders</a>
        <a href="products.php" class="btn secondary">View Products</a>
      </div>
    </div>
   </div>
  </div>
</body>
</html>

<?php $conn->close(); ?>
