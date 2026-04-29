<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = trim($_POST['customer_name']);
    $total = floatval($_POST['total']);

    if (!empty($customer_name) && $total >= 0) {
        $stmt = $conn->prepare("INSERT INTO orders (customer_name, total) VALUES (?, ?)");
        $stmt->bind_param("sd", $customer_name, $total);
        $stmt->execute();
        $stmt->close();

        header("Location: orders.php?success=1");
        exit();
    }
}

$order = "id DESC";
$allowedSorts = [
    'total_asc'  => 'total ASC',
    'total_desc' => 'total DESC',
    'date_asc'   => 'created_at ASC',
    'date_desc'  => 'created_at DESC',
    'name_asc'   => 'customer_name ASC',
    'name_desc'  => 'customer_name DESC'
];

if (isset($_GET['sort']) && array_key_exists($_GET['sort'], $allowedSorts)) {
    $order = $allowedSorts[$_GET['sort']];
}

$sql = "SELECT id, customer_name, total, created_at FROM orders ORDER BY $order";
$result = $conn->query($sql);

include 'includes/header.php';
?>

<div class="card">
    <h2>Παραγγελίες</h2>
    <p>Καταχώριση και προβολή παραγγελιών.</p>

    <?php if (isset($_GET['success'])): ?>
        <div style="background: rgba(0, 180, 90, 0.20); color: #d8ffe7; padding: 12px; border-radius: 10px; margin-bottom: 15px;">
            Η παραγγελία αποθηκεύτηκε επιτυχώς.
        </div>
    <?php endif; ?>

    <form method="POST" action="orders.php">
        <label>Όνομα πελάτη</label>
        <input type="text" name="customer_name" required>

        <label>Σύνολο (€)</label>
        <input type="number" name="total" step="0.01" min="0" required>

        <button type="submit">Αποθήκευση</button>
    </form>
</div>

<div class="card">
    <h2>Λίστα παραγγελιών</h2>

    <div class="filters">
        <a class="btn" href="orders.php?sort=name_asc">Όνομα Α-Ω</a>
        <a class="btn" href="orders.php?sort=name_desc">Όνομα Ω-Α</a>
        <a class="btn" href="orders.php?sort=total_asc">Σύνολο ↑</a>
        <a class="btn" href="orders.php?sort=total_desc">Σύνολο ↓</a>
        <a class="btn" href="orders.php?sort=date_asc">Ημερομηνία ↑</a>
        <a class="btn" href="orders.php?sort=date_desc">Ημερομηνία ↓</a>
        <a class="btn" href="orders.php">Καθαρισμός</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Πελάτης</th>
            <th>Σύνολο (€)</th>
            <th>Ημερομηνία</th>
        </tr>

        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['customer_name']); ?></td>
                    <td><?= number_format((float)$row['total'], 2); ?></td>
                    <td>
                        <?= !empty($row['created_at']) ? date("d/m/Y H:i", strtotime($row['created_at'])) : '-'; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Δεν υπάρχουν παραγγελίες.</td>
            </tr>
        <?php endif; ?>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
