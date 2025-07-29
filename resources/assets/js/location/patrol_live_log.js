document.addEventListener('livewire:load', function() {
                initMap(); // Initialize the map on load

                // Listen for Livewire updates
                Livewire.on('updateLocation', (data) => {
                    console.log('Updated Data:', data);
                    updateMarker(data.lat, data.lng, data.serial_number, data.timestamp);
                });

                // Function to get user location
                function getUserLocation() {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            console.log("User location granted!", position.coords);

                            // document.getElementById("map-container").style.display = "block";

                            Livewire.emit('fetchNewCoordinates', position.coords.latitude, position.coords
                                .longitude);

                            console.log(position.coords);
                        },
                        (error) => {
                            console.error("Error getting location:", error);
                            showLocationError("Location access denied. Enable location services and refresh.");
                        }, {
                            enableHighAccuracy: true
                        }
                    );
                }

                // Poll Livewire for updates every 10 seconds
                setInterval(() => {
                    // console.log('Fetching new coordinates...');
                    getUserLocation();
                }, 10000);
            });

            let map, marker;

            function initMap() {
                locationiq.key = document.getElementById('iq_pk').value;

                if (document.getElementById('map') === null) return;

                // Initialize map
                map = new maplibregl.Map({
                    container: "map",
                    style: locationiq.getLayer("Streets"), // Default map style
                    zoom: 16,
                    center: [@json($longitude), @json($latitude)],
                });

                // Create a popup
                var popup = new maplibregl.Popup({
                        offset: 25
                    })
                    .setHTML('<b>Employee ID:</b> - <br> <b>Last Updated:</b> -')
                    .addTo(map);

                // Create marker
                marker = new maplibregl.Marker()
                    .setLngLat([@json($longitude), @json($latitude)])
                    .setPopup(popup)
                    .addTo(map);

                popup.addTo(map);

                // Add Scale Control
                map.addControl(new maplibregl.ScaleControl({
                    maxWidth: 100,
                    unit: "metric" // Use "imperial" for miles
                }));

                // Add Navigation Controls (Zoom In/Out)
                var nav = new maplibregl.NavigationControl();
                map.addControl(nav, 'top-right');

                // Add Fullscreen Control
                map.addControl(new maplibregl.FullscreenControl());

                // Add Geolocation Control (Only works with HTTPS)
                map.addControl(new maplibregl.GeolocateControl({
                    positionOptions: {
                        enableHighAccuracy: true
                    },
                    trackUserLocation: true
                }));

                // Add Map Type Selector (Layer Switcher)
                var layerStyles = {
                    "Streets": "streets/vector",
                    "Dark": "dark/vector",
                    "Light": "light/vector"
                };

                map.addControl(new locationiqLayerControl({
                    key: locationiq.key,
                    layerStyles: layerStyles
                }), 'top-left');
            }

            function updateMarker(lat, lng, serial_number, timestamp) {
                if (!marker || !map) {
                    // console.log('Marker or Map is not initialized yet!');
                    return;
                }

                marker.setLngLat([lng, lat]); // Move marker
                map.setCenter([lng, lat]); // Re-center map

                // Update popup with new employee ID and timestamp
                marker.getPopup().remove();
                var popup = new maplibregl.Popup({
                        offset: 25
                    })
                    .setHTML(`<b>Employee ID:</b> ${serial_number}<br> <b>Last Updated:</b> ${timestamp}`)
                    .addTo(map);

                marker.setPopup(popup);
                popup.addTo(map);
            }

            function showLocationError(message) {
                let alertBox = document.getElementById("location-alert");
                alertBox.innerHTML = `⚠️ ${message} <button id="retry-location">Retry</button>`;
                alertBox.style.display = "block";
            }

