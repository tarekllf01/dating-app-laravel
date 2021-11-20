@extends('layouts.app')
@section('header-script')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

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
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function (){
        const lat = {{$user->latitude}};
        const long = {{$user->longitude}};
      
        var myLatlng = new google.maps.LatLng(lat,long);
        var myOptions = {
            zoom: 4,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
            }
        map = new google.maps.Map($('#map'), myOptions);
        var marker = new google.maps.Marker({
            position: myLatlng, 
            map: map,
        title:"{{$user->name}}"
        });
    });
</script>

@endsection
