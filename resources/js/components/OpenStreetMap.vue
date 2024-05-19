<template>
    <div style="height:500px; width:100%">
        <l-map ref="map" :zoom="zoom" :center="center" :use-global-leaflet="false">
            <l-tile-layer
                url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                layer-type="base"
                name="OpenStreetMap"
                :attribution="attribution"
            ></l-tile-layer>
            <l-marker v-for="(position, index) in markers" :key="index" :lat-lng="position">
                <l-icon
                    :icon-size="[25, 41]"
                    :icon-anchor="[12, 41]"
                    :icon-url="bangladesh_marker"
                    :popup-anchor="[1, -34]"
                    :shadow-url="marker_shadow"
                    :shadow-size="[41, 41]"
                />
                <l-popup :content="markerPopupContent(index)"></l-popup>
            </l-marker>
        </l-map>
    </div>
</template>

<script>
import axios from "axios";
import "leaflet/dist/leaflet.css";
import {LMap, LTileLayer, LMarker, LPopup, LIcon} from "@vue-leaflet/vue-leaflet";
import DefaultAreaImage from "../images/default-images/default-area.png";
import DefaultMarkerImage from  "../images/markers/marker-icon-2x-violet.png";
import MarkerShadow from '../images/markers/marker-shadow.png';
import BangladeshMarker from '../images/flags/bangladesh-marker.png';

export default {
    components: {
        LMap,
        LTileLayer,
        LMarker,
        LPopup,
        LIcon
    },
    data() {
        return {
            default_area_image: DefaultAreaImage,
            default_marker_image: DefaultMarkerImage,
            marker_shadow: MarkerShadow,
            bangladesh_marker: BangladeshMarker,
            zoom: 7,
            center: [23.810332, 90.412518],
            markers: [],
            areas: [],
            attribution: '&copy; <a href="http://osm.org/copyright">Md.Samiul</a> contributors',
        };
    },
    methods: {
        async getWebAreas() {
            try {
                const response = await axios.get('/api/web/get-web-areas');
                if (response?.data?.responseCode === 1) {
                    response.data.areas.forEach(area => {
                        let area_latitude = parseFloat(area?.area_latitude ?? 0);
                        let area_longitude = parseFloat(area?.area_longitude ?? 0);
                        this.markers.push([area_latitude, area_longitude]);
                    });
                    this.areas = response.data.areas;
                }
            } catch (error) {
                alert(error.message);
            }
        },
        markerPopupContent(index) {
            const area = this.areas[index];
            return `
                <div>
                    <img src="${area?.area_img ?? this.default_area_image}" alt="..." style="width: 100px; height: auto;">
                    <p>${area?.area_name_en ?? ''} ${area?.area_name ? `<span>(${area.area_name})</span>` : ''}</p>
                </div>
            `;
        }
    },
    created() {
        this.getWebAreas().then(() => {
            // this way await work
        }).catch(error => {
            alert(error.message);
        });
    }
};
</script>

<style></style>
