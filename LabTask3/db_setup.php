<?php

$servername = "localhost";
$username   = "root";
$password   = ""; // change if needed

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1) Create database if not exists
$dbname = "onlineshop_lab3";
if (!$conn->query("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci")) {
    die("Database creation failed: " . $conn->error);
}

$conn->select_db($dbname);

// For easy re-run during development: drop tables in correct order
$drop = [
    "DROP TABLE IF EXISTS order_items;",
    "DROP TABLE IF EXISTS orders;",
    "DROP TABLE IF EXISTS suppliers;",
    "DROP TABLE IF EXISTS products;",
    "DROP TABLE IF EXISTS categories;",
    "DROP TABLE IF EXISTS customers;"
];

foreach ($drop as $q) {
    $conn->query($q);
}

// 2) Create tables
$queries = [];

// customers
$queries[] = "CREATE TABLE customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(30)
) ENGINE=InnoDB;";

// categories
$queries[] = "CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL
) ENGINE=InnoDB;";

// products
$queries[] = "CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    category_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;";

// orders
$queries[] = "CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    order_date DATE NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;";

// order_items
$queries[] = "CREATE TABLE order_items (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;";

// suppliers
$queries[] = "CREATE TABLE suppliers (
    supplier_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    contact VARCHAR(120),
    product_id INT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;";

foreach ($queries as $q) {
    if (!$conn->query($q)) {
        die("Table creation failed: " . $conn->error . "\nQuery: " . $q);
    }
}

// 3) Seed data
// Customers (10)
$customers = [
    ['Ali Ahmed', 'ali.ahmed@example.com', '0300-1111111'],
    ['Sara Khan', 'sara.khan@example.com', '0300-2222222'],
    ['Hassan Raza', 'hassan.raza@example.com', '0300-3333333'],
    ['Aisha Qureshi', 'aisha.q@example.com', '0300-4444444'],
    ['Bilal Shah', 'bilal.shah@example.com', '0300-5555555'],
    ['Fatima Noor', 'fatima.noor@example.com', '0300-6666666'],
    ['Omar Siddiqui', 'omar.s@example.com', '0300-7777777'],
    ['Nida Iqbal', 'nida.iqbal@example.com', '0300-8888888'],
    ['Usman Tariq', 'usman.t@example.com', '0300-9999999'],
    ['Zainab Mir', 'zainab.m@example.com', '0312-0000000']
];

$stmt = $conn->prepare("INSERT INTO customers (name,email,phone) VALUES (?,?,?)");
foreach ($customers as $c) {
    $stmt->bind_param('sss', $c[0], $c[1], $c[2]);
    $stmt->execute();
}
$stmt->close();

// Categories (5)
$cats = ['Electronics','Clothing','Home & Kitchen','Books','Sports'];
$stmt = $conn->prepare("INSERT INTO categories (category_name) VALUES (?)");
foreach ($cats as $cat) {
    $stmt->bind_param('s', $cat);
    $stmt->execute();
}
$stmt->close();

// Products (5) -> note category_id will be 1..5 in order inserted
$products = [
    ['Smartphone Model X', 54999.00, 1],
    ['Men\'s Denim Jacket', 3999.00, 2],
    ['Stainless Steel Kettle', 2499.00, 3],
    ['Learning PHP Book', 899.00, 4],
    ['Yoga Mat', 1299.00, 5]
];
$stmt = $conn->prepare("INSERT INTO products (name,price,category_id) VALUES (?,?,?)");
foreach ($products as $p) {
    $stmt->bind_param('sdi', $p[0], $p[1], $p[2]);
    $stmt->execute();
}
$stmt->close();

// Suppliers (3) -- product_id references the products inserted above (IDs 1..5)
$suppliers = [
    ['TechSource', '021-555-0101', 1],
    ['FashionHub', '021-555-0202', 2],
    ['HomeEssentials', '021-555-0303', 3]
];
$stmt = $conn->prepare("INSERT INTO suppliers (name,contact,product_id) VALUES (?,?,?)");
foreach ($suppliers as $s) {
    $stmt->bind_param('ssi', $s[0], $s[1], $s[2]);
    $stmt->execute();
}
$stmt->close();

// Orders (5) and associated order_items
// We'll create 5 orders for existing customers; order_date set explicitly
$orders = [
    // order_id will be auto; associate order_items after inserting each order
    ['customer_id' => 1, 'order_date' => '2025-10-01', 'items' => [[1,1],[4,2]]], // Ali buys 1 smartphone, 2 books
    ['customer_id' => 2, 'order_date' => '2025-10-03', 'items' => [[2,1],[5,1]]], // Sara buys jacket + mat
    ['customer_id' => 3, 'order_date' => '2025-10-05', 'items' => [[3,2]]],        // Hassan buys 2 kettles
    ['customer_id' => 4, 'order_date' => '2025-10-07', 'items' => [[4,1]]],        // Aisha buys book
    ['customer_id' => 5, 'order_date' => '2025-10-09', 'items' => [[5,3],[2,1]]]  // Bilal buys 3 mats + jacket
];

$stmtOrder = $conn->prepare("INSERT INTO orders (customer_id,order_date) VALUES (?,?)");
$stmtItem  = $conn->prepare("INSERT INTO order_items (order_id,product_id,quantity) VALUES (?,?,?)");

foreach ($orders as $o) {
    $stmtOrder->bind_param('is', $o['customer_id'], $o['order_date']);
    $stmtOrder->execute();
    $order_id = $stmtOrder->insert_id;
    foreach ($o['items'] as $it) {
        $prod_id = $it[0];
        $qty = $it[1];
        $stmtItem->bind_param('iii', $order_id, $prod_id, $qty);
        $stmtItem->execute();
    }
}

$stmtOrder->close();
$stmtItem->close();

echo "Database '$dbname' & tables created and seeded successfully.\n";

// Close connection
$conn->close();
?>
