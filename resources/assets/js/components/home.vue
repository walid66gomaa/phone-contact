<template>
<div class="container">

    <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
            <div class="input-group">
                <slot name="search"></slot>
                
                <!-- <span class="input-group-btn">
                  <button class="btn btn-secondary" type="button">Go!</button>
                </span> -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 col-lg-offset-4">

            <a data-toggle="modal" data-target="#additem" class="btn btn-primary"> Add New </a>

            <slot name="load"></slot>
            
            

            <slot name="sec"></slot>

        </div>

    </div>
</div>
</template>
