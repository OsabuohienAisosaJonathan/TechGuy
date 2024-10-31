// assets/js/map.js

function initMap() {
    const map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 51.505, lng: -0.09 }, // Default location (adjust as needed)
        zoom: 13
    });

    // Fetch user locations from PHP
    fetch('fetch_locations.php') // PHP file returns a JSON array of user locations
        .then(response => response.json())
        .then(data => {
            data.forEach(user => {
                const marker = new google.maps.Marker({
                    position: { lat: user.latitude, lng: user.longitude },
                    map: map,
                    title: user.username
                });

                const infoWindow = new google.maps.InfoWindow({
                    content: `<b>${user.username}</b><br>${user.email}`
                });

                marker.addListener('click', () => {
                    infoWindow.open(map, marker);
                });
            });
        })
        .catch(error => {
            console.error('Error fetching user locations:', error);
        });
}

// Call the initMap function to display the map
document.addEventListener('DOMContentLoaded', initMap);
