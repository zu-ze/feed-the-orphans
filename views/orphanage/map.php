<?php
$orphanage = Application::$app->session->getOrphanage();
?>
<div class="pt-2 px-2" >
    <div id="map" class="shadow-2xl" style="height: 80vh; width: 100%;" ></div>
    <div class="controls pt-2 flex flex-row items-center justify-center">
        <button 
            type="button" 
            id='currentLocation'
            class="text-white p-2 bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >current location</button>
        <button 
            type="button" 
            id='pickLocation'
            class="text-white p-2 bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >Pick location</button>
        <button
            type="button"
            id='resetLocation'
            class="text-white p-2 bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >Reset
        </button>
        <button
            type='button'
            id='setLocation'
            class="text-white p-2 bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >Set location
        </button>
        <form action="/orphanage/map" id="setLocationForm" method="post">
            <input type="hidden" name="latitude" id="latitude" value="<?php echo $orphanage->latitude ?? '-11.4219' ?>" >
            <input type="hidden" name="longitude" id="longitude" value="<?php echo $orphanage->longitude ?? '33.9954' ?>" >
            <input type="hidden" name="name" id="name" value="<?php echo $orphanage->name ?? '' ?>"
        </form>
    </div>
</div>
<script>
    let map, infoWindow, marker = false;

    document.getElementById('pickLocation').onclick = pickLoc
    document.getElementById('resetLocation').onclick = resetLoc;
    document.getElementById('currentLocation').onclick = getCurrentLoc;
    document.getElementById('setLocation').onclick = setLocation;

    function initMap()
    {
        var center = {
            lat: parseFloat(document.getElementById('latitude').value),
            lng: parseFloat(document.getElementById('longitude').value)
        }

        if (marker === false)
            marker = {
                coords: center,
                content: document.getElementById('name').value
            }
        
        map = new google.maps.Map(document.getElementById("map"), {
            center: center,
            zoom: 14,
        });
        loadMarker();
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) 
    {
        infoWindow.setPosition(pos);
        infoWindow.setContent(
            browserHasGeolocation ?
            "Error: The Geolocation service failed." :
            "Error: Your browser doesn't support geolocation"
        );
        infoWindow.open(map);
    }

    function loadMarker()
    {
        if(marker !== false) {
            addMarker(marker);
            map.setCenter(marker.coords);
        }
        map.setZoom(18);
    }

    function addMarker(props)
    {
        var marker = new google.maps.Marker({
            position: props.coords,
            map: map
        });

        if (props.iconImage) {
            marker.setIcon(props.iconImage)
        }

        if (props.content) {
            var infoWindow = new google.maps.InfoWindow({
                content: props.content
            })

            marker.addListener("click", () => {
                infoWindow.open(map, marker);
            })
        }
    }

    function pickLoc()
    {
        marker = false;
        google.maps.event.addListener(map, 'click', (evt) => {
            marker = {
                coords: { 
                    lat: evt.latLng.lat(),
                    lng: evt.latLng.lng()
                }
            };
            initMap()
        });
    }

    function resetLoc()
    {
        marker = false;
        initMap();
    }

    function getCurrentLoc()
    {
        resetLoc();
        infoWindow = new google.maps.InfoWindow();
        // try HTML5 geolocation
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                ( position ) => {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    marker = {
                        coords: pos,
                        content: "Location found."
                    };
                    loadMarker();
                    console.log(pos);

                    // infoWindow.setPosition(pos);
                    // infoWindow.setContent("Location found.");
                    // infoWindow.open(map);
                    map.setCenter(pos);
                },
                () => {
                    handleLocationError(true, infoWindow, map.getCenter());
                }
            );
        } else {
            // Browser doesn't support geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function setLocation()
    {
        if (typeof marker.coords !== 'undefined' ) {
            document.getElementById('latitude').value = marker.coords.lat? marker.coords.lat : '';
            document.getElementById('longitude').value = marker.coords.lng? marker.coords.lng : ''; 
            var form = document.getElementById('setLocationForm');
            form.submit();
        } else {
            alert('Please select a location first.');
        }
    }

</script>
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-gIQHU-lkEKpy05n7m8P-q1obHdaRWdw&callback=initMap">
</script>
