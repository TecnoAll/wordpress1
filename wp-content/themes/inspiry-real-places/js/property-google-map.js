(function ($) {

"use strict";

var map;
var propertyLoc = new google.maps.LatLng(propertyMapData.lat, propertyMapData.lang);
var openedWindows = [];
var url = propertyMapData.icon;
var size = new google.maps.Size(42, 57);
var markersArray = [];
var infowindow = new google.maps.InfoWindow();
var propertyMapOptions = {
    center: propertyLoc,
    zoom: 14,
    scrollwheel: false
};
var fontIcons = {
    bus_station: '<i class="fas fa-bus"></i>',
    subway_station: '<i class="fas fa-subway"></i>',
    grocery_or_supermarket: '<i class="fas fa-shopping-bag"></i>',
    restaurant: '<i class="fas fa-utensils"></i>',
    school: '<i class="fas fa-school"></i>',
    hospital: '<i class="fas fa-hospital-alt"></i>',
    cafe: '<i class="fas fa-coffee"></i>',
    gym: '<i class="fas fa-dumbbell"></i>',
};

// Map Styles
if (undefined !== propertyMapData.styles) {
    propertyMapOptions.styles = JSON.parse(propertyMapData.styles);
}else{
    propertyMapOptions.styles = [{ featureType: "administrative", elementType: "geometry", stylers: [{ visibility: "off" }] }, { featureType: "poi", stylers: [{ visibility: "off" }] }, { featureType: "road", elementType: "labels.icon", stylers: [{ visibility: "off" }] }, { featureType: "transit", stylers: [{ visibility: "off" }] }];
}

// Setting Google Map Type
switch (propertyMapData.type) {
    case 'satellite':
        propertyMapOptions.mapTypeId = google.maps.MapTypeId.SATELLITE;
        break;
    case 'hybrid':
        propertyMapOptions.mapTypeId = google.maps.MapTypeId.HYBRID;
        break;
    case 'terrain':
        propertyMapOptions.mapTypeId = google.maps.MapTypeId.TERRAIN;
        break;
    default:
        propertyMapOptions.mapTypeId = google.maps.MapTypeId.ROADMAP;
};

var mapIcon = {
    url: url,
    size: size,
    scaledSize: new google.maps.Size(42, 57),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(21, 56)
};

map = new google.maps.Map(document.getElementById('property-map'), propertyMapOptions);

var propertyMarker = new google.maps.Marker({
    position: propertyLoc,
    map: map,
    icon: mapIcon
});

$('#property_nearby_locations li a').on('click', function (e) {
    e.preventDefault();
    $('#property_nearby_locations li').removeClass('active');
    $(this).closest('li').addClass('active');
    searchNearbyPlaces(propertyMarker);
    closeOpenedWindows();
});

function propertyMapInitialize() {
    map = new google.maps.Map(document.getElementById('property-map'), propertyMapOptions);

    var propertyMarker = new google.maps.Marker({
        position: propertyLoc,
        map: map,
        icon: mapIcon
    });
}



// close previously opened info windows
var closeOpenedWindows = function () {
    while (0 < openedWindows.length) {
        var windowToClose = openedWindows.pop();
        windowToClose.close();
    }
};

var attachInfoBoxToMarker = function (map, marker, title) {

    google.maps.event.addListener(marker, 'mouseover', function () {
        infowindow.setContent(title);
        infowindow.open(map, this);
    });
    google.maps.event.addListener(marker, 'mouseout', function () {
        infowindow.close();
    });
};

    function initializePlacesMap(properties, type, propertyMarker, color, background) {

    var bounds = new google.maps.LatLngBounds();


    bounds.extend(propertyMarker.getPosition());
    // Loop to generate marker and infowindow based on properties array
    var markers = {};

    for (var i = 0; i < properties.length; i++) {
        markers[i] = new Marker({
            position: properties[i].geometry.location,
            map: map,
            title: properties[i].title,
            //animation: google.maps.Animation.DROP,
            visible: true,
            icon: {
                path: MAP_PIN,
                fillColor: background,
                fillOpacity: 1,
                strokeColor: '',
                strokeWeight: 0,
                scale: .7,
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(0, 0),
                labelClass: "labels",
            },
            map_icon_label: fontIcons[type]
        });

        bounds.extend(markers[i].getPosition());
        attachInfoBoxToMarker(map, markers[i], properties[i].name);
        markersArray.push(markers[i]);
    }

   // map.fitBounds(bounds);
}

function searchNearbyPlaces(propertyMarker) {
    var type = $('#property_nearby_locations li.active a').attr('id');
    var color = $('#property_nearby_locations li.active a').attr('color');
    var background = $('#property_nearby_locations li.active a').attr('background');
    var icon = propertyMapData.base_icon_uri + "images/" + type + ".png";

    var request = {
        location: propertyLoc,
        radius: propertyMapData.radius,
        types: [type] //e.g. school, restaurant,bank,bar,city_hall,gym,night_club,park,zoo
    };

    var service = new google.maps.places.PlacesService(map);
    service.search(request, function (results, status) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {
            clearOverlays();
            initializePlacesMap(results, type, propertyMarker, color, background);
        }else{
            clearOverlays();
        }
    });
}
// Deletes all markers in the array by removing references to them
function clearOverlays() {
    if (markersArray) {
        for (var i in markersArray) {
            markersArray[i].setMap(null);
        }
    }
}
google.maps.event.addDomListener(window, 'load', propertyMapInitialize);

})(jQuery);
