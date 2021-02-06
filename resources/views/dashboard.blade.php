<x-app-layout>
@section('content')
        <div class="card alert-secondary">
            <div class="card-header">
                <div class="float-left">
                 <img src="{{ asset(Auth::user()->image) }}" alt="" width="40px" height="40px">
                <span>{{ Auth::user()->name }}</span> ,                 
                </div>

                <a href="{{ route('profile.edit') }}" class="btn btn-info btn-sm float-right mt-3">update</a>
            </div>

            <div class="card-body">
                <ul class="list-group">

                    <li class="list-item">
                    Phone : {{ Auth::user()->phone }}
                    </li>
                
                <hr>
               
                    <li class="list-item">
                    Date of birth : {{ Auth::user()->birthday }}
                    </li> 
               
                <hr> 
               
                    <li class="list-item">
                  Gender : {{ Auth::user()->gender }}
                    </li> 
                
                <hr> 
                
                  <li class="list-item">
                    {{ Auth::user()->email }}
                   </li> 
                
                <hr> 
               
                   <li>
                    Password : Hidden
                   </li> 

                <hr>

                   <li>
                    Status : 
                    @if(Auth::user()->blocked)
                      Blocked
                    @else
                      Active
                    @endif
                   </li> 

                <hr>
                    <li>
                   Story count : {{ Auth::user()->stories->count() }} , 
                   <a href="{{ route('story.me') }}" class="btn btn-sm btn-info" style="text-decoration: none;">Show my stories</a>
                   </li> 

                <hr>

                </ul>
                
                @if(!empty(Auth::user()->image))
                <div class="text-center">
                  <img class="rounded mx-auto d-block" src="{{asset(Auth::user()->image)}}" alt=""width="400px" height="400px">                   
                </div>
                @else
                 <p class="text-center">No image , please update profile</p>
                @endif  

            </div>
            <div class="card-footer">

            </div>
        </div>
@endsection
</x-app-layout>
