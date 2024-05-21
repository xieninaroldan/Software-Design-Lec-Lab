<?php

include 'db_connect.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serviceId = $_POST['serviceId'];
    $promoPercent = $_POST['promoPercent'];

    // Debugging output
    echo "Received serviceId: $serviceId and promoPercent: $promoPercent\n";

    // Validate input
    if (isset($serviceId) && isset($promoPercent) && is_numeric($promoPercent) && $promoPercent >= 0 && $promoPercent <= 100) {
        // Update the database with the new promo percentage
        $stmt = $connection->prepare("UPDATE services SET promo_percent = ? WHERE service_id = ?");
        if ($stmt === false) {
            http_response_code(500);
            echo "Error preparing statement: " . $connection->error;
            exit;
        }
        
        $stmt->bind_param("is", $promoPercent, $serviceId);
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

    $connection->close();
}
?>
