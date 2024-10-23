function initMap() {
    // Map options
    var options = {
        zoom: 8,
        center: { lat: 14.5995, lng: 120.9842 } // Centered on Metro Manila
    };

    // Create map
    var map = new google.maps.Map(document.getElementById('map'), options);

    // Add a marker
    var marker = new google.maps.Marker({
        position: { lat: 14.5995, lng: 120.9842 },
        map: map,
        title: 'Metro Manila'
    });
}
