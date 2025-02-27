<div class="modal fade" id="modal-edit_location" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('user_page.Edit Location') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                {{-- <form action="{{ route('restaurant_update_location') }}" method="POST" id="basic-form" class="js-validation" enctype="multipart/form-data" > --}}
                <form action="#" method="POST" id="basic-form" class="js-validation" enctype="multipart/form-data">
                    <input type="hidden" name="id_restaurant" id="id_restaurant" value="{{ $restaurant->id_restaurant }}">

                    <label class="col-sm-3 col-form-label" for="bed" style="font-size: 20px;">{{ __('user_page.Location') }}</label>
                    <div class="col-sm-12 mb-3">
                        <select class="js-select2 form-select" id="id_location" name="id_location" style="width: 100%;">
                            <option></option>
                            @foreach ($locations as $location)
                                @php
                                    $selected = '';
                                    if ($location->id_location == $restaurant->id_location) {
                                        // Any Id
                                        $selected = 'selected="selected"';
                                    }
                                @endphp
                                <option value="{{ $location->id_location }}" {{ $selected }}>
                                    {{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <input id="searchTextFieldRestaurant" type="text" class="form-control mb-3" size="50" onkeydown="preventPressEnterKey(event)">
                        <div id="mapRestaurant" style="width:100%;height:280px;"></div>
                        <input type="hidden" class="form-control" id="latitudeRestaurant" name="latitude"
                            placeholder="Enter a latitude.." value="{{ $restaurant->latitude }}">
                        <input type="hidden" class="form-control" id="longitudeRestaurant" name="longitude"
                            placeholder="Enter a longitude.." value="{{ $restaurant->longitude }}">
                    </div>

                    <br>
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-7">
                            <button type="submit" onclick="saveLocation()" class="btn btn-sm btn-primary">
                                <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                            </button>
                        </div>
                    </div>
                    <!-- END Submit -->
                    <br>
                </form>
                <div>
                    <input type="hidden" name="id_restaurant" id="id_restaurant" value="{{ $restaurant->id_restaurant }}">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Restaurant Map --}}
<script>
    // variabel global marker
    var marker;

    function taruhMarkerRestaurant(map, posisiTitik) {

        if (marker) {
            // pindahkan marker
            marker.setPosition(posisiTitik);
        } else {
            // buat marker baru
            marker = new google.maps.Marker({
                position: posisiTitik,
                map: map,
                icon: {
                    url: 'http://maps.google.com/mapfiles/kml/paddle/orange-stars.png',
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }
            });
        }

        // isi nilai koordinat ke form
        document.getElementById("latitudeRestaurant").value = posisiTitik.lat();
        document.getElementById("longitudeRestaurant").value = posisiTitik.lng();

    }

    // fungsi initialize untuk mempersiapkan peta
    function initializeRestaurant() {
        var latitudeOld = parseFloat('{{ $restaurant->latitude }}');
        var longitudeOld = parseFloat('{{ $restaurant->longitude }}');
        var map = new google.maps.Map(document.getElementById('mapRestaurant'), {
            center: {
                lat: latitudeOld,
                lng: longitudeOld
            },
            styles: [{
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "road.local",
                    "elementType": "all",
                    "stylers": [{
                        "visibility": "on"
                    }]
                },
                {
                    "featureType": "transit.station.airport",
                    "elementType": "labels.icon",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }
            ],
            scrollwheel: true,
            draggable: true,
            gestureHandling: "greedy",
            zoom: 17
        });

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            position: {
                lat: parseFloat(latitudeOld),
                lng: parseFloat(longitudeOld)
            },
            icon: {
                url: 'http://maps.google.com/mapfiles/kml/paddle/orange-circle.png',
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }
            // anchorPoint: new google.maps.Point(0, -29)
        });

        var input = document.getElementById('searchTextFieldRestaurant');

        // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var autocomplete = new google.maps.places.Autocomplete(input);
        console.log(autocomplete);

        autocomplete.bindTo('bounds', map);

        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                // window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            document.getElementById('latitudeRestaurant').value = place.geometry.location.lat();
            document.getElementById('longitudeRestaurant').value = place.geometry.location.lng();
        });


        // even listner ketika peta diklik
        google.maps.event.addListener(map, 'click', function(event) {
            taruhMarkerRestaurant(this, event.latLng);
        });
    }

    // event jendela di-load
    google.maps.event.addDomListener(window, 'load', initializeRestaurant);
</script>
<!-- END Fade In Default Modal -->

{{-- disable enter button --}}
<script>
    function preventPressEnterKey(event){
        if (event.which == '13') {
            event.preventDefault();
        }
    };
</script>
