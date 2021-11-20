@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nearest Friends with in distanct <b>{{$minDistance}} KM, Gender : {{$gender?$gender:'ALL'}} </b></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('message'))
                        <div class="alert alert-{{session('alertType')}}" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif


                    <div class="container">

                        <form action="{{route('nearestFriends')}}" method="get">
                            <input id="lat" type="hidden" name="lat"  value="{{$request['lat']??''}}" required>
                            <input id="long" type="hidden" name="long"  value="{{$request['long']??''}}" required>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Min distance</label>
                                        <select class="form-control" name="distance">
                                            <option {{$minDistance==1?'selected':''}} value="1">1</option>
                                            <option {{$minDistance==2?'selected':''}} value="2">2</option>
                                            <option {{$minDistance==3?'selected':''}} value="3">3</option>
                                            <option {{$minDistance==5?'selected':''}} value="5">5</option>
                                            <option {{$minDistance==10?'selected':''}} value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Gender</label>
                                        <select class="form-control" name="gender">
                                            <option {{$gender==''?'selected':''}} value="">ALL</option>
                                            <option {{$gender=='male'?'selected':''}} value="male">Male</option>
                                            <option {{$gender=='female'?'selected':''}} value="female">female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success mt-4">
                                        Search
                                    </button>
                                </div>
                            </div>

                        </form>

                        <table class="table table-responsive w-100">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Picture</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Distance</th>
                                    <th style="min-width: 130px">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $baseMapUrl = "https://maps.google.com/maps?q=";
                                @endphp
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{$user->name??''}}</td>
                                        <td>
                                            <img src="{{asset($user->profile_picture)}}" alt="" width="100px" height="100px">
                                        </td>
                                        <td>{{$user->email??''}}</td>
                                        <td>{{$user->gender??''}}</td>
                                        <td>{{$user->age??0}} Years</td>
                                        <td>
                                            <span class="badge badge-info">
                                                {{round(($user->distance/0.621371)*100,2)}} KM
                                            </span>
                                        </td>
                                        <td>
                                            <a target="blank" href="{{$baseMapUrl.$user->latitude.','.$user->longitude}}" class="btn btn-sm btn-info">Google map </a>
                                            <a href="{{route('map',$user->id)}}" class="btn btn-sm btn-danger"> Location </a>
                                            <a href="{{route('chat',$user->id)}}" class="btn btn-sm btn-success">Chat</a>
                                        </td>
                                    </tr>
                                @empty
                                    No new friends exits which you may interest on
                                @endforelse
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Button trigger modal -->
<button type="button" id="exampleButton" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button>

    @if (session('matched') && session('matched') == 1)
        <!-- Modal -->
    <div class="modal fade  " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Congrats! It's a match</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
        </div>
    </div>
        <script type="text/javascript">
            $('#exampleButton').trigger('click');
        </script>
    @endif

    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition( (position) => {
                const lat = position.coords.latitude;
                const long = position.coords.longitude;
                if (document.getElementById('lat').value == "" || document.getElementById('long').value == "" ) {
                    var url = "{{route('nearestFriends')}}" + "?lat="+lat+"&long="+long;
                    window.open(url,'_self');
                }
            }, () => {
                handleLocationError();
            }
        );
        } else {
            handleLocationError();
            console.log('Not supported');
            // Browser doesn't support Geolocation
            // handleLocationError(false, infoWindow, map.getCenter());
        }

        function handleLocationError() {
            alert('Plese allow your location & reload');
        }
    </script>
@endsection
