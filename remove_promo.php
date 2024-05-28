<?php
include 'db_connect.php'; // Include database connection

// Function to get the current time from an online time server
function getCurrentTime() {
    $url = 'http://worldtimeapi.org/api/timezone/Etc/UTC'; // You can choose an appropriate timezone
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    if (isset($data['datetime'])) {
        return new DateTime($data['datetime']);
    }
    return false;
}

$currentTime = getCurrentTime();

if ($currentTime) {
    $currentTimeStr = $currentTime->format('Y-m-d H:i:s');
    echo "Current Time: $currentTimeStr\n";

    $query = "SELECT service_id, promo_end_time FROM services WHERE promo_percent > 0";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $serviceId = $row['service_id'];
            $promoEndTime = new DateTime($row['promo_end_time']);
            
            if ($currentTime > $promoEndTime) {
                // Promo has ended, update promo_percent to 0
                $updateQuery = "UPDATE services SET promo_percent = 0 WHERE service_id = ?";
                $stmt = $conn->prepare($updateQuery);
                $stmt->bind_param("i", $serviceId);

                if ($stmt->execute()) {
                    echo "Promo for service ID $serviceId has been reset to 0.\n";
                } else {
                    echo "Error updating promo for service ID $serviceId: " . $stmt->error . "\n";
                }

                $stmt->close();
            }
        }
    } else {
        echo "No active promos found.\n";
    }

    $result->close();
} else {
    echo "Failed to fetch the current time.\n";
}

$conn->close();
?>
