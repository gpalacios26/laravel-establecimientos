<template>
    <div class="mapa">
        <l-map :zoom="zoom" :center="center" :options="mapOptions">
            <l-tile-layer :url="url" :attribution="attribution" />
            <l-marker :lat-lng="{ lat, lng }">
                <l-tooltip>
                    <div>{{ establecimiento.nombre }}</div>
                </l-tooltip>
            </l-marker>
        </l-map>
    </div>
</template>

<script>
import { latLng } from "leaflet";
import { LMap, LTileLayer, LMarker, LTooltip } from "vue2-leaflet";

export default {
    name: "mapa-ubicacion",
    components: {
        LMap,
        LTileLayer,
        LMarker,
        LTooltip,
    },
    data() {
        return {
            zoom: 16,
            center: latLng(-12.0405721, -76.9265165),
            url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            attribution:
                '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            currentZoom: 11.5,
            mapOptions: {
                zoomSnap: 0.5,
            },
            lat: "",
            lng: "",
        };
    },
    created() {
        setTimeout(() => {
            this.lat = this.$store.getters.obtenerEstablecimiento.lat;
            this.lng = this.$store.getters.obtenerEstablecimiento.lng;
            this.center = latLng(this.lat, this.lng);
        }, 300);
    },
    computed: {
        establecimiento() {
            return this.$store.getters.obtenerEstablecimiento;
        },
    },
};
</script>

<style scoped>
@import "https://unpkg.com/leaflet@1.6.0/dist/leaflet.css";

.mapa {
    height: 320px;
    width: 100%;
}
</style>
