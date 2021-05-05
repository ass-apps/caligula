<template>
  <div>
    <div :class="viewModeClass">
      <div class="btn-container">
        <i class="fa fa-sun-o" aria-hidden="true"></i>
        <label class="switch btn-color-mode-switch">
          <input
            type="checkbox"
            name="color_mode"
            id="color_mode"
            value="1"
            @change="changeMode()"
          />
          <label
            for="color_mode"
            data-on="Dark"
            data-off="Light"
            class="btn-color-mode-switch-inner"
          ></label>
        </label>
        <i class="fa fa-moon-o" aria-hidden="true"></i>
      </div>
      <VueSlickCarousel :arrows="false" :dots="true" v-bind="settings" ref="carousel" @reInit="onReInitCarousel" @afterChange="afterChange">
        <div v-for="(image, index) in images" v-bind:key="index">
          <img :src="image.image" alt="" />
            <div class="logo">
              <div class="flotant">
                <svg    class="logo-color"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 712.64 179.37">
              
                  <g id="Capa_2" data-name="Capa 2"> <g id="Layer_1" data-name="Layer 1">
                      <path
                        class="cls-1"
                        d="M30.25,10.38c31.85,0,30,32.55,30,44.1a3.36,3.36,0,0,1-3.47,3.23H46.87a3.65,3.65,0,0,1-3.7-3.7c.23-7.84-.46-25.62-10.85-25.62,0,0-14.08-1.85-14.08,19.16v92.34c0,21,11.78,21,11.78,21,13.15,0,14.54-19.85,14.54-28.4a3.65,3.65,0,0,1,3.69-3.69h9A3.61,3.61,0,0,1,61,132.27c.46,11.55-.69,46.4-31.86,46.4,0,0-29.08.93-29.08-30V48.71S-1.15,10.38,30.25,10.38Z"
                      />
                      <path
                        class="cls-1"
                        d="M161.6,164.6H149.37c-2.54,0-3-1.85-3.47-4.39l-2.77-18.93a9.91,9.91,0,0,0-9.69-8.77H120.51a10.15,10.15,0,0,0-9.93,8.54l-2.77,19.16c-.23,2.54-.23,4.39-2.77,4.39H92.12c-3,0-3-2.77-2.54-5.78L113.59,9c1.38-7.38,3.92-9,9-9h8.54c5.08,0,7.85,2.31,9,9l24,149.82C164.6,161.83,164.6,164.6,161.6,164.6Zm-39-55.64h8.54a6.43,6.43,0,0,0,6.46-7.39l-7.85-56.09c-.46-3-5.07-3-5.3,0l-8.08,56.09A6.27,6.27,0,0,0,122.59,109Z"
                      />
                      <path
                        class="cls-1"
                        d="M240.79,158.13c4.38,0,5.31-.69,5.31,5.31v7.85c0,4.15.23,5.31-5.31,5.31H205c-4.39,0-5.31-1.39-5.31-5.31V17.08c0-3.93-.47-5.31,5.31-5.31h8.54c5.08,0,5.31.92,5.31,5.31V152.59a5.62,5.62,0,0,0,5.54,5.54Z"
                      />
                      <path
                        class="cls-1"
                        d="M293.88,176.83c-3,0-5.31-1.16-5.31-4.16V15.23c0-3,2.31-3.69,5.31-3.69h8.54c3,0,5.31,1.38,5.31,4.38V172.67c0,3-2.3,4.16-5.31,4.16Z"
                      />
                      <path
                        class="cls-1"
                        d="M407.46,176.6h-9.7a2.81,2.81,0,0,1-2.77-2.77v-2.54c-3.46,4.15-8.31,6.92-15.23,7.15,0,0-29.09,1.16-29.09-30v-100s-1.38-37.39,30.24-38.32c31.63,0,28.63,32.55,28.63,44.33,0,1.84-1.85,3.23-3.7,3.23h-9.92a3.46,3.46,0,0,1-3.47-3.7c0-7.84.93-25.62-9.46-25.62,0,0-14.08-.23-14.08,19.16v92.34c0,21,11.77,21,11.77,21,12.93,0,12.93-20.09,12.93-28.63v-6.69A7.68,7.68,0,0,0,386,118h-4.15a4.39,4.39,0,0,1-4.39-4.39v-7.15a4.44,4.44,0,0,1,4.39-4.62l19.16-.23a9.27,9.27,0,0,1,9.23,9.23v63A3,3,0,0,1,407.46,176.6Z"
                      />
                      <path
                        class="cls-1"
                        d="M507.42,11.54c5.77,0,6.47,1.85,6.47,6.69v130.9a30.36,30.36,0,0,1-60.72,0V18.23c0-4.38.46-6.46,6.7-6.46h5.54c6,0,6.69,1.62,6.69,6.46V146.59c0,7.15,5.08,13.15,11.54,13.15,6.24,0,11.32-5.31,11.32-13.15V18.23c0-4.61.23-6.69,6.69-6.69Z"
                      />
                      <path
                        class="cls-1"
                        d="M598.61,158.13c4.38,0,5.31-.69,5.31,5.31v7.85c0,4.15.23,5.31-5.31,5.31H562.83c-4.39,0-5.31-1.39-5.31-5.31V17.08c0-3.93-.47-5.31,5.31-5.31h8.54c5.08,0,5.31.92,5.31,5.31V152.59a5.62,5.62,0,0,0,5.54,5.54Z"
                      />
                      <path
                        class="cls-1"
                        d="M640.39,12h12.24c2.54,0,3,1.85,3.46,4.39l2.77,18.93a9.93,9.93,0,0,0,9.7,8.77h12.92a10.16,10.16,0,0,0,9.93-8.54l2.77-19.16c.23-2.54.23-4.39,2.77-4.39h12.93c3,0,3,2.77,2.54,5.77l-24,149.82c-1.39,7.39-3.93,9-9,9h-8.55c-5.07,0-7.84-2.31-9-9l-24-149.82C637.39,14.77,637.39,12,640.39,12Zm39,55.63h-8.55A6.44,6.44,0,0,0,664.4,75l7.85,56.1c.46,3,5.08,3,5.31,0L685.64,75A6.28,6.28,0,0,0,679.41,67.63Z"
                      />
                    </g>
                  </g>
                </svg>
              </div>
            <div class="txt"  v-if="lang=='es'">Elementos distintivos y gusto</div>
            <div class="txt"  v-else>Distinctive elements & taste</div>
          </div>
     
        </div>
      </VueSlickCarousel>
     
            <div class="text-idioma">
             <button @click="changeLang('en')">EN </button>
             <span>/</span>
             <button @click="changeLang('es')"> ES</button>
            
            </div>
     
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
          { image: "assets/img/color bW.001.png", darkModeOnly: false },
        { image: "assets/img/color bW.002.png", darkModeOnly: true },
        { image: "assets/img/color bW.004.png", darkModeOnly: false },
        { image: "assets/img/color bW.005.png", darkModeOnly: true },
        { image: "assets/img/color bW.006.png", darkModeOnly: false },
        { image: "assets/img/color bW.007.png", darkModeOnly: true },
        { image: "assets/img/color bW.008.png", darkModeOnly: false },
        { image: "assets/img/color bW.010.png", darkModeOnly: true },
        { image: "assets/img/color bW.012.png", darkModeOnly: false },
        { image: "assets/img/color bW.013.png", darkModeOnly: true },
        { image: "assets/img/color bW.014.png", darkModeOnly: true },
        { image: "assets/img/color bW.015.png", darkModeOnly: false },
        { image: "assets/img/color bW.017.png", darkModeOnly: true },
        { image: "assets/img/color bW.019.png", darkModeOnly: false },
        { image: "assets/img/color bW.020.png", darkModeOnly: true },
        { image: "assets/img/color bW.022.png", darkModeOnly: false },
        { image: "assets/img/color bW.024.png", darkModeOnly: true },
        { image: "assets/img/color bW.026.png", darkModeOnly: false },
        { image: "assets/img/color bW.028.png", darkModeOnly: true },
        { image: "assets/img/color bW.030.png", darkModeOnly: true },
        { image: "assets/img/color bW.031.png", darkModeOnly: false },
        { image: "assets/img/color bW.032.png", darkModeOnly: true },
        { image: "assets/img/color bW.034.png", darkModeOnly: false },
        { image: "assets/img/color bW.036.png", darkModeOnly: true },
        { image: "assets/img/color bW.037.png", darkModeOnly: false },
        { image: "assets/img/color bW.038.png", darkModeOnly: true },
        { image: "assets/img/color bW.040.png", darkModeOnly: false },
        { image: "assets/img/color bW.041.png", darkModeOnly: true },
   
      ],
      isChangeModeActive:false,
      images:[],
      currentPage:0,
      settings: {
        slidesToShow: 1,
        autoplay: true,
        fade: true,
        cssEase: "linear",
        arrows: false,
        autoplaySpeed: 1000,
        pauseOnHover: false,
        pauseOnFocus: false,
      },
      lang: "es",
    };
  },
  methods: {
    
    changeMode(){

      this.isChangeModeActive = true
      this.viewModeClass = this.viewModeClass == "white-preview" ? this.viewModeClass = "dark-preview" : this.defaultMode = "white-preview"
      this.images = []
      if(this.viewModeClass == "dark-preview"){

        this.initialImages.forEach((data, index) => {
          if (data.darkModeOnly == false) {
            this.images.push(data);
          }
        });
      } else {
        this.images = this.initialImages;
      }
    },
    onReInitCarousel() {

      if(this.isChangeModeActive == true){
        this.isChangeModeActive = false

        if(this.images.length != this.initialImages.length){
          if(this.currentPage == 0 || this.currentPage == 1)
            this.$refs.carousel.goTo(0)
          
          if(this.currentPage == 2 || this.currentPage == 3)
            this.$refs.carousel.goTo(1)

          if(this.currentPage == 4 || this.currentPage == 5)
            this.$refs.carousel.goTo(3)
        }

      }

      
      //this.$refs.carousel.goTo(0)
    },
    afterChange(page){

      this.currentPage = page

    },
      changeLang(lang) {
      this.lang = lang;
    }
    
  },
  created(){
    this.images = this.initialImages
  }
};
</script> 

