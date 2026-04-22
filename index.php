<?php
include 'config.php';

$productCount = 0;
$orderCount = 0;
$totalRevenue = 0;

$resultProducts = $conn->query("SELECT COUNT(*) AS total_products FROM products");
if ($resultProducts && $row = $resultProducts->fetch_assoc()) {
    $productCount = $row['total_products'];
}

$resultOrders = $conn->query("SELECT COUNT(*) AS total_orders FROM orders");
if ($resultOrders && $row = $resultOrders->fetch_assoc()) {
    $orderCount = $row['total_orders'];
}

$resultRevenue = $conn->query("SELECT SUM(total) AS total_revenue FROM orders");
if ($resultRevenue && $row = $resultRevenue->fetch_assoc()) {
    $totalRevenue = $row['total_revenue'] ? $row['total_revenue'] : 0;
}

include 'includes/header.php';
?>

<div class="card">
    <h2>Αρχική Σελίδα</h2>
    <p>
        Καλώς ήρθατε στο <strong>Σύστημα Διαχείρισης Κυλικείου</strong>.
        Η εφαρμογή αναπτύχθηκε τοπικά σε περιβάλλον XAMPP με χρήση
        PHP και MySQL για τις ανάγκες του εργαστηριακού project.
    </p>
</div>

<div class="card">
    <h2>Στατιστικά Συστήματος</h2>

    <table>
        <tr>
            <th>Περιγραφή</th>
            <th>Τιμή</th>
        </tr>
        <tr>
            <td>Συνολικά προϊόντα</td>
            <td><?= $productCount; ?></td>
        </tr>
        <tr>
            <td>Συνολικές παραγγελίες</td>
            <td><?= $orderCount; ?></td>
        </tr>
        <tr>
            <td>Συνολικά έσοδα (€)</td>
            <td><?= number_format((float)$totalRevenue, 2); ?></td>
        </tr>
    </table>
</div>

<div class="card">
    <h2>Περιγραφή εφαρμογής</h2>
    <p>
        Από την ενότητα <strong>Προϊόντα</strong> μπορείτε να προσθέσετε και να
        προβάλετε προϊόντα του κυλικείου με δυνατότητα ταξινόμησης βάσει τιμής,
        αποθέματος και ημερομηνίας καταχώρισης.
    </p>
    <br>
    <p>
        Από την ενότητα <strong>Παραγγελίες</strong> μπορείτε να καταχωρίσετε
        νέες παραγγελίες και να δείτε τη συνολική εικόνα των παραγγελιών που
        έχουν αποθηκευτεί στη βάση δεδομένων.
    </p>
</div>

<?php include 'includes/footer.php'; ?>
