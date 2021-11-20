@extends('layouts.app')

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
                        <table class="table table-responsive w-100">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Picture</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Date of birth</th>
                                    <th>Interest</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{$user->name??''}}</td>
                                        <td>
                                            <img src="{{asset($user->profile_picture)}}" alt="" width="100px" height="100px">
                                        </td>
                                        <td>{{$user->email??''}}</td>
                                        <td>{{$user->gender??''}}</td>
                                        <td>{{\Carbon\Carbon::parse($user->date_of_birth)->format('d/m/Y')??''}}</td>
                                        <td>
                                            <a href="{{route('submitInterest',[$user->id,1])}}" class="btn btn-sm btn-success">Like </a>
                                            <a href="{{route('submitInterest',[$user->id,0])}}" class="btn btn-sm btn-danger">Dislike </a>
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


@endsection
