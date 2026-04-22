<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);

    if (!empty($name) && !empty($category) && $price >= 0 && $stock >= 0) {
        $stmt = $conn->prepare("INSERT INTO products (name, category, price, stock) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssdi", $name, $category, $price, $stock);
        $stmt->execute();
        $stmt->close();

        header("Location: products.php?success=1");
        exit();
    }
}

$order = "id DESC";
$allowedSorts = [
    'price_asc'  => 'price ASC',
    'price_desc' => 'price DESC',
    'stock_asc'  => 'stock ASC',
    'stock_desc' => 'stock DESC',
    'date_asc'   => 'created_at ASC',
    'date_desc'  => 'created_at DESC'
];

if (isset($_GET['sort']) && array_key_exists($_GET['sort'], $allowedSorts)) {
    $order = $allowedSorts[$_GET['sort']];
}

$sql = "SELECT id, name, category, price, stock, created_at FROM products ORDER BY $order";
$result = $conn->query($sql);

include 'includes/header.php';
?>

<div class="card">
    <h2>Προϊόντα</h2>
    <p>Από αυτή τη σελίδα μπορείτε να προσθέσετε προϊόντα και να δείτε τη λίστα τους.</p>

    <?php if (isset($_GET['success'])): ?>
        <div style="background: rgba(0, 180, 90, 0.20); color: #d8ffe7; padding: 12px; border-radius: 10px; margin-bottom: 15px;">
            Το προϊόν αποθηκεύτηκε επιτυχώς.
        </div>
    <?php endif; ?>

    <form method="POST" action="products.php">
        <label>Όνομα προϊόντος</label>
        <input type="text" name="name" required>

        <label>Κατηγορία</label>
        <input type="text" name="category" required>

        <label>Τιμή (€)</label>
        <input type="number" name="price" step="0.01" min="0" required>

        <label>Απόθεμα</label>
        <input type="number" name="stock" min="0" required>

        <button type="submit">Αποθήκευση</button>
    </form>
</div>

<div class="card">
    <h2>Λίστα προϊόντων</h2>

    <div class="filters" style="margin-bottom: 20px;">
        <a class="btn" href="products.php?sort=price_asc">Τιμή ↑</a>
        <a class="btn" href="products.php?sort=price_desc">Τιμή ↓</a>
        <a class="btn" href="products.php?sort=stock_asc">Απόθεμα ↑</a>
        <a class="btn" href="products.php?sort=stock_desc">Απόθεμα ↓</a>
        <a class="btn" href="products.php?sort=date_asc">Ημερομηνία ↑</a>
        <a class="btn" href="products.php?sort=date_desc">Ημερομηνία ↓</a>
        <a class="btn" href="products.php">Καθαρισμός</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Προϊόν</th>
            <th>Κατηγορία</th>
            <th>Τιμή (€)</th>
            <th>Απόθεμα</th>
            <th>Ημερομηνία</th>
        </tr>

        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['category']); ?></td>
                    <td><?= number_format((float)$row['price'], 2); ?></td>
                    <td><?= $row['stock']; ?></td>
                    <td><?= !empty($row['created_at']) ? date("d/m/Y H:i", strtotime($row['created_at'])) : '-'; ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Δεν υπάρχουν προϊόντα.</td>
            </tr>
        <?php endif; ?>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
