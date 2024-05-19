<template>
    <div class="relative flex flex-col mt-6 map_container">
        <div class="relative overflow-hidden h-100 w-100">
            <img
                ref="map_bangladesh_image"
                src="https://i.pinimg.com/736x/9f/45/2e/9f452e4258965408e25b37a22e778dc9.jpg"
                alt="..."
                @mousemove="getMouseCoordinates"
            />
            <!-- Marker -->
<!--            <div-->
<!--                v-for="(marker, index) in markers"-->
<!--                :key="index"-->
<!--                class="absolute"-->
<!--                :style="{ top: marker.y + 'px', left: marker.x + 'px' }"-->
<!--            >-->
<!--                <img-->
<!--                    :src="DefaultMarkerImage"-->
<!--                    alt="Marker"-->
<!--                    class="marker_icon"-->
<!--                />-->
<!--            </div>-->
            <!-- Canvas for markers -->
            <canvas ref="markerCanvas" class="absolute top-0 left-0"></canvas>
        </div>
        <!-- Panel -->
        <div class="absolute top-0 right-0 p-4 bg-white bg-opacity-75 rounded shadow-md">
            <!-- Add your panel content here -->
            <h2 class="text-lg font-semibold mb-2">Map Controls</h2>
            <!-- Example control: Zoom buttons -->
            <div>
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded mr-2">Zoom In</button>
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">Zoom Out</button>
            </div>
        </div>
        <!-- Coordinates Display -->
        <div class="absolute top-0 left-0 p-2 bg-white bg-opacity-75 rounded">{{ mouseX }}, {{ mouseY }}</div>
    </div>
</template>

<script>
import DefaultMarkerImage from '../../images/markers/marker-icon-2x-violet.png'

export default {
    data() {
        return {
            mouseX: 0,
            mouseY: 0,
            markers: [
                { x: 449, y: 210 },
                { x: 478, y: 319 },
                { x: 356, y: 410 },
                { x: 240, y: 200 },
            ],
            DefaultMarkerImage: DefaultMarkerImage,
            markerCanvas: null,
            canvasContext: null,
        };
    },
    mounted() {
        this.markerCanvas = this.$refs.markerCanvas;
        this.canvasContext = this.markerCanvas.getContext('2d');
        this.drawMarkers();
    },
    methods: {
        getMouseCoordinates(event) {
            const image = this.$refs.map_bangladesh_image;
            if (image) {
                const rect = image.getBoundingClientRect();
                const x = (event.clientX - rect.left);
                const y = (event.clientY - rect.top);
                const imageWidth = image.naturalWidth; // Actual image width
                const imageHeight = image.naturalHeight; // Actual image height
                const displayWidth = rect.width; // Displayed image width
                const displayHeight = rect.height; // Displayed image height
                const xRatio = imageWidth / displayWidth; // Ratio of actual image width to displayed width
                const yRatio = imageHeight / displayHeight; // Ratio of actual image height to displayed height
                const markerX = x * xRatio;
                const markerY = y * yRatio;
                this.mouseX = markerX.toFixed(2);
                this.mouseY = markerY.toFixed(2);
            }
        },
        drawMarkers() {
            this.canvasContext.clearRect(0, 0, this.markerCanvas.width, this.markerCanvas.height);
            const image = this.$refs.map_bangladesh_image;
            if (image) {
                const rect = image.getBoundingClientRect();
                this.markers.forEach(marker => {
                    const x = marker.x / rect.width * this.markerCanvas.width;
                    const y = marker.y / rect.height * this.markerCanvas.height;
                    const markerImg = new Image();
                    markerImg.onload = () => {
                        this.canvasContext.drawImage(markerImg, x, y, 15, 20); // Adjust size as needed
                    };
                    markerImg.src = this.DefaultMarkerImage;
                });
            }
        },
    },
};
</script>

<style scoped>
.map_container {
    position: relative;
}

.marker_icon {
    height: 20px;
    width: 15px;
}
</style>
