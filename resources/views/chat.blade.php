@extends('layouts.app')
@section('header-script')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                        <section style="background-color: #eee;">
                            <div class="container py-3" >
                          
                              <div class="row d-flex justify-content-center">
                                <div class="col-md-12 col-lg-10 col-xl-8">
                          
                                  <div class="card" id="chat1" style="height:600px;border-radius: 15px;overflow: scroll">
                                    <div
                                      class="card-header d-flex justify-content-between align-items-center p-3 bg-info text-white border-bottom-0"
                                      style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                      <i class="fas fa-angle-left"></i>
                                      <p class="mb-0 fw-bold">{{$user->name??'Chat'}}</p>
                                      <i class="fas fa-times"></i>
                                    </div>
                                    <div class="card-body">
                                    
                                    @php
                                        $lastID = 0;
                                    @endphp
                                    @forelse ($chats as $chat)
                                        @php
                                            $lastID = $chat->id;
                                        @endphp
                                        <div class="d-flex flex-row {{$chat->sender_id !=Auth::id()?'justify-content-start':'justify-content-end'}} mb-4">
                                            <img width="30px" height="30px" src="{{asset($chat->sender->profile_picture)}}" alt="{{$chat->sender->name??''}}">
                                            <div class="p-3 ms-3" style="border-radius: 15px; background-color: {{$chat->sender_id!= Auth::id()?'rgba(57, 192, 237,.2)':'#fbfbfb'}};">
                                            <p class="small mb-0">{{$chat->message}}</p>
                                            </div>
                                        </div>
                                    @empty
                                        
                                    @endforelse
                                    <form action="{{route('sendMessage',$user->id)}} " method="post">
                                        @csrf
                                        <div class="form-outline">
                                            <textarea class="form-control" id="textAreaExample" name="message" rows="4"></textarea>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary m-2"> Send </button>
                                        
                                    </form>
                          
                                    </div>
                                  </div>
                          
                                </div>
                              </div>
                          
                            </div>
                          </section>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var idleTime = 0;
    $(document).ready(function () {
        // Increment the idle time counter every minute.
        var idleInterval = setInterval(timerIncrement, 5000); // 1 minute

        // Zero the idle timer on mouse movement.
        $(this).mousemove(function (e) {
            idleTime = 0;
        });
        $(this).keypress(function (e) {
            idleTime = 0;
        });
    });

    function timerIncrement() {
        idleTime = idleTime + 1;
        console.log(idleTime);
        if (idleTime > 2 ) { // 15 sec
            window.location.reload();
        }
    }
</script>

@endsection
