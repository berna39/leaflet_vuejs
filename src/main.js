import Vue from 'vue'
import 'leaflet/dist/leaflet.css';
import { LMap, LTileLayer, LPolygon } from 'vue2-leaflet';
import App from './App.vue'

Vue.config.productionTip = false

Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-polygon', LPolygon);


new Vue({
  render: h => h(App),
}).$mount('#app')
