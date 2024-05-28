    <?php
    include 'db_connect.php';
    
    // Check if the request method is POST and required parameters are set
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['service_id']) && isset($_POST['service_name']) && isset($_POST['service_description'])) {
        $serviceId = $_POST['service_id'];
        $serviceName = $_POST['service_name'];
        $serviceDescription = $_POST['service_description'];
        $serviceCategory = $_POST['service_category'];

        $imageUploaded = false; // Flag to track if an image was uploaded

        // Check if file was uploaded
        if (isset($_FILES['service_image']) && $_FILES['service_image']['error'] === UPLOAD_ERR_OK) {
            $imageUploaded = true;
            $serviceImageFileName = $serviceId;
    
            $uploadDirectory = 'uploads'; // Assuming this is relative to the script location
            $uploadedFilePath = $uploadDirectory . '/' . $serviceId . '.' . pathinfo($_FILES['service_image']['name'], PATHINFO_EXTENSION);
            
            move_uploaded_file($_FILES['service_image']['tmp_name'], $uploadedFilePath);
       
           
            // Update the image_url column with the file extension only
            $imageExtension = pathinfo($_FILES['service_image']['name'], PATHINFO_EXTENSION);
            $sqlUpdateImage = "UPDATE services SET image_url = ? WHERE service_id = ?";
            $stmtUpdateImage = $connector->prepare($sqlUpdateImage);
            $stmtUpdateImage->bind_param('si', $imageExtension, $serviceId);
            if (!$stmtUpdateImage->execute()) {
                error_log('Error updating image_url column: ' . $stmtUpdateImage->error);
            }   
            $stmtUpdateImage->close();
        }
        // Check if file was set
        /*if (isset($_POST['service_image'])) {
            $serviceImageFileName = $_POST['service_image'];
    
            // Update the image_url column with the file name
            $sqlUpdateImage = "UPDATE services SET image_url = ? WHERE service_id = ?";
            $stmtUpdateImage = $connector->prepare($sqlUpdateImage);
            $stmtUpdateImage->bind_param('si', $serviceImageFileName, $serviceId);
            if (!$stmtUpdateImage->execute()) {
                error_log('Error updating image_url column: ' . $stmtUpdateImage->error);
            }
            $stmtUpdateImage->close();
        }*/
    
        $sql = "UPDATE services SET service_name = ?, service_description = ?, service_category = ?";
        $params = array($serviceName, $serviceDescription, $serviceCategory);
    
        // Update the SQL statement based on service category
        if ($serviceCategory === 'Soft Gel Nail Extensions') {
            $sql .= ", orig_price1 = ?, orig_price2 = ?";
            $params[] = $_POST['service_price_min'];
            $params[] = $_POST['service_price_max'];
        } else {
            $sql .= ", orig_price1 = ?";
            $params[] = $_POST['service_price'];
        }
    
        $sql .= " WHERE service_id = ?";
        $params[] = $serviceId;
    
        // Prepare and execute the SQL statement
        $stmt = $connector->prepare($sql);
    
        // Bind parameters
        $types = str_repeat('s', count($params));
        $stmt->bind_param($types, ...$params);
    
        // Execute the statement
        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'failed';
            error_log('Database update error: ' . $stmt->error);
        }
    
        // Close the statement
        $stmt->close();
    } else {
        echo 'invalid_request';
        error_log('Invalid request: missing required parameters.');
    }
    
    // Close the database connection
    $connector->close();
    ?>
