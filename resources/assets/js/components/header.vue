
<template >
<div class="container">
<nav class="navbar navbar-expand-lg  navbar-dark bg-dark" style="background-color: #e3f2fd;">
  <!-- <a class="navbar-brand" href="#">my Contact</a> -->
   <router-link  class="navbar-brand" to="/myhome">My contact</router-link>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
           
    
       
         <router-link class="nav-link" to="/myhome">Home</router-link>
      </li>
      <li class="nav-item">
         <router-link class="nav-link" to="/myabout">About</router-link>
      </li>
    
     
    </ul>

    <slot name="userstate"></slot>
   
  </div>
</nav>
</div>
    
</template>
