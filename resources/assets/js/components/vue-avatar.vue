<template>
<div >
   
    <div v-if="!croped">
       <vue-avatar
        :width=400
        :height=400
        :border-radius=200
        
        ref="vueavatar"
        @vue-avatar-editor:image-ready="onImageReady"
        :image="cropedimage"
      >
      </vue-avatar>
      <br>
      <vue-avatar-scale
        ref="vueavatarscale"
        @vue-avatar-editor-scale:change-scale="onChangeScale"
        :width=250
        :min=1
        :max=3
        :step=0.02
      >
      </vue-avatar-scale> 
        <br>
      <img src="" id="img-1">
      <button v-on:click="saveClicked">Click</button>
    </div>

    <div v-if="croped">
         <img :src="cropedimage" alt="" srcset="">
         <br>
         <button class="btn btn-dark" @click="back" >back</button>
    </div>
      
    
    </div>
</template>

<script>
import Vue from "vue";
import VueAvatar from "./vue-avatar-editor/src/components/VueAvatar.vue";
import VueAvatarScale from "./vue-avatar-editor/src/components/VueAvatarScale.vue";
export default {
  data() {
    return {
      cropedimage: null,
      croped: false
    };
  },

  components: {
    VueAvatar,
    VueAvatarScale
  },
  methods: {
    onChangeScale(scale) {
      this.$refs.vueavatar.changeScale(scale);
      console.log(scale);
    },
    saveClicked() {
      var img = this.$refs.vueavatar.getImageScaled();
      this.cropedimage = img.toDataURL();
      this.croped = true;
      console.log(img);
      // use img
    },
    onImageReady(scale) {
     var dd= this.$refs.vueavatarscale.setScale(scale);
    },

    back() {
      this.croped = false;
    }
  }
};
</script>
