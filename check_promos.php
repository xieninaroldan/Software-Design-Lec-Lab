<?php
include 'db_connect.php'; // Include database connection

// Function to get the current time from an online time server in the Philippines timezone
function getCurrentTime() {
    $url = 'http://worldtimeapi.org/api/timezone/Asia/Manila'; // Philippines timezone
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
    echo "Current Time in Philippines: $currentTimeStr\n";

    // Update promo_percent to 0 for promos where promo_end_time is past the current time
    $query = "UPDATE services SET promo_percent = 0 WHERE promo_end_time <= ? AND promo_percent > 0";
    $stmt = $connector->prepare($query);
    $stmt->bind_param("s", $currentTimeStr);

    if ($stmt->execute()) {
        echo 'Promos updated successfully';
    } else {
        echo 'Error updating promos: ' . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Failed to fetch the current time.\n";
}

$connector->close();
?>
