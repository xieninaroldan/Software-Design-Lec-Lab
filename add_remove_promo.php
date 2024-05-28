<?php
include 'db_connect.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serviceId = $_POST['serviceId'];
    $promoPercent = $_POST['promoPercent'];
    $promoEndTime = isset($_POST['promoEndTime']) ? $_POST['promoEndTime'] : null;

    // Debugging output
    echo "Received serviceId: $serviceId, promoPercent: $promoPercent, promoEndTime: $promoEndTime\n";

    // Validate input
    if (isset($serviceId) && isset($promoPercent) && is_numeric($promoPercent) && $promoPercent >= 0 && $promoPercent <= 100) {
        // Prepare the SQL query
        if ($promoEndTime) {
            $promoEndTime = str_replace('T', ' ', $promoEndTime); // Convert to 'YYYY-MM-DD HH:MM'
            $query = "UPDATE services SET promo_percent = ?, promo_end_time = ? WHERE service_id = ?";
            $stmt = $connector->prepare($query);
            $stmt->bind_param("dsi", $promoPercent, $promoEndTime, $serviceId);
        } else {
            $query = "UPDATE services SET promo_percent = ?, promo_end_time = NULL WHERE service_id = ?";
            $stmt = $connector->prepare($query);
            $stmt->bind_param("di", $promoPercent, $serviceId);
        }

        // Execute the statement
        if ($stmt->execute()) {
            echo 'Promo updated successfully';
        } else {
            http_response_code(500);
            echo 'Error executing statement: ' . $stmt->error;
        }

        $stmt->close();
    } else {
        http_response_code(400);
        echo 'Invalid input';
    }

    $connector->close();
}
?>
