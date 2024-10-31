<?php

require '../config/database.php';
require '../includes/auth.php'; // Ensure user is logged in

// Assuming you have a div with id 'map' for the Google Map
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map of Tech Experts</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        /* Simple style for the map container */
        #map {
            height: 500px; /* Set a height for the map */
            width: 100%;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key={YOUR_GOOGLE_API}&callback=initMap" async defer></script>
    <script src="../assets/js/map.js"></script>
</head>
<body>

    <h2>Map of Tech Experts</h2>
    <div id="map"></div> <!-- Map will be displayed here -->

</body>
</html>
