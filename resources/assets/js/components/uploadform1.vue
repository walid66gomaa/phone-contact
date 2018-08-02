<template >

    <div class="container col-lg-4 col-lg-offset-4">
 
        <div class="row ">

            <input type="file" name="image" @change="getimage">
            <img src="" width="100" height="100" srcset=""> 
            <button  @click.prevent="upload" value="uplaoad" class="btn btn-success">upload123</button>


        </div>
     </div>
</template>

