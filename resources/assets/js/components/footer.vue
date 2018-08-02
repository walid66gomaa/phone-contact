<template>
<div class="container col-lg-4 col-lg-offset-4">

    <div class="row ">

        <input type="file" name="image" @change="getimage" accept="image/*">
        <img :src="imageurl" width="100" :alt="imageurl" height="100" srcset="">
        <br>
        <div>
        <button v-if="loaded" @click.prevent="upload"  class="btn btn-success">upload</button>
        <button v-if="loaded" @click="cancel"  class="btn btn-danger">cancel</button>
        </div>

    </div>
</div>
</template>

<script>
    export default {
        props: ["user"],
        data() {
            return {
                imageurl: this.user.url,
                loaded: false
            };
        },

        methods: {
            getimage(e) {
             
                this.loaded = true;
                let image = e.target.files[0];
                this.readimage(image);
            },

            readimage(image) {
                let reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e => {
                    this.imageurl = e.target.result;

                    // console.log(this.list['image'])
                };
            },

            upload() {
                axios
                    .post("/upload", {
                        image: this.imageurl
                    })
                    .then(response => {

                       this.loaded=false;

                    });
            },

            cancel()
            {
this.imageurl=this.user.url;
this.loaded=false;
            }
        }
    };
</script>

<!--

<template>
    <!-- Footer -->
<footer class="page-footer font-small blue-grey lighten-5">

    <div style="background-color: #21d192;">
        <div class="container">

            <!-- Grid row-->
            <div class="row py-4 d-flex align-items-center">

                <!-- Grid column -->
                <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
                    <h6 class="mb-0">Get connected with us on social networks!</h6>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-6 col-lg-7 text-center text-md-right">

                    <!-- Facebook -->
                    <a class="fb-ic">
              <i class="fa fa-facebook white-text mr-4"> </i>
            </a>
                    <!-- Twitter -->
                    <a class="tw-ic">
              <i class="fa fa-twitter white-text mr-4"> </i>
            </a>
                    <!-- Google +-->
                    <a class="gplus-ic">
              <i class="fa fa-google-plus white-text mr-4"> </i>
            </a>
                    <!--Linkedin -->
                    <a class="li-ic">
              <i class="fa fa-linkedin white-text mr-4"> </i>
            </a>
                    <!--Instagram-->
                    <a class="ins-ic">
              <i class="fa fa-instagram white-text"> </i>
            </a>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row-->

        </div>
    </div>

    <!-- Copyright -->
    <div class="footer-copyright text-center text-black-50 py-3">© 2018 Copyright:
        <a class="dark-grey-text" href="https://mdbootstrap.com/bootstrap-tutorial/"> MDBootstrap.com</a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
</template>

-->
