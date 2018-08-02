<template>
<div class="container col-lg-4 col-lg-offset-4">

    <div class="row ">

        <input type="file" name="image" @change="getimage" accept="image/*">
        <img :src="imageurl" width="100" :alt="imageurl" height="100" srcset="">
        <br>
        <div>
            <button v-if="loaded" @click.prevent="upload" class="btn btn-success">upload</button>
            <button v-if="loaded" @click="cancel" class="btn btn-danger">cancel</button>
        </div>

    </div>
</div>
</template>

<script>
export default {
    props: ["user"],
    data() {
        return {
            imageurl: 'storage/'+this.user.id + '/' +this.user.image,
            loaded: false,
            file: null
        };
    },

    methods: {
        getimage(e) {
           
            this.loaded = true;
            let image = e.target.files[0];
            this.readimage(image);
            let form=new FormData();
            form.append('image',image)
            this.file = form;
        },

        upload() {
            axios
                .post("/saveimage",this.file)
                .then(response => {
                    this.loaded = false;
                });
        },

            readimage(image) {
                let reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e => {
                    this.imageurl = e.target.result;

                    // console.log(this.list['image'])
                };
            },
        cancel() {
            this.imageurl ='storage/'+this.user.id + '/' +this.user.image;
            this.loaded = false;
        }
    }
};
</script>
