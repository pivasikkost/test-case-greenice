+function ($) {
    'use strict';

    function initMap() {
        var areaCoordinates = {
            lat: Number($('#area-lat').val()),
            lng: Number($('#area-lng').val())
        };
        var map = new google.maps.Map(
            document.getElementById('map-area'),
            {
                zoom: 8,
                center: areaCoordinates
            }
        );
        var marker = new google.maps.Marker({
            position: areaCoordinates,
            map: map,
            draggable: true
        });

        $('#area-lat, #area-lng').on('change', function() {
            var inputCoordinates = {
                lat: Number($('#area-lat').val()),
                lng: Number($('#area-lng').val())
            };
            marker.setPosition(inputCoordinates);
            map.setCenter(marker.getPosition());
        });
        marker.addListener('drag', function() {
            var dragCoordinates = marker.getPosition();
            $('#area-lat').val(dragCoordinates.lat().toFixed(6));
            $('#area-lng').val(dragCoordinates.lng().toFixed(6));
        });
    }

    function setGoogleAddressData(data) {
        if (typeof data['geometry'].location != 'undefined') {
            $('#area-lng').val(data['geometry'].location.lng().toFixed(7)).change();
            $('#area-lat').val(data['geometry'].location.lat().toFixed(7)).change();
        } else {
            $('#area-lng').val('').change();
            $('#area-lat').val('').change();
        }
    }

    function getGoogleAddressData(address) {
        var geocoder = new google.maps.Geocoder();

        geocoder.geocode(
            {'address': address},
            function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    setGoogleAddressData(results[0]);
                } else {
                    $('#area-lng').val('').change();
                    $('#area-lat').val('').change();
                }
            }
        );
    }

    if ($('#map-area').length) {
        initMap();

        $('#area-address').change(function () {
            var address = $("#area-address").val().trim();
            if (address) {
                getGoogleAddressData(address);
            }
        });
    }
}(jQuery);