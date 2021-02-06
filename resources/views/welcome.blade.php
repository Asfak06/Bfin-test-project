<x-app-layout>
@section('content')

     <div class="row">
            <div class="col-md-4">
                <a href="{{ route('stories.create') }}" class="form-control btn btn-primary">Create a new story</a>
                <br>
                <br>
                <div class="card card-default">
                    <div class="card-body">
                        <ul class="list-group">
                         @if(Auth::check()) 
                            <li class="list-group-item">
                                <a href="{{ route('story.me') }}" style="text-decoration: none;">My stories</a>
                            </li>     
     
                         @if(Auth::user()->admin) 
                            <li class="list-group-item">
                                <a href="{{ route('story.unlisted') }}" style="text-decoration: none;">unlisted stories</a>
                            </li>     
                            <li class="list-group-item">
                                <a href="{{ route('stories') }}" style="text-decoration: none;">listed stories</a>
                            </li> 
                         @endif  
                         @endif                                         
                        </ul>
                    </div>
                </div>
                <div class="card card-default mt-2">
                    <div class="card-header">
                      <strong>Filter by sections :</strong>  
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($sections as $section)
                                <li class="list-group-item">
                                    <a href="{{ route('section', ['id' => $section->id ]) }}" style="text-decoration: none;">{{ $section->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card card-default mt-2">
                    <div class="card-header">
                      <strong>Filter by tags :</strong>  
                    </div>

                    <div class="card-body">

            @foreach($tags as $tag)
            <a href="{{ route('tag', ['id'=> $tag->id ]) }}" class="float-left badge badge-pill badge-secondary mt-1 mx-1">{{ $tag->name }}</a>
            @endforeach
   
                    </div>
                </div>
                <div class="card card-default mt-2">
                    <div class="card-body">
                    <form action="{{ route('search') }}" method="get">
                        {{ csrf_field() }}
                        <div class="form-group">
                         <label for="content" class="font-bold">Search keyword :</label>
                         <input name="content" id="content" class="form-control">
                        </div>
                    </form>
                    </div>
                </div>
            </div>

  <div class="col-md-8">

    @if($stories->count()>0)
    @foreach($stories as $d)

    <div class="card  mb-2 ">
        <div class="card-header alert-secondary">
            <div class="float-left">
            <img  src="{{ asset($d->user->image) }}" alt="" width="40px" height="40px">
            <span>{{ $d->user->name }}, <b>{{ $d->created_at->diffForHumans() }},</b></span>  
      @if(!$d->listed)
            <span class="mt-3 text-secondary"> ( This story is unlisted )</span>
      @endif                      
            </div>
            <a href="{{ route('stories.show', ['story' => $d->id ]) }}" class="btn btn-sm btn-primary float-right mt-3 mx-1">view</a>
      @auth

      @if(Auth::id()==$d->user->id and !Auth::user()->blocked)
            <a href="{{ route('stories.edit', $d->id) }}" class="btn btn-info btn-sm float-right mt-3 mx-1">Edit</a>
      @endif
      @if(auth()->user()->id === $d->user_id or auth()->user()->admin)
      @if(!Auth::user()->blocked)
           <form class="float-right" action="{{ route('stories.destroy', $d->id ) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button class="btn btn-sm btn-danger  mx-1 mt-3" type="submit">delete</button>
           </form>             
      @endif
      @endif


      @if(auth()->user()->admin)
      @if($d->listed)
               <a href="{{ route('story.unlist', $d->id) }}" class="btn btn-info btn-sm float-right mt-3">Unlist</a>
      @else
               <a href="{{ route('story.restore', $d->id) }}" class="btn btn-info btn-sm float-right mt-3">Restore</a>
      @endif
      @endif

      @endauth

        </div>

        <div class="card-body">
               <h4 class="text-center">
                 <b>{{ $d->title }}</b>
               </h4>
               <p class="text-center">
                {!! str_limit($d->story, 100) !!}
               </p>
        </div>

        <div class="card-footer ">
                <span>
                 {{ $d->comments->count() }} Comments
                </span>
                @foreach($d->tags as $tag)
                <a href="{{ route('tag', ['id'=> $tag->id ]) }}" class="float-right badge badge-pill badge-secondary mt-1 mx-1">{{ $tag->name }}</a>
                @endforeach
        </div>
    </div>
    
    @endforeach
    <div class="text-center">
        {{ $stories->links() }}
    </div>
    @else 
    <div class="card-body">
        <h4 class="text-center">
            <b>Nothing yet</b>
        </h4>
    </div>         
    @endif
              
  </div>
 </div>

@endsection 
</x-app-layout>
