     <!DOCTYPE html>
     <html lang="en">
     <head>
         
         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="icon" href="Logo.png">
         
         <title>Zion Colors | Services</title>
         
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
         <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface|Poppins">
         <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Spectral|Rubik">
         <style>
             body {
                 font-family: Poppins, sans-serif;
                 margin: 0;
                 padding: 0;
                 background: linear-gradient(to right, #FDFD96, #F8C8DC); /* Yellow to Pink gradient */
             }
             header {
                 background: linear-gradient(to right, #ff66a3, #CF9FFF); /* Fuchsia Pink to Purple gradient */
                 padding: 20px 0;
                 text-align: center;
             }
             header h1 {
                 font-family: 'Abril Fatface', serif;
                 margin: 0;
                 color: #fff;
                 font-size: 40px;
                 letter-spacing: 2px;
             }
             nav {
                 background-color: #ff66a3;
                 padding: 10px 0;
                 text-align: center;
             }
             nav ul {
                 margin: 0;
                 padding: 0;
                 list-style: none;
             }
             nav ul li {
                 display: inline;
                 margin: 0 10px;
             }
             nav ul li a {
                 color: #fff;
                 text-decoration: none;
                 font-size: 18px;
             }
             nav ul li a.active {
                 background-color: #fff; /* Change to your desired active background color */
                 color: #ff66a3; /* Change to your desired active text color */
                 border-radius: 15px;
                 padding: 5px;
             }

             .container-service {
                 max-width: 900px;
                 margin: 20px auto; /* Add margin to center the content */
                 padding: 20px;
             }
             .container-service h2 {
                    max-width: 900px;
                    font-family: Spectral, serif;
                    font-size: 40px;
                    color: #ff66a3;
                }
            .container-service h3 {
                    font-style: italic; 
                    text-decoration: underline;
            }
             footer {
                 background: linear-gradient(to right, #ff66a3, #CF9FFF); /* Fuchsia Pink to Purple gradient */
                 padding: 20px 0;
                 text-align: center;
                 color: #fff;
             }
             .service-img {
                 width: 200px;
                 height: 200px;
                 margin-right: 20px;
                 margin-bottom: 20px;
                 float: left;
                 border-radius: 50%;
             }
             .service-description {
                 margin-left: 130px; /* Adjusted margin to align with the service name */
             }
             .service-price {
                 margin-left: 130px; /* Adjusted margin to align with the service name */
                 color: #555; /* Adjusted color for better visibility */
             }
             #addServiceCategory option:first-child {
             display: none;
             }
         </style>
     </head>
     <body>
         <div class="container-service">
             <!-- Service list -->
             <h2><center>Services Offered</center></h2>
             <br>
             
             <!-- Service items with edit and delete buttons -->
             <ul id="service-list">
                 <!-- Service items will be dynamically added here -->
                 
                 <?php
     include 'db_connect.php';
 
     // Fetch services from the database, sorted by service_id
     $sql = "SELECT * FROM services ORDER BY service_id ASC";
     $result = $connector->query($sql);
 
     if ($result->num_rows > 0) {
         // Initialize category variables
         $softGelNailExtensions = '';
         $gelOverlay = '';
         $others = '';
 
         // Output data of each row
         while ($row = $result->fetch_assoc()) {
             // Determine category and update corresponding variable
             if ($row['service_category'] == 'Soft Gel Nail Extensions') {
                 $softGelNailExtensions .= displayService($row);
             } elseif ($row['service_category'] == 'Gel Overlay') {
                 $gelOverlay .= displayService($row);
             } else {
                 $others .= displayService($row);
             }
         }
 
         // Display categories
         if (!empty($softGelNailExtensions)) {
             echo '<br><h3>Soft Gel Nail Extensions</h3><br>' . $softGelNailExtensions;
         }
         if (!empty($gelOverlay)) {
             echo '<br><h3>Gel Overlay</h3><br>' . $gelOverlay;
         }
         if (!empty($others)) {
             echo '<br><h3>Others</h3><br>' . $others;
         }
     } else {
         echo "No services found.";
     }
 
     $connector->close();
 
     // Function to display service details
     function displayService($row) {
         $orig_price1 = str_replace('₱', '', $row['orig_price1']);
         $orig_price2 = str_replace('₱', '', $row['orig_price2']);
 
         $promo_percent = isset($row['promo_percent']) ? $row['promo_percent']: 0;
         $orig_price1 = is_numeric($orig_price1) ? $orig_price1: 0 ;
         $orig_price2 = is_numeric($orig_price2) ? $orig_price2: 0 ;
         $promo_percent = is_numeric($promo_percent) ? $promo_percent : 0;
         $discounted_price1 = $orig_price1 - ($orig_price1 * $promo_percent / 100);
         $discounted_price2 = $orig_price2 - ($orig_price2 * $promo_percent / 100);
         $price ='';
         $price1 = '';
 
         /*echo "Orig Price 1: $orig_price1<br>";
         echo "Orig Price 2: $orig_price2<br>";
         echo "Promo Percent: $promo_percent<br>";*/
         // Check if the service is in the Soft Gel Nail Extensions category
         if ($row['service_category'] == 'Soft Gel Nail Extensions') {
             if ($promo_percent > 0) {
                 $price .= '<span><s>₱' . $orig_price1 . ' - ₱' . $orig_price2 . '</s> <strong>₱' . $discounted_price1 . ' - ₱' . $discounted_price2 . '</strong></span>';
                 $price1 .= '<span>' . $promo_percent . '% OFF</span>';
             } else {
                 $price.= '<span>₱' . $orig_price1 . ' - ₱' . $orig_price2 . '</span>';
             }
         }
         else {
             if ($promo_percent > 0) {
                 $price .= '<span><s>₱' . $orig_price1 . '</s> <strong>₱' . $discounted_price1 . '</strong></span>';
                 $price1 .= '<span>' . $promo_percent . '% OFF</span>';
             } else {
                 $price .= '<span>₱' . $orig_price1 . '</span>';
             }
         }
     
         // Retrieve the image URL from the database
         $imageFileName = $row['service_id'] . '.' . $row['image_url']; // Assuming 'service_id' is the column name for service IDs and 'image_url' is the column name for image file names
         $imageSrc = 'http://localhost/Zion%20Database/modules/uploads/' . $imageFileName; // Adjust the URL as needed
         return <<<HTML
         <li id="service{$row['service_id']}" data-service-id="{$row['service_id']}" data-service-name="{$row['service_name']}" data-service-price="{$row['orig_price1']}" data-service-price-max="{$row['orig_price2']}" data-service-category="{$row['service_category']}" data-service-description="{$row['service_description']}" data-service-image="{$imageSrc}">
             <img class="service-img" src="{$imageSrc}" alt="{$row['service_name']}">
             <div class="service-description">
                 <strong>{$row['service_name']}:</strong><br>
                 {$row['service_description']}
             </div>
             <div class="service-price" id="service{$row['service_id']}-price">
                 <br><span>{$price}</span><br>
                 <span>{$price1}</span>
                 
             </div>
             <br>
             <div>
                 <button class="btn btn-info" onclick="addPromo('{$row['service_id']}')">+ Add/ 🗑Remove Promo</button>
                 <button class="btn btn-secondary" onclick="editService({$row['service_id']})">✎ Edit</button>
                 <button class="btn btn-danger" onclick="openDeleteConfirmationModal('service{$row['service_id']}')">🗑Delete</button>
             </div>
         </li>
         <br><br><br>
     HTML;
     }
     
     ?>
 <button class="btn btn-success" data-toggle="modal" data-target="#addServiceModal">+ Add New Services</button>
 </div>
             <!-- Modals for editing, adding service, and adding promo -->
             <!-- Add/Edit/Delete Modal -->
             <div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="serviceModalLabel">Edit Service</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form id="editServiceForm" enctype="multipart/form-data">
                     <input type="hidden" id="editServiceId">
                     <input type="hidden" id="serviceCategory">
                     <div class="form-group">
                         <label for="serviceName">Service Name:</label>
                         <input type="text" class="form-control" id="serviceName">
                     </div>
                     <div id="servicePriceGroup" class="form-group">
                         <label for="servicePrice">Service Price:</label>
                         <input type="text" class="form-control" id="servicePrice">
                     </div>
                     <div id="servicePriceMinGroup" class="form-group" style="display:none;">
                         <label for="servicePriceMin">Service Price Min:</label>
                         <input type="text" class="form-control" id="servicePriceMin">
                     </div>
                     <div id="servicePriceMaxGroup" class="form-group" style="display:none;">
                         <label for="servicePriceMax">Service Price Max:</label>
                         <input type="text" class="form-control" id="servicePriceMax">
                     </div>
                     <div class="form-group">
                         <label for="serviceDescription">Service Description:</label>
                         <textarea class="form-control" id="serviceDescription" rows="3"></textarea>
                     </div>
                     <div class="form-group">
                         <label for="serviceImage">Service Image:</label>
                         <input type="file" class="form-control-file" id="serviceImage">
                     </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-primary" id="saveServiceButton" onclick="saveService()">Save changes</button>
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>
 <!-- Add Service Modal -->
 <div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog" aria-labelledby="addServiceModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="addServiceModalLabel">Add New Service</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form id="addServiceForm">
                     <div class="form-group" enctype="multipart/form-data">
                         <label for="addServiceCategory">Service Category:</label>
                         <select class="form-control" id="addServiceCategory" onchange="togglePriceFields()">
                             <option value="" disabled selected>Select Service Category</option>
                             <option value="Soft Gel Nail Extensions">Soft Gel Nail Extensions</option>
                             <option value="Gel Overlay">Gel Overlay</option>
                             <option value="Others">Others</option>
                         </select>
                     </div>
                     <div class="form-group">
                         <label for="serviceName">Service Name:</label>
                         <input type="text" class="form-control" id="serviceName1">
                     </div>
                     <div id="servicePriceGroup1" class="form-group">
                         <label for="servicePrice">Service Price:</label>
                         <input type="text" class="form-control" id="servicePrice1">
                     </div>
                     <div id="servicePriceMinGroup1" class="form-group" style="display:none;">
                         <label for="servicePriceMin">Service Price Min:</label>
                         <input type="text" class="form-control" id="servicePriceMin1">
                     </div>
                     <div id="servicePriceMaxGroup1" class="form-group" style="display:none;">
                         <label for="servicePriceMax">Service Price Max:</label>
                         <input type="text" class="form-control" id="servicePriceMax1">
                     </div>
                     <div class="form-group">
                         <label for="serviceDescription">Service Description:</label>
                         <textarea class="form-control" id="serviceDescription1" rows="3"></textarea>
                     </div>
                     <div class="form-group">
                         <label for="serviceImage">Service Image:</label>
                         <input type="file" class="form-control-file" id="serviceImage1">
                     </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-primary" onclick="addService()">Add Service</button>
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>
 <!-- Confirmation Modal -->
 <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmation</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 Are you sure you want to delete the service?
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-danger" id="confirmDeleteButton" onclick="deleteServiceConfirmed()">Delete</button>
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
             </div>
         </div>
     </div>
 </div>
<!-- Modal HTML -->
<div class="modal fade" id="promoModal" tabindex="-1" aria-labelledby="promoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="promoModalLabel">Add Promo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" id="serviceId" name="serviceId">
          <div class="mb-3">
            <label for="promoPercent" class="form-label">Promo Percent</label>
            <input type="number" class="form-control" id="promoPercent" name="promoPercent" min="0" max="100" required>
          </div>
          <div class="mb-3">
            <label for="promoEndTime" class="form-label">Promo End Time (Optional)</label>
            <input type="datetime-local" class="form-control" id="promoEndTime" name="promoEndTime">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="submitPromo()">Save changes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


         <footer>
             &copy; 2024 Zion Colors
         </footer>
         
         <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
         
         <script>
 function editService(serviceId) {
     var serviceElement = document.getElementById('service' + serviceId);
     var serviceName = serviceElement.dataset.serviceName;
     var servicePriceMin = serviceElement.dataset.servicePriceMin || "";
     var servicePriceMax = serviceElement.dataset.servicePriceMax || "";
     var servicePrice = serviceElement.dataset.servicePrice || "";
     var serviceDescription = serviceElement.dataset.serviceDescription;
     var serviceCategory = serviceElement.dataset.serviceCategory;
     var serviceImage = serviceElement.dataset.serviceImage;
 
     console.log('Service Name:', serviceName);
     console.log('Service Price Min:', servicePriceMin);
     console.log('Service Price Max:', servicePriceMax);
     console.log('Service Price:', servicePrice);
     console.log('Service Description:', serviceDescription);
     console.log('Service Category:', serviceCategory);
     console.log('Service Image:', serviceImage);
 
     document.getElementById('editServiceId').value = serviceId;
     document.getElementById('serviceName').value = serviceName;
     document.getElementById('serviceDescription').value = serviceDescription;
 
     // Show or hide fields based on category
     if (serviceCategory === 'Soft Gel Nail Extensions') {
         document.getElementById('servicePriceMinGroup').style.display = 'block';
         document.getElementById('servicePriceMaxGroup').style.display = 'block';
         document.getElementById('servicePriceMin').value = servicePrice;
         document.getElementById('servicePriceMax').value = servicePriceMax;
         document.getElementById('servicePriceGroup').style.display = 'none';
     } else {
         document.getElementById('servicePriceGroup').style.display = 'block';
         document.getElementById('servicePrice').value = servicePrice;
         document.getElementById('servicePriceMinGroup').style.display = 'none';
         document.getElementById('servicePriceMaxGroup').style.display = 'none';
     }
 
     $('#serviceModal').modal('show');
 }
 
 
 
 function saveService() {
     var serviceId = document.getElementById('editServiceId').value;
     var serviceName = document.getElementById('serviceName').value;
     var serviceDescription = document.getElementById('serviceDescription').value;
     var serviceCategory = document.getElementById('service' + serviceId).dataset.serviceCategory;
     var serviceImageInput = document.getElementById('serviceImage');
     var serviceImageFile = serviceImageInput.files[0];
 
     var formData = new FormData();
     formData.append('service_id', serviceId);
     formData.append('service_name', serviceName);
     formData.append('service_description', serviceDescription);
     formData.append('service_category', serviceCategory);
     if (serviceImageFile) {
         formData.append('service_image', serviceImageFile);
     }
 
     if (serviceCategory === 'Soft Gel Nail Extensions') {
         formData.append('service_price_min', document.getElementById('servicePriceMin').value);
         formData.append('service_price_max', document.getElementById('servicePriceMax').value);
     } else {
         formData.append('service_price', document.getElementById('servicePrice').value);
     }
 
     console.log('Sending data:', formData); // Log data being sent
 
     $.ajax({
         url: 'http://localhost/Zion%20Database/modules/update_service.php',
         type: 'POST',
         data: formData,
         processData: false, // Prevent jQuery from processing the data
         contentType: false, // Prevent jQuery from setting contentType
         success: function(response) {
             console.log('AJAX Response:', response); // Log AJAX response
             if (response.trim() === 'success') {
                 // Update UI or perform other actions on success
                 $('#serviceModal').modal('hide');
                 location.reload(); // Reload the page
             } else {
                 alert('Failed to update service details. Response: ' + response);
             }
         },
         error: function(xhr, status, error) {
             console.error('AJAX Error:', xhr.responseText);
             alert('Error occurred during AJAX request. Please check the console for details.');
         }
     });
 }
 
 
 
 
 function sendServiceData(serviceId, serviceName, servicePrice, serviceDescription, serviceImageData, servicePriceMax = null) {
     var data = {
         service_id: serviceId,
         service_name: serviceName,
         service_price: servicePrice,
         service_description: serviceDescription,
         service_image: serviceImageData
     };
 
     if (servicePriceMax !== null) {
         data.service_price_max = servicePriceMax;
     }
 
     $.ajax({
         url: 'http://localhost/Zion%20Database/modules/update_service.php',
         type: 'POST',
         data: data,
         success: function(response) {
             console.log('AJAX Response:', response); // Log the response
             if (response == 'success') {
                 // Update the service details in the list item
                 var serviceElement = document.getElementById('service' + serviceId);
                 serviceElement.dataset.serviceName = serviceName;
                 serviceElement.dataset.serviceDescription = serviceDescription;
                 serviceElement.dataset.serviceImage = serviceImageData;
                 serviceElement.dataset.servicePrice = servicePrice;
 
                 if (servicePriceMax !== null) {
                     serviceElement.dataset.servicePriceMax = servicePriceMax;
                 }
 
                 // Update the displayed service details
                 serviceElement.querySelector('.service-description').innerHTML = '<strong>' + serviceName + ':</strong><br>' + serviceDescription;
 
                 // Update orig_price1 and orig_price2 (if applicable) in the database by sending another AJAX request
                 $.ajax({
                     url: 'http://localhost/Zion%20Database/modules/update_price.php',
                     type: 'POST',
                     data: {
                         service_id: serviceId,
                         orig_price1: servicePrice,
                         orig_price2: servicePriceMax
                     },
                     success: function(response) {
                         console.log('Price Updated:', response); // Log the response
                     },
                     error: function(xhr, status, error) {
                         console.error('Price Update Error:', xhr.responseText); // Log detailed error information
                     }
                 });
 
                 // Hide the modal
                 $('#serviceModal').modal('hide');
             } else {
                 alert('Failed to update service details. Response: ' + response); // Display server response for debugging
             }
         },
         error: function(xhr, status, error) {
             console.error('AJAX Error:', xhr.responseText); // Log detailed error information
             alert('Error occurred during AJAX request. Please check the console for details.');
         }
     });
 }
 function addService() {
      
     var serviceCategory = document.getElementById('addServiceCategory').value;
     var serviceName = document.getElementById('serviceName1').value;
     var serviceDescription = document.getElementById('serviceDescription1').value;
     var serviceImageInput1 = document.getElementById('serviceImage1');
     var serviceImageFile1 = serviceImageInput1.files[0];
 
     var formData = new FormData();
     formData.append('service_category', serviceCategory);
     formData.append('service_name', serviceName);
     formData.append('service_description', serviceDescription);
     formData.append('service_image', serviceImageFile1);
 
     if (serviceCategory === 'Soft Gel Nail Extensions') {
         var servicePriceMin = document.getElementById('servicePriceMin1').value;
         var servicePriceMax = document.getElementById('servicePriceMax1').value;
         formData.append('service_price_min', servicePriceMin);
         formData.append('service_price_max', servicePriceMax);
     } else {
         var servicePrice = document.getElementById('servicePrice1').value;
         formData.append('service_price', servicePrice);
     }
 
     $.ajax({
         url: 'http://localhost/Zion%20Database/modules/add_service.php',
         type: 'POST',
         data: formData,
         processData: false,
         contentType: false,
         success: function(response) {
             console.log('AJAX Response:', response);
             if (response.trim() === 'success') {
                 $('#addServiceModal').modal('hide');
                 location.reload();
             } else {
                 alert('Failed to add service. Response: ' + response);
             }
         },
         error: function(xhr, status, error) {
             console.error('AJAX Error:', xhr.responseText);
             alert('Error occurred during AJAX request. Please check the console for details.');
         }
     });
 }
 
     function togglePriceFields() {
     var category = document.getElementById('addServiceCategory').value;
     var priceGroup = document.getElementById('servicePriceGroup1');
     var priceMinGroup = document.getElementById('servicePriceMinGroup1');
     var priceMaxGroup = document.getElementById('servicePriceMaxGroup1');
 
     if (category === 'Soft Gel Nail Extensions') {
         priceGroup.style.display = 'none';
         priceMinGroup.style.display = 'block';
         priceMaxGroup.style.display = 'block';
     } else {
         priceGroup.style.display = 'block';
         priceMinGroup.style.display = 'none';
         priceMaxGroup.style.display = 'none';
     }
 }
 
 function openDeleteConfirmationModal(serviceId) {
         $('#deleteConfirmationModal').modal('show');
         document.getElementById('confirmDeleteButton').onclick = function() {
             deleteServiceConfirmed(serviceId);
         };
     }
 function deleteServiceConfirmed(serviceId) {
 
 
 
     $.post("http://localhost/Zion%20Database/modules/delete_service.php?service_id=" + serviceId.replace("service","") ,function(d){
         $('#deleteConfirmationModal').modal('hide');
 
 // Automatically refresh the browser
          location.reload();
         
         console.log(d.message);
     })
  
 }
 function addPromo(serviceId) {


  // Validate serviceId format if it's a string
  if (typeof serviceId !== 'number' && isNaN(serviceId)) {
    console.error('Invalid serviceId:', serviceId);
    alert('Invalid service ID.');
    return;
  }

  // Set the service ID in the hidden input field
  document.getElementById('serviceId').value = serviceId;
  // Show the modal
  var promoModal = new bootstrap.Modal(document.getElementById('promoModal'));
  promoModal.show();
}


function submitPromo() {
  // Get the form data
  var promoPercent = document.getElementById('promoPercent').value;
  var promoEndTime = document.getElementById('promoEndTime').value;
  var serviceId = document.getElementById('serviceId').value;

  // Validate input
  if (!promoPercent || isNaN(promoPercent) || promoPercent < 0 || promoPercent > 100) {
    alert('Please enter a valid promo percent between 0 and 100');
    return;
  }

  // Ensure serviceId is correctly set
  if (!serviceId || isNaN(serviceId)) {
    alert('Invalid service ID.');
    return;
  }

  // Create an AJAX request to submit the data to the server
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'http://localhost/Zion%20Database/modules/add_remove_promo.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Handle success, possibly reload the page or show a success message
      console.log('Promo updated successfully');
      console.log('Response from server:', xhr.responseText);
      location.reload();
    } else {
      // Handle error
      console.error('Error updating promo');
      console.log('Response from server:', xhr.responseText);
      alert('There was an error updating the promo. Please try again.');
    }
  };

  // Build the request parameters
  var params = 'serviceId=' + encodeURIComponent(serviceId) +
               '&promoPercent=' + encodeURIComponent(promoPercent);

  if (promoEndTime) {
    params += '&promoEndTime=' + encodeURIComponent(promoEndTime);
  }

  xhr.send(params);
}

function checkPromos() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/Zion%20Database/modules/check_promos.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log('Checked promos:', xhr.responseText);
        } else {
            console.error('Error checking promos:', xhr.status, xhr.statusText);
        }
    };
    xhr.send();
}

// Set interval to check promos every 5 minutes (300000 milliseconds)
setInterval(checkPromos, 3000);

// Optionally, call it immediately to check promos on page load
checkPromos();



 
 
 
 
     
 
 
 
     </script>
     </body>
     </html>