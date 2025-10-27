<?php
include('db_connect.php');

$sql = "SELECT * FROM customers";
$result = $conn->query($sql);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Online Shopping Management System</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="wrapper">
    <div class="card">
      <div class="content">
        <h1 class="title">Welcome to Online Shopping Management System</h1>
        <p class="subtitle">Customer List</p>

        <div class="section-title">Customers</div>
        <div class="table-wrap">
          <table class="table" aria-describedby="customers">
            <thead>
              <tr>
                <th class="col-id">ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
              </tr>
            </thead>
            <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td class="col-id">'.htmlspecialchars($row['customer_id']).'</td>';
                    echo '<td>'.htmlspecialchars($row['name']).'</td>';
                    echo '<td>'.htmlspecialchars($row['email']).'</td>';
                    echo '<td>'.htmlspecialchars($row['phone']).'</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="4">No customers found</td></tr>';
            }
            ?>
            </tbody>
          </table>
        </div>

        <div class="actions" role="navigation" aria-label="main navigation">
          <a href="orders.php" class="btn">View Orders</a>
          <a href="products.php" class="btn secondary">View Products</a>
          <a href="suppliers.php" class="btn secondary">View Suppliers</a>
        </div>

        <p class="helper">Tip: Use the buttons above to navigate to orders, products, or suppliers.</p>
      </div>
    </div>
  </div>
</body>
</html>

<?php $conn->close(); ?>
