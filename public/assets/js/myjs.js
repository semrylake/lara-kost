if (navigator.geolocation) {
    navigator.geolocation.watchPosition(showPosition);
} else {
    x.innerHTML = "Geolocation is not supported by this browser.";
}

function showPosition(position) {
    const lat = position.coords.latitude;
    const long = position.coords.longitude;
    console.log("Latitude: " + lat);
    console.log("Longitude: " + long);

}

// <script>
//     let map, infoWindow;

//     function initMap() {
//     map = new google.maps.Map(document.getElementById("map"), {
//         center: { lat: -34.397, lng: 150.644 },
//         zoom: 6,
//     });
//     infoWindow = new google.maps.InfoWindow();

//     const locationButton = document.createElement("button");

//     locationButton.textContent = "Pan to Current Location";
//     locationButton.classList.add("custom-map-control-button");
//     map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
//     locationButton.addEventListener("click", () => {
//         // Try HTML5 geolocation.
//         if (navigator.geolocation) {
//         navigator.geolocation.getCurrentPosition(
//             (position) => {
//             const pos = {
//                 lat: position.coords.latitude,
//                 lng: position.coords.longitude,
//             };

//             infoWindow.setPosition(pos);
//             infoWindow.setContent("Location found.");
//             infoWindow.open(map);
//             map.setCenter(pos);
//             },
//             () => {
//             handleLocationError(true, infoWindow, map.getCenter());
//             }
//         );
//         } else {
//         // Browser doesn't support Geolocation
//         handleLocationError(false, infoWindow, map.getCenter());
//         }
//     });
//     }

//     function handleLocationError(browserHasGeolocation, infoWindow, pos) {
//     infoWindow.setPosition(pos);
//     infoWindow.setContent(
//         browserHasGeolocation
//         ? "Error: The Geolocation service failed."
//         : "Error: Your browser doesn't support geolocation."
//     );
//     infoWindow.open(map);
//     }
// </script>



{/* <script>


        navigator.geolocation.getCurrentPosition(success,console.error);

    function success(data){
        var api_key = '02fc97ec722c4954841775a72d3667d9';
    var latitude = data.coords.latitude;
    var longitude = data.coords.longitude;

    var api_url = 'https://api.opencagedata.com/geocode/v1/json'

    var request_url = api_url
        + '?'
        + 'key=' + api_key
        + '&q=' + encodeURIComponent(latitude + ',' + longitude)
        + '&pretty=1'
        + '&no_annotations=1';

    // see full list of required and optional parameters:
    // https://opencagedata.com/api#forward

    var request = new XMLHttpRequest();
    request.open('GET', request_url, true);

    request.onload = function() {
        // see full list of possible response codes:
        // https://opencagedata.com/api#codes

        if (request.status === 200){
        // Success!
        var data = JSON.parse(request.responseText);
        alert(data.results[0].formatted); // print the location

        } else if (request.status <= 500){
        // We reached our target server, but it returned an error

        console.log("unable to geocode! Response code: " + request.status);
        var data = JSON.parse(request.responseText);
        console.log('error msg: ' + data.status.message);
        } else {
        console.log("server error");
        }
    };

    request.onerror = function() {
        // There was a connection error of some sort
        console.log("unable to connect to server");
    };

    request.send();  // make the request

    }

</script> */}

//  <script async defer
//     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCueVJrO7FkMxGPutUScb99BL8gQaHvwh4&callback=init"
//     type="text/javascript"></script>

