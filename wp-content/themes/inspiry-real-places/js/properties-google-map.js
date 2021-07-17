if (typeof propertiesMapData !== "undefined") {

    function initializePropertiesMap() {
        if (propertiesMapData.properties.length) {
            
            // Properties Array
            var properties = propertiesMapData.properties;
            var openedWindows = [];

            var fullScreenControl = true;
            var fullScreenControlPosition = google.maps.ControlPosition.RIGHT_BOTTOM;

            var mapTypeControl = true;
            var mapTypeControlPosition = google.maps.ControlPosition.LEFT_BOTTOM;

            var mapOptions = {
                zoom: 12,
                maxZoom: 16,
                fullscreenControl: fullScreenControl,
                fullscreenControlOptions: {
                    position: fullScreenControlPosition
                },
                mapTypeControl: mapTypeControl,
                mapTypeControlOptions: {
                    position: mapTypeControlPosition
                },
                scrollwheel: false,
                styles: [{
                    "featureType": "landscape", "stylers": [{
                        "hue": "#FFBB00"
                    }, {
                        "saturation": 43.400000000000006
                    }, {
                        "lightness": 37.599999999999994
                    }, {
                        "gamma": 1
                    }]
                }, {
                    "featureType": "road.highway", "stylers": [{
                        "hue": "#FFC200"
                    }, {
                        "saturation": -61.8
                    }, {
                        "lightness": 45.599999999999994
                    }, {
                        "gamma": 1
                    }]
                }, {
                    "featureType": "road.arterial", "stylers": [{
                        "hue": "#FF0300"
                    }, {
                        "saturation": -100
                    }, {
                        "lightness": 51.19999999999999
                    }, {
                        "gamma": 1
                    }]
                }, {
                    "featureType": "road.local", "stylers": [{
                        "hue": "#FF0300"
                    }, {
                        "saturation": -100
                    }, {
                        "lightness": 52
                    }, {
                        "gamma": 1
                    }]
                }, {
                    "featureType": "water", "stylers": [{
                        "hue": "#0078FF"
                    }, {
                        "saturation": -13.200000000000003
                    }, {
                        "lightness": 2.4000000000000057
                    }, {
                        "gamma": 1
                    }]
                }, {
                    "featureType": "poi", "stylers": [{
                        "hue": "#00FF6A"
                    }, {
                        "saturation": -1.0989010989011234
                    }, {
                        "lightness": 11.200000000000017
                    }, {
                        "gamma": 1
                    }]
                }]
            };

            // Map Styles
            if (undefined !== propertiesMapOptions.styles) {
                mapOptions.styles = JSON.parse(propertiesMapOptions.styles);
            }

            // Setting Google Map Type
            switch (propertiesMapOptions.type) {
                case 'satellite':
                    mapOptions.mapTypeId = google.maps.MapTypeId.SATELLITE;
                    break;
                case 'hybrid':
                    mapOptions.mapTypeId = google.maps.MapTypeId.HYBRID;
                    break;
                case 'terrain':
                    mapOptions.mapTypeId = google.maps.MapTypeId.TERRAIN;
                    break;
                default:
                    mapOptions.mapTypeId = google.maps.MapTypeId.ROADMAP;
            }

            var map = new google.maps.Map(document.getElementById("listing-map"), mapOptions);

            // Street view control positioning
            map.getStreetView().setOptions({
                addressControlOptions: { position: google.maps.ControlPosition.BOTTOM_CENTER },
                fullscreenControl: false,
            });

            var bounds = new google.maps.LatLngBounds();

            // Loop to generate marker and infowindow based on properties array
            var markers = new Array();

            // close previously opened info windows
            var closeOpenedWindows = function () {
                while (0 < openedWindows.length) {
                    var windowToClose = openedWindows.pop();
                    windowToClose.close();
                }
            };

            var attachInfoBoxToMarker = function (map, marker, infoBox) {
                google.maps.event.addListener(marker, 'click', function () {
                    closeOpenedWindows();
                    var scale = Math.pow(2, map.getZoom());
                    var offsety = ((100 / scale) || 0);
                    var projection = map.getProjection();
                    var markerPosition = marker.getPosition();
                    var markerScreenPosition = projection.fromLatLngToPoint(markerPosition);
                    var pointHalfScreenAbove = new google.maps.Point(markerScreenPosition.x, markerScreenPosition.y - offsety);
                    var aboveMarkerLatLng = projection.fromPointToLatLng(pointHalfScreenAbove);
                    map.setCenter(aboveMarkerLatLng);
                    map.panTo(aboveMarkerLatLng);
                    infoBox.open(map, marker);
                    openedWindows.push(infoBox);

                    // lazy load info box image to improve performance
                    var infoBoxImage = infoBox.getContent().getElementsByClassName('prop-thumb');
                    if (infoBoxImage.length) {
                        if (infoBoxImage[0].dataset.src) {
                            infoBoxImage[0].src = infoBoxImage[0].dataset.src;
                        }
                    }
                });
            };

            for (var i = 0; i < properties.length; i++) {

                var url = properties[i].icon;
                var size = new google.maps.Size(42, 57);
                if (window.devicePixelRatio > 1.5) {
                    if (properties[i].retinaIcon) {
                        url = properties[i].retinaIcon;
                        size = new google.maps.Size(83, 113);
                    }
                }

                var image = {
                    url: url,
                    size: size,
                    scaledSize: new google.maps.Size(42, 57),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(21, 56)
                };

                markers[i] = new google.maps.Marker({
                    position: new google.maps.LatLng(properties[i].lat, properties[i].lng),
                    map: map,
                    icon: image,
                    title: properties[i].title,
                    animation: google.maps.Animation.DROP,
                    visible: true
                });

                bounds.extend(markers[i].getPosition());

                var boxText = document.createElement("div");
                boxText.className = 'map-info-window';
                boxText.innerHTML = '<a class="thumb-link" href="' + properties[i].url + '">' +
                    '<img class="prop-thumb" src="' + properties[i].thumb + '" alt="' + properties[i].title + '"/>' +
                    '</a>' +
                    '<h5 class="prop-title"><a class="title-link" href="' + properties[i].url + '">' + properties[i].title + '</a></h5>' +
                    '<p><span class="price">' + properties[i].price + '</span></p>' +
                    '<div class="arrow-down"></div>';


                var myOptions = {
                    content: boxText,
                    disableAutoPan: true,
                    maxWidth: 0,
                    alignBottom: true,
                    pixelOffset: new google.maps.Size(-122, -48),
                    zIndex: null,
                    closeBoxMargin: "0 0 -16px -16px",
                    closeBoxURL: propertiesMapData.closeIcon,
                    infoBoxClearance: new google.maps.Size(1, 1),
                    isHidden: false,
                    pane: "floatPane",
                    enableEventPropagation: false
                };

                var ib = new InfoBox(myOptions);

                attachInfoBoxToMarker(map, markers[i], ib);
            }

            map.fitBounds(bounds);

            /* Marker Clusters */
            var markerClustererOptions = {
                ignoreHidden: true,
                maxZoom: 14,
                styles: [{
                    textColor: '#ffffff',
                    url: propertiesMapData.clusterIcon,
                    height: 48,
                    width: 48
                }]
            };

            var markerClusterer = new MarkerClusterer(map, markers, markerClustererOptions);



        } else {

            // Fallback Map in Case of No Properties
            var fallback_lat, fallback_lng;
            if (undefined !== propertiesMapOptions.fallback_location && propertiesMapOptions.fallback_location.lat && propertiesMapOptions.fallback_location.lng) {
                fallback_lat = propertiesMapOptions.fallback_location.lat;
                fallback_lng = propertiesMapOptions.fallback_location.lng;
            } else {
                // Default location of Florida in fallback map.
                fallback_lat = '27.664827';
                fallback_lng = '-81.515755';
            }

            var fallBackLocation = new google.maps.LatLng(fallback_lat, fallback_lng);
            var fallBackOptions = {
                center: fallBackLocation,
                zoom: 14,
                maxZoom: 16,
                scrollwheel: false
            };

            // Map Styles
            if (undefined !== propertiesMapOptions.styles) {
                fallBackOptions.styles = JSON.parse(propertiesMapOptions.styles);
            }

            var fallBackMap = new google.maps.Map(document.getElementById("listing-map"), fallBackOptions);

        }
    }

    google.maps.event.addDomListener(window, 'load', initializePropertiesMap);
}