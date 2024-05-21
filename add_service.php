<?php
include 'db_connect.php';

// Check if the request method is POST and required parameters are set
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['service_name']) && isset($_POST['service_description'])) {
    $serviceName = $_POST['service_name'];
    $serviceDescription = $_POST['service_description'];
    $serviceCategory = $_POST['service_category'];

    // Prepare the base SQL statement for inserting the service
    $sql = "INSERT INTO services (service_name, service_description, service_category";

    // Determine the fields and parameters based on the service category
    if ($serviceCategory === 'Soft Gel Nail Extensions') {
        $sql .= ", orig_price1, orig_price2";
        $params = array($serviceName, $serviceDescription, $serviceCategory, $_POST['service_price_min'], $_POST['service_price_max']);
    } else {
        $sql .= ", orig_price1";
        $params = array($serviceName, $serviceDescription, $serviceCategory, $_POST['service_price']);
    }

    $sql .= ") VALUES (?, ?, ?";

    if ($serviceCategory === 'Soft Gel Nail Extensions') {
        $sql .= ", ?, ?";
    } else {
        $sql .= ", ?";
    }

    $sql .= ")";

    // Prepare and execute the SQL statement
    $stmt = $connection->prepare($sql);

    // Bind parameters
    $types = str_repeat('s', count($params));
    $stmt->bind_param($types, ...$params);

    // Execute the statement
    if ($stmt->execute()) {
        $serviceId = $stmt->insert_id; // Get the last inserted service ID

        // Check and handle the image upload
        if (isset($_FILES['service_image']) && $_FILES['service_image']['error'] === UPLOAD_ERR_OK) {
            $serviceImageFileName = $serviceId;

            $uploadDirectory = 'uploads'; // Assuming this is relative to the script location
            $uploadedFilePath = $uploadDirectory . '/' . $serviceId . '.' . pathinfo($_FILES['service_image']['name'], PATHINFO_EXTENSION);

            if (move_uploaded_file($_FILES['service_image']['tmp_name'], $uploadedFilePath)) {
                // Update the image_url column with the file extension only
                $imageExtension = pathinfo($_FILES['service_image']['name'], PATHINFO_EXTENSION);
                $sqlUpdateImage = "UPDATE services SET image_url = ? WHERE service_id = ?";
                $stmtUpdateImage = $connection->prepare($sqlUpdateImage);
                $stmtUpdateImage->bind_param('si', $imageExtension, $serviceId);
                if (!$stmtUpdateImage->execute()) {
                    error_log('Error updating image_url column: ' . $stmtUpdateImage->error);
                }
                $stmtUpdateImage->close();
            } else {
                error_log('Error moving uploaded file.');
            }
        }

        echo 'success';
    } else {
        echo 'failed';
        error_log('Database insert error: ' . $stmt->error);
    }

    // Close the statement
    $stmt->close();
} else {
    echo 'invalid_request';
    error_log('Invalid request: missing required parameters.');
}

// Close the database connection
$connection->close();
?>
