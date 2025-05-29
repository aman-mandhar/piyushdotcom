<div>
    <div 
        x-data="mapHandler({ 
            properties: JSON.parse(@js($propertiesJson)), 
            defaultLat: {{ $default_latitude }}, 
            defaultLng: {{ $default_longitude }} 
        })"
        x-init="initMap()"
    >
        <h2 class="text-center mb-4">All Active Properties on Map</h2>

        <!-- City Filter Dropdown -->
        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <label for="cityFilter" class="form-label fw-bold">Filter by City:</label>
                <select id="cityFilter" class="form-select" x-model="selectedCity" @change="filterMarkers()">
                    <option value="">-- All Cities --</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->name }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Map -->
        <div id="map" style="height: 780px; width: 1920; border-radius: 10px;"></div>
    </div>
</div>

@push('scripts')
<script>
    function mapHandler({ properties, defaultLat, defaultLng }) {
        return {
            map: null,
            markers: [],
            selectedCity: '',
            properties,
            popupInterval: null,
            popupIndex: 0,

            initMap() {
                this.map = L.map('map').setView([defaultLat, defaultLng], 5);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(this.map);
                this.renderMarkers();
                this.startAutoPopup();
            },

            renderMarkers() {
                this.markers.forEach(marker => this.map.removeLayer(marker));
                this.markers = [];

                this.properties.forEach(property => {
                    if (!property.city_latitude || !property.city_longitude) return;
                    if (this.selectedCity && property.city !== this.selectedCity) return;

                    const popupContent = `
                        <div style="max-width: 250px;">
                            ${property.image ? `<img src="/storage/${property.image}" style="width:100%; height:auto; border-radius:5px;">` : ''}
                            <strong>${property.property_title}</strong><br>
                            ₹${property.price} ${property.price_in_unit}<br>
                            ${property.property_address}<br>
                            <a href="/properties/${property.slug}/show" class="btn btn-sm btn-outline-success mt-2">View Details</a>
                        </div>
                    `;

                    const marker = L.marker([property.city_latitude, property.city_longitude])
                        .addTo(this.map)
                        .bindPopup(popupContent);

                    marker.on('click', () => {
                        window.location.href = `/properties/${property.slug}/show`;
                    });

                    this.markers.push(marker);
                });

                if (this.markers.length > 0) {
                    const group = L.featureGroup(this.markers);
                    this.map.fitBounds(group.getBounds(), { padding: [50, 50] });
                }
            },

            startAutoPopup() {
                if (this.popupInterval) clearInterval(this.popupInterval);
                this.popupInterval = setInterval(() => {
                    if (!this.markers.length) return;
                    this.markers.forEach(m => m.closePopup());
                    const marker = this.markers[this.popupIndex % this.markers.length];
                    marker.openPopup();
                    this.map.setView(marker.getLatLng(), this.map.getZoom(), {
                        animate: true,
                        duration: 0.5,
                    });
                    this.popupIndex++;
                }, 3000);
            },

            filterMarkers() {
                const match = this.properties.find(p => p.city === this.selectedCity && p.city_latitude && p.city_longitude);
                if (match) {
                    this.map.setView([match.city_latitude, match.city_longitude], 13);
                } else {
                    this.map.setView([defaultLat, defaultLng], 5);
                }
                this.renderMarkers();
                this.startAutoPopup();
            }
        }
    }
</script>
@endpush