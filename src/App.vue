<template>
  <div id="app">
       <div style="height: 600px; width: 100%;">
          <l-map
          :zoom="zoom"
          :center="center"
          :options="mapOptions"
          ref="mymap"
          style="height: 100%;width:100%;"
          @update:center="centerUpdate"
          @update:zoom="zoomUpdate"
          >
            <l-tile-layer
                :url="url"
                :attribution="attribution"
            />

            <l-polygon :lat-lngs="polygon.latlngs" :color="polygon.color"></l-polygon>
         
          </l-map> 
      </div>
  </div>
</template>

<script>
import 'leaflet/dist/leaflet.css';
import { latLng } from "leaflet";
import { LMap, LTileLayer, LPolygon } from "vue2-leaflet";

export default {
  name: 'App',
  data(){
   return{
      zoom: 7,
      center: latLng(-0.5852287, 10.481336),
      url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      attribution:
          '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
      withTooltip: latLng(0, 0),
      mapOptions: {
          zoomSnap: 0.5
      },
      polygon: {
        latlngs: [ [0.4074765,9.4387128], [0.4033163,9.4345758], [0.4008133,9.4370318], [0.4037794,9.4418093]],
        color: 'red'
      }
   }
  },
  components: {
    LMap,
    LTileLayer,
    LPolygon
  },
  methods:{
    zoomUpdate(zoom) {
            this.currentZoom = zoom
        },
        centerUpdate(center) {
            this.currentCenter = center
        },
        showLongText() {
            this.showParagraph = !this.showParagraph
        },

        resizeMap(){
            this.$refs.mymap.mapObject._onResize()
        }
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
