if (typeof contactMapData !== "undefined") {

    function initialize() {
        var locationLatLng = new google.maps.LatLng(contactMapData.lat, contactMapData.lng);
        var mapCanvas = document.getElementById('map-canvas');
        var mapOptions = {
            center: locationLatLng,
            zoom: parseInt(contactMapData.zoom),
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL
            },
            panControl: false,
            mapTypeControl: true,
            scrollwheel: false,
            styles: [
                {
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#444444"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#f2f2f2"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.business",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 45
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#b4d4e1"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                }
            ]
        };

        var officeMap = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({
            position: locationLatLng,
            map: officeMap,
            icon: contactMapData.icon
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
}