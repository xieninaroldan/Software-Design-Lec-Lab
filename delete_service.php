<?php
// Include the database connection file
include 'db_connect.php';

// Set the default response as an empty array
$response = array();

// Check if the service_id is set and not empty
if (isset($_GET['service_id']) && !empty($_GET['service_id'])) {
    // Sanitize the input to prevent SQL injection
    $service_id = mysqli_real_escape_string($connection, $_GET['service_id']);

    // SQL query to delete the row from the database
    $sql = "DELETE FROM services WHERE service_id = '$service_id'";

    if (mysqli_query($connection, $sql)) {
        // Delete successful
        $response['success'] = true;
        $response['message'] = 'Service deleted successfully.';
    } else {
        // Error in deletion
        $response['success'] = false;
        $response['message'] = 'Error deleting service.';
    }
} else {
    // Invalid input
    $response['success'] = false;
    $response['message'] = 'Invalid input.';
}

// Set the content type header to JSON
header('Content-Type: application/json');

// Output the JSON response
echo json_encode($response);

// Close database connection
mysqli_close($connection);
?>
