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
                .container-service {
                    max-width: 900px;
                    margin: 20px auto; /* Add margin to center the content */
                    padding: 20px;
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
                    margin-right: auto;
                    margin-left: auto;
                    display: block;
                    margin-bottom: 10px;
                    border-radius: 10%;
                    position: relative; /* Add position relative to container */
                    cursor: pointer;
                }
                .service-checkbox {
                    position: relative; /* Change position to relative */
                    transform: scale(1.5); /* Keep the checkbox size */
                    margin-top: 10px; /* Adjust margin for better spacing */
                }
                .service-description {
                    text-align: center;
                    font-family: Spectral, serif;
                    font-size: 16px;
                    margin-bottom: 10px;
                }
                p {
                    font-family: Poppins, sans-serif;
                    font-size: 16px;
                    margin-top: 8px;
                }
                .service-price {
                    text-align: center;
                    color: #555; /* Adjusted color for better visibility */
                    font-size: 14px;
                }
                #total-price {
                    position: fixed;
                    top: 210px; /* Adjust as needed */
                    right: 15px; 
                    font-size: 16px;
                    font-weight: bold;
                    margin-left: 30px;
                }
                .calculate-total {
                    text-align: center;
                    margin-top: 20px;
                    margin-bottom: 20px;
                }
                #calculate-total {
                    position: fixed;
                    top: 160px; /* Adjust as needed */
                    right: 10px; /* Adjust as needed */
                    background-color: #87ceeb;
                    color: white;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 25px; /* Rounded corners */
                    text-decoration: none;
                    font-size: 16px;
                    cursor: pointer;
                }
                #calculate-total.active {
                    position: fixed;
                }
                #calculate-total:hover {
                    background-color: #005F6B;
                }
                .enlarged-image {
                    display: none;
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.9);
                    z-index: 9999;
                }
                .enlarged-image img {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    max-width: 90%;
                    max-height: 90%;
                }
                .close-btn {
                    position: absolute;
                    top: 5px;
                    right: 300px;
                    color: #fff;
                    cursor: pointer;
                    font-size: 30px;
                    padding: 10px;
                }
                .product-row {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: center; /* Center the items horizontally */
                    margin-bottom: 30px;
                }
                .product-item {
                    position: relative;
                    flex: 0 0 calc(33.33% - 20px);
                    margin-bottom: 20px;
                    list-style: none;
                    text-align: center;
                    max-width: 33.33%; /* Set maximum width to 33.33% */
                    padding: 0 50px; /* Add some padding to create space between items */
                }
                .shopee-button {
                    display: none;
                    position: absolute;
                    top: 50px;
                    left: 420px;
                    background-color: #EE4D2D;
                    color: #fff;
                    border: 1px solid #fff;
                    padding: 5px 10px;
                    cursor: pointer;
                }
                .product-item:hover .shopee-button {
                    display: block;
                    background-color: #EE4D2D;
                }
                @media (max-width: 767px) {
                    .product-item {
                        max-width: 45%; /* Set maximum width to 45% for smaller screens */
                    }
                }
                .description {
                    font-family: Spectral, serif;
                    font-size: 16px;
                    margin-bottom: 10px;
                }
                .price {
                    color: #555;
                    font-size: 14px;
                }
            </style>
            
        </head>
            <?php
    include('header.php');
    ?>
    <body>
        
        <button id="calculate-total">Calculate Estimate Total</button> <br><br>
        <div id="total-price"></div>
        <div class="container-service">
            <h2><center>Services Offered</center></h2>
            <br>
            
            <?php
            include('db_connect.php'); // Include your database connection file

            // Check if the connection is successful
            if ($connection) {
                $query = "SELECT * FROM services"; // Query to select all columns from the "services" table
                $result = mysqli_query($connection, $query); // Execute the query

                // Check if the query was successful
                if ($result) {
                    // Initialize arrays for each category
                    $softGelNailExtensions = [];
                    $gelOverlay = [];
                    $others = [];

                    // Fetch each row of data from the result set
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Initialize variables
                        $service_id = isset($row['service_id']) ? $row['service_id'] : '';
                        $service_name = isset($row['service_name']) ? $row['service_name'] : '';
                        $service_description = isset($row['service_description']) ? $row['service_description'] : '';
                        $orig_price1 = isset($row['orig_price1']) ? $row['orig_price1'] : '';
                        $orig_price2 = isset($row['orig_price2']) ? $row['orig_price2'] : '';
                        $promo_percent = isset($row['promo_percent']) ? $row['promo_percent'] : 0;

                        $orig_price1 = is_numeric($orig_price1) ? $orig_price1 : 0;
                        $orig_price2 = is_numeric($orig_price2) ? $orig_price2 : 0;
                        $promo_percent = is_numeric($promo_percent) ? $promo_percent : 0;
                        
                        $imageQuery = "SELECT image_url FROM services WHERE service_id = $service_id";
                        $imageResult = mysqli_query($connection, $imageQuery);
                        $imageRow = mysqli_fetch_assoc($imageResult);
                        $imageFileName = isset($imageRow['image_url']) ? $imageRow['image_url'] : ''; // Assuming 'image_url' is the column name for image file names

                        $imageSrc = 'http://localhost/modules/uploads/' . $service_id . '.' . $imageFileName;

                        $discounted_price1 = $orig_price1 - ($orig_price1 * $promo_percent / 100);
                        $discounted_price2 = $orig_price2 - ($orig_price2 * $promo_percent / 100);

                        // Generate HTML dynamically for each service
                        if ($row['service_category'] == 'Soft Gel Nail Extensions') {
                            $serviceHtml = '<ul class="product-item">';
                            $serviceHtml .= '<li>';
                            $serviceHtml .= '<img class="service-img" src="' . $imageSrc . '" alt="' . $service_name . '">';
                            $serviceHtml .= '<input type="checkbox" id="' . $service_name . '" class="service-checkbox" data-price="' . $orig_price1 . '" data-promo-percent="'. $promo_percent . '">';
                            $serviceHtml .= '</li>';    
                            $serviceHtml .= '<li class="description">';
                            $serviceHtml .= '<strong>' . $service_name . ':</strong><br>';
                            $serviceHtml .= '<p>' . $service_description . '</p>';
                            $serviceHtml .= '</li>';
                            $serviceHtml .= '<li class="price">';
                            if ($promo_percent > 0) {
                                $serviceHtml .= '<span><s>₱' . $orig_price1 . ' - ₱' . $orig_price2 . '</s> <strong>₱' . $discounted_price1 . ' - ₱' . $discounted_price2 . '</strong></span>';
                                $serviceHtml .= '<br><span>' . $promo_percent . '% OFF</span>';
                            } else {
                                $serviceHtml .= '<span>₱' . $orig_price1 . ' - ₱' . $orig_price2 . '</span>';
                            }
                            $serviceHtml .= '</li>';
                            $serviceHtml .= '</ul>';


                            $softGelNailExtensions[] = $serviceHtml;
                        } else if ($row['service_category'] == 'Gel Overlay') {
                            $serviceHtml = '<ul class="product-item">';
                            $serviceHtml .= '<li>';
                            $serviceHtml .= '<img class="service-img" src="' . $imageSrc . '" alt="' . $service_name . '">';
                            $serviceHtml .= '<input type="checkbox" id="' . $service_name . '" class="service-checkbox" data-price="' . $orig_price1 . '" data-promo-percent="'. $promo_percent . '">';
                            $serviceHtml .= '</li>';
                            $serviceHtml .= '<li class="description">';
                            $serviceHtml .= '<strong>' . $service_name . ':</strong><br>';
                            $serviceHtml .= '<p>' . $service_description . '</p>';
                            $serviceHtml .= '</li>';
                            $serviceHtml .= '<li class="price">';
                            if ($promo_percent > 0) {
                                $serviceHtml .= '<span><s>₱' . $orig_price1 . '</s> <strong>₱' . $discounted_price1 . '</strong></span>';
                                $serviceHtml .= '<br><span>' . $promo_percent . '% OFF</span>';
                            } else {
                                $serviceHtml .= '<span>₱' . $orig_price1 . '</span>';
                            }
                            $serviceHtml .= '</li>';
                            $serviceHtml .= '</ul>';
                            $gelOverlay[] = $serviceHtml;
                        } else {
                            $serviceHtml = '<ul class="product-item">';
                            $serviceHtml .= '<li>';
                            $serviceHtml .= '<img class="service-img" src="' . $imageSrc . '" alt="' . $service_name . '">';
                            $serviceHtml .= '<input type="checkbox" id="' . $service_name . '" class="service-checkbox" data-price="' . $orig_price1 . '"data-promo-percent= "'. $promo_percent . '">';
                            $serviceHtml .= '</li>';
                            $serviceHtml .= '<li class="description">';
                            $serviceHtml .= '<strong>' . $service_name . ':</strong><br>';
                            $serviceHtml .= '<p>' . $service_description . '</p>';
                            $serviceHtml .= '</li>';
                            $serviceHtml .= '<li class="price">';
                            if ($promo_percent > 0) {
                                $serviceHtml .= '<span><s>₱' . $orig_price1 . '</s> <strong>₱' . $discounted_price1 . '</strong></span>';
                                $serviceHtml .= '<br><span>' . $promo_percent . '% OFF</span>';
                            } else {
                                $serviceHtml .= '<span>₱' . $orig_price1 . '</span>';
                            }
                            $serviceHtml .= '</li>';
                            $serviceHtml .= '</ul>';
                            $others[] = $serviceHtml;
                        }
                    }

                    // Function to distribute services into rows of three items each
                    function distributeServices($services, &$rows, $header) {
                        $index = 0;
                        $row = '<h3>' . $header . '</h3><br><div class="product-row">';
                        foreach ($services as $service) {
                            $row .= $service;
                            $index++;
                            if ($index % 3 == 0) {
                                $row .= '</div><div class="product-row">';
                            }
                        }
                        $row .= '</div>';
                        $rows[] = $row;
                    }

                    // Initialize rows
                    $rows = [];

                    // Distribute services into respective rows
                    distributeServices($softGelNailExtensions, $rows, 'Soft Gel Nail Extensions');
                    distributeServices($gelOverlay, $rows, 'Gel Overlay');
                    distributeServices($others, $rows, 'Others');

                    // Output the rows
                    foreach ($rows as $row) {
                        echo $row;
                    }
                } else {
                    echo 'Error executing query: ' . mysqli_error($connection);
                }

                // Close the database connection
                mysqli_close($connection);
            } else {
                echo 'Error connecting to the database: ' . mysqli_connect_error();
            }
            ?>
        </div>
    </body>




            <footer>
                <p>&copy; 2024 Zion Colors. All rights reserved.</p>
            </footer>

            
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <script>
                 $(document).ready(function() {
                     $('#calculate-total').click(function() {
                         var total = 0;
                         $('.service-checkbox:checked').each(function() {
                             var origPrice = parseInt($(this).data('price'));
                             var promoPercent = parseFloat($(this).data('promo-percent'));
                             var discountedPrice = origPrice - (origPrice * promoPercent / 100);
                             total += discountedPrice;
                         });
                         $('#total-price').text('Estimated Total Price: ₱' + total.toFixed(2));
                     });
                 });
                
                document.addEventListener('DOMContentLoaded', function() {
                    var images = document.querySelectorAll('.service-img');

                    images.forEach(function(image) {
                        var parentContainer = image.closest('.product-item');

                        var serviceId = parentContainer.querySelector('.service-checkbox').id;

                        var isPressOnService = serviceId.startsWith('service14') || serviceId.startsWith('service15') || serviceId.startsWith('service16') || serviceId.startsWith('service17');

                        if (isPressOnService) {
                            var enlargedImageContainer = document.createElement('div');
                            enlargedImageContainer.classList.add('enlarged-image');
                            enlargedImageContainer.style.display = 'none';

                            var enlargedImage = document.createElement('img');

                            var closeButton = document.createElement('span');
                            closeButton.classList.add('close-btn');
                            closeButton.innerHTML = '&times;';
                            closeButton.addEventListener('click', function() {
                                enlargedImageContainer.style.display = 'none';
                            });

                            var shopeeButton = document.createElement('button');
                            shopeeButton.classList.add('shopee-button');
                            shopeeButton.textContent = '+ Shop on Shopee';
                            shopeeButton.setAttribute('data-link', 'https://shopee.ph/zioncolors.ph#product_list');
                            shopeeButton.addEventListener('click', function() {
                                var link = this.getAttribute('data-link');
                                window.open(link, '_blank');
                            });

                            enlargedImageContainer.appendChild(enlargedImage);
                            enlargedImageContainer.appendChild(closeButton);

                            image.addEventListener('click', function() {
                                enlargedImage.src = this.src;
                                enlargedImageContainer.appendChild(shopeeButton);
                                enlargedImageContainer.style.display = 'block';
                            });

                            parentContainer.appendChild(enlargedImageContainer);
                        } else {
                            image.addEventListener('click', function() {
                                var enlargedImageContainer = document.createElement('div');
                                enlargedImageContainer.classList.add('enlarged-image');
                                enlargedImageContainer.style.display = 'none';

                                var enlargedImage = document.createElement('img');
                                enlargedImage.src = this.src;

                                var closeButton = document.createElement('span');
                                closeButton.classList.add('close-btn');
                                closeButton.innerHTML = '&times;';
                                closeButton.addEventListener('click', function() {
                                    enlargedImageContainer.style.display = 'none';
                                });

                                enlargedImageContainer.appendChild(enlargedImage);
                                enlargedImageContainer.appendChild(closeButton);

                                parentContainer.appendChild(enlargedImageContainer);

                                enlargedImageContainer.style.display = 'block';
                            });
                        }
                    });
                });

            </script>
        </body>
        </html>
