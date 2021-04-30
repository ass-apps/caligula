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
      <VueSlickCarousel :arrows="false" :dots="false" v-bind="settings" ref="carousel" @reInit="onReInitCarousel">
        <div v-for="(image, index) in images" v-bind:key="index">
          <img :src="image.image" alt="" />
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
      initialImages:[
        {"image": "assets/img/Coming_soon_finales.001.png", "darkModeOnly": false},
        {"image": "assets/img/Coming_soon_finales.002.png", "darkModeOnly": true},
        {"image": "assets/img/Coming_soon_finales.004.png", "darkModeOnly": false},
        {"image": "assets/img/Coming_soon_finales.005.png", "darkModeOnly": true},
        {"image": "assets/img/Coming_soon_finales.006.png", "darkModeOnly": false},
        {"image": "assets/img/Coming_soon_finales.007.png", "darkModeOnly": true},
      ],
      images:[],
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
      this.images = []
      if(this.viewModeClass == "dark-preview"){

        this.initialImages.forEach((data, index) => {

          if(data.darkModeOnly == false){
            this.images.push(data)
          }

        })

      }else{
        this.images = this.initialImages
      }


    },
    onReInitCarousel() {
      if(this.images.length != this.initialImages.length){
        this.$refs.carousel.goTo(0)
      }
      //this.$refs.carousel.goTo(0)
    },
    
  },
  created(){
    this.images = this.initialImages
  }
};

</script> 
<style >

</style>