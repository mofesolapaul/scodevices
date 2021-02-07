$(() => {
    let map;
    let infowindow = new google.maps.InfoWindow();

    (function initMap() {
        map = new google.maps.Map(document.getElementById("map_canvas"), {
            zoom: 8,
            center: {lat: 54.8985, lng: 23.9036},
        });

        axios.get('/devices').then((response) => {
            for (let device of response.data) {
                showDeviceMarkerOnMap(device);
            }
        }).catch((error) => {
        });
    })();

    function showDeviceMarkerOnMap(device) {
        const content = '<div classs="mapInfoWindow">' +
            `<strong>${device.device_id}</strong><br>` +
            `<span>${device.address}</span><br>` +
            '</div>';
        var marker = new google.maps.Marker({
            map: map,
            position: {lat: parseFloat(device.latitude), lng: parseFloat(device.longitude)},
            title: device.device_id
        });
        google.maps.event.addListener(marker, 'click', function () {
            infowindow.setContent(content);
            infowindow.open(map, marker);
        });
    }
});
