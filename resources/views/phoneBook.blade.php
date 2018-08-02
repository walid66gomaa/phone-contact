<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    {{--
    <linkrel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous"> --}} {{--
        <linkrel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        --}}
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <link rel="stylesheet" href="css/mystyle.css">
</head>

<body>
   


   
    

     
    <div class="app" id="app">





    


     


        <myheader>

                <template slot="userstate">
                    
                    <ul class="navbar-nav ml-auto">
                 
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
    
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                   
                </template>

               

        </myheader>

        @section('content')

        <router-view>


           




            <template slot="search">
                <input v-model="searchquiry" type="text" class="form-control" placeholder="Search for...">
            </template>
            <template slot="load">
                <span v-if="loading" class="float-right">
                    <i class="fa fa-refresh fa-spin" style="font-size:24px"></i>
                </span>
            </template>
            <template slot="sec">


                <ul class="list-group" v-for="(item, key) in temp">

                    <li class="list-group-item d-flex justify-content-between align-items-center col-lg-12">



                        @{{ item.name }} {{-- listupdate --}}

                        <div class="float-right">
                            <button class="btn btn-primary">
                                <a data-toggle="modal" data-target="#viewdetails" @click="showdata(key)">view </a>
                            </button>
                            <button class="btn btn-dark">
                                <a data-toggle="modal" data-target="#listupdate" @click="showdata(key)">Edit </a>
                            </button>
                            <button class="btn btn-success" @click="del(key,item.id)"> delete</button>
                        </div>

                    </li>



                </ul>


    </div>

    </template>



    </router-view>

    <myfooter></myfooter>

    <div class="modal fade " role="dialog" id="additem">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h1 class="modal-title text-primary">Add New </h1>
                    <span v-if="lastadd !=''"> @{{ lastadd }} saved successfuly</span>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="form-group" method="post" enctype="multipart/form-data" action="/phoneBook">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Full Name</label>
                            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" v-model="list.name">

                            <span v-if="errors.name" class="text-danger">@{{ errors.name[0] }}</span>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Phone number</label>
                            <input type="tel" class="form-control" name="phone" id="exampleFormControlInput1" placeholder="0123456789" v-model="list.phone">
                            <span v-if="errors.phone" class="text-danger">@{{ errors.phone[0] }}</span>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" v-model="list.email">
                            <span v-if="errors.email" class="text-danger">@{{ errors.email[0] }}</span>
                        </div>

                        <input type="file" name="image"@change="getimage">
                        <img :src="imageurl" width="100" height="100" srcset=""> 
                        <span v-if="errors.image" class="text-danger">@{{ errors.image[0] }}</span>




                    </form>
                    <button class="close" @click="save">Save</button>

                </div>
                <div class="modal-footer">



                    <button class="close" data-dismiss="modal">close</button>
                </div>
            </div>
        </div>



    </div>



    {{-- //////////////////////////////////////////////// --}}

    <div class="modal fade " role="dialog" id="viewdetails">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">



                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="exampleFormControlInput1">full Name</label>

                        <div class="card ">
                            <h5 class="card-header">@{{ person.name }}</h5>

                        </div>

                        <label for="exampleFormControlInput1">Phone</label>

                        <div class="card ">
                            <h5 class="card-header">@{{ person.phone }}</h5>

                        </div>


                        <label for="exampleFormControlInput1">Email</label>

                        <div class="card ">
                            <h5 class="card-header">@{{ person.email }}</h5>

                        </div>

                        <div class="card ">
                            <h5 class="card-header" v-if="person.url>' '"><img  :src="person.url " :alt="person.url" width="420" height="200"></h5>

                        </div>


                    </div>



                </div>
                <div class="modal-footer">



                    <button class="close" data-dismiss="modal">close</button>
                </div>
            </div>
        </div>



    </div>
    {{-- ////////////////////////////////////////////////////////////////// --}} {{-- modal for edit --}}



    <div class="modal fade " role="dialog" id="listupdate">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h1 class="modal-title text-primary">Update @{{ personupdate.name }}'s Details </h1>

                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="form-group" method="post" action="/phoneBook">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Full Name</label>
                            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" v-model="personupdate.name">

                            <span v-if="errors.name" class="text-danger">@{{ errors.name[0] }}</span>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Phone number</label>
                            <input type="tel" class="form-control" name="phone" id="exampleFormControlInput1" placeholder="0123456789" v-model="personupdate.phone">
                            <span v-if="errors.phone" class="text-danger">@{{ errors.phone[0] }}</span>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" v-model="personupdate.email">
                            <span v-if="errors.email" class="text-danger">@{{ errors.email[0] }}</span>
                        </div>




                    </form>
                    <button class="close" @click="saveedit">Save editing</button>

                </div>
                <div class="modal-footer">



                    <button class="close" data-dismiss="modal">close</button>
                </div>
            </div>
        </div>



    </div>

    {{-- end modal for edit --}}



    <script src="{{ asset('js/app.js') }}"></script> {{--
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script> --}} {{--
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script> --}} {{--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script> --}}
</body>

</html>