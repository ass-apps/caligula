<template>
  <div>
    <div :class="viewModeClass">
      <div class="btn-container">
        <i class="fa fa-sun-o" aria-hidden="true"></i>
        <label class="switch btn-color-mode-switch">
          <input type="checkbox" name="color_mode" id="color_mode" value="1" @change="changeMode()"/>
          <label
            for="color_mode"
            data-on="Dark"
            data-off="Light"
            class="btn-color-mode-switch-inner"
          ></label>
        </label>
        <i class="fa fa-moon-o" aria-hidden="true"></i>
      </div>
      <VueSlickCarousel :arrows="false" :dots="false" v-bind="settings">
        <div v-if="viewModeClass == 'dark-preview' || viewModeClass == 'white-preview'">
          <img src="assets/img/Coming soon finales.001.png" alt="" />
        </div>
        <div v-if="viewModeClass == 'white-preview'">
          <img  src="assets/img/Coming soon finales.002.png" alt="" />
          </div>
        <div v-if="viewModeClass == 'dark-preview' || viewModeClass == 'white-preview'">
          <img src="assets/img/Coming soon finales.004.png" alt="" />
          </div>
        <div v-if="viewModeClass == 'white-preview'">
          <img src="assets/img/Coming soon finales.005.png" alt="" />
        </div>
        <div v-if="viewModeClass == 'dark-preview' || viewModeClass == 'white-preview'">
          <img src="assets/img/Coming soon finales.006.png" alt="" />
        </div>
        <div v-if="viewModeClass == 'white-preview'">
          <img src="assets/img/Coming soon finales.007.png" alt="" />
          </div>
      </VueSlickCarousel>
    </div>
  </div>
</template>
 
<script>
import VueSlickCarousel from "vue-slick-carousel";
import "vue-slick-carousel/dist/vue-slick-carousel.css";
// optional style for arrows & dots
import "vue-slick-carousel/dist/vue-slick-carousel-theme.css";

export default {
  name: "MyComponent",
  components: { VueSlickCarousel },
  data() {
    return {
      viewModeClass:"white-preview",
      settings: {
        slidesToShow: 1,
        speed: 1000,
        fade: true,
        autoplay: true,
        fade: true,
        cssEase: "linear",
        arrows: false,
      },
    };
  },
  methods: {
    
    changeMode(){

      this.viewModeClass = this.viewModeClass == "white-preview" ? this.viewModeClass = "dark-preview" : this.defaultMode = "white-preview"

    }
    
  },
};

</script> 