var mapOptions;
var geocoder;
var infowindow = new google.maps.InfoWindow();

var values = new Array();
var category = new Array();

var pos;
$(document).ready(function() {
    function selectCity()
    {
        var category = $('input:checkbox:checked.filterEventChbx').map(function() {
            return this.value;
        }).get();
        var values = $('input:checkbox:checked.filterNgoChbx').map(function() {
            return this.value;
        }).get();
        var v = $("#filterCity").val();
        $.ajax({
            type: "GET",
            url: 'eventList.php',
            data: {
                selectedCategory: category,
                selectedNgo: values,
                filterCity: v
            }, // appears as $_GET['id'] @ ur backend side
            success: function(data) {
// data is ur summary
                $('#filterList').html(data);
            }

        });
    }
    $(".filterEventChbx").click(function() {
        var category = $('input:checkbox:checked.filterEventChbx').map(function() {
            return this.value;
        }).get();
        var values = $('input:checkbox:checked.filterNgoChbx').map(function() {
            return this.value;
        }).get();
        var v = $("#filterCity").val();
        $.ajax({
            type: "GET",
            url: 'eventList.php',
            data: {
                selectedCategory: category,
                selectedNgo: values,
                filterCity: v
            }, // appears as $_GET['id'] @ ur backend side
            success: function(data) {
// data is ur summary
                $('#filterList').html(data);
            }

        });
    });
    $(".filterNgoChbx").click(function() {
        var category = $('input:checkbox:checked.filterEventChbx').map(function() {
            return this.value;
        }).get();
        var values = $('input:checkbox:checked.filterNgoChbx').map(function() {
            return this.value;
        }).get();
        var v = $("#filterCity").val();
        $.ajax({
            type: "GET",
            url: 'eventList.php',
            data: {
                selectedCategory: category,
                selectedNgo: values,
                filterCity: v
            }, // appears as $_GET['id'] @ ur backend side
            success: function(data) {
// data is ur summary
                $('#filterList').html(data);
            }

        });
    });
    $("#previousEvents").click(function() {
        $("#regEmail").slideDown("slow");
    });
    $("#prevEventsBtn").click(function() {
        var regEmail = $("#prevEmailTxt").val();
        $.ajax({
            type: "GET",
            url: 'eventList.php',
            data: {
                regEmailID: regEmail
            }, // appears as $_GET['id'] @ ur backend side
            success: function(data) {
// data is ur summary

                $('#filterList').html(data);
            }

        });
    });
});
//------------------------------------------Near by events--------------------------------
var map;
var markers = [];
var infoWindow;
var locationSelect;
function load() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(18.5324846, 73.8374954),
        zoom: 12,
        mapTypeId: 'roadmap',
        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
    });
    infoWindow = new google.maps.InfoWindow();
    locationSelect = document.getElementById("locationSelect");
    locationSelect.onchange = function() {
        var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
        if (markerNum != "none") {
            google.maps.event.trigger(markers[markerNum], 'click');
        }
    };
}

function searchLocations() {
    var address = document.getElementById("addressInput").value;
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({'address': address}, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            searchLocationsNear(results[0].geometry.location);
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

function clearLocations() {
    infoWindow.close();
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
    markers.length = 0;
    locationSelect.innerHTML = "";
    var option = document.createElement("option");
    option.value = "none";
    option.innerHTML = "See all results:";
    locationSelect.appendChild(option);
}

function searchLocationsNear() {
//                clearLocations();

//    var radius = document.getElementById('radiusSelect').value;
//    radius = radius * 1.609344;
//    alert(radius);
    alert(pos.lat());
    var searchUrl = 'http://localhost/ngo_phase1/modules/events/getXML.php?lat=' + pos.lat() + '&lng=' + pos.lng() + '&radius=' + 10;
//                var searchUrl = 'http://localhost/ngo_phase1/modules/events/getXML.php?lat=18.5516174&lng=73.8257325&radius=10';
    downloadUrl(searchUrl, function(data) {
        alert(data);
        var xml = parseXml(data);
        var markerNodes = xml.documentElement.getElementsByTagName("event_info");
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0; i < markerNodes.length; i++) {
            var name = markerNodes[i].getAttribute("name");
            var distance = parseFloat(markerNodes[i].getAttribute("distance"));
            var latlng = new google.maps.LatLng(
                    parseFloat(markerNodes[i].getAttribute("lat")),
                    parseFloat(markerNodes[i].getAttribute("lng")));
//            createOption(name, distance, i);
            createMarker(latlng, name, distance);
            bounds.extend(latlng);
        }
        map.fitBounds(bounds);
        locationSelect.style.visibility = "visible";
        locationSelect.onchange = function() {
            var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
            google.maps.event.trigger(markers[markerNum], 'click');
        };
    });
}

function createMarker(latlng, name, distance) {
    alert(name);
    var html = "<b>" + name + "</b> " + "<br/>"+distance;
    var marker = new google.maps.Marker({
        map: map,
        position: latlng
    });
    google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
    });
    markers.push(marker);
}

function createOption(name, distance, num) {
    alert(name);
    var option = document.createElement("option");
    option.value = num;
    option.innerHTML = name + "(" + distance.toFixed(1) + ")";
    locationSelect.appendChild(option);
}

function downloadUrl(url, callback) {
    var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request.responseText, request.status);
        }
    };

    request.open('GET', url, true);
    request.send(null);
}

function parseXml(str) {
    if (window.ActiveXObject) {
        var doc = new ActiveXObject('Microsoft.XMLDOM');
        doc.loadXML(str);
        return doc;
    } else if (window.DOMParser) {
        return (new DOMParser).parseFromString(str, 'text/xml');
    }
}

function doNothing() {
}
//---------------------------------------------------------------------GPS
function initialize() {
    mapOptions = {
        zoom: 12,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    map = new google.maps.Map(document.getElementById("map"),
            mapOptions);
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
             pos = new google.maps.LatLng(position.coords.latitude,
                    position.coords.longitude);

            var infowindow = new google.maps.InfoWindow({
                map: map,
                position: pos,
                content: 'Tu yaha hai'
            });

            map.setCenter(pos);
            
        },
        
        function() {
            handleNoGeolocation(true);
        });
    } else {
// Browser doesn't support Geolocation
        handleNoGeolocation(false);
    }
}

function handleNoGeolocation(errorFlag) {
    if (errorFlag) {
        var content = 'Error: The Geolocation service failed.';
    } else {
        var content = 'Error: Your browser doesn\'t support geolocation.';
    }

    var options = {
        map: map,
        position: new google.maps.LatLng(60, 105),
        content: content
    };

    var infowindow = new google.maps.InfoWindow(options);
    map.setCenter(options.position);
}


//----------------------------------------------reverse

function codeLatLng() {
    
  
  var lat = pos.lat();
  var lng = pos.lng();

  var latlng = new google.maps.LatLng(lat, lng);

  geocoder.geocode({'latLng': latlng}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
            alert(status);
      if (results[1]) {
        map.setZoom(11);
        marker = new google.maps.Marker({
            position: latlng,
            map: map
        });
        infowindow.setContent(results[1].formatted_address);
        infowindow.open(map, marker);
      } else {
        alert('No results found');
      }
    } else {
      alert('Geocoder failed due to: ' + status);
    }
  });
}
