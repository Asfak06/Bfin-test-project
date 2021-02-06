
<x-app-layout>
    


@section('content')

<div class="card alert-secondary">
    <div class="card-header">
        <div class="float-left">
         <img src="{{ asset($d->user->image) }}" alt="" width="40px" height="40px">
        <span>{{ $d->user->name }}</span> , <b>{{ $d->created_at->diffForHumans() }},</b>
@if(!$d->listed)
<span class="mt-3 text-secondary"> ( This story is unlisted )</span>
@endif                  
        </div>


@if(Auth::id()==$d->user->id and !Auth::user()->blocked)
<a href="{{ route('stories.edit', $d->id) }}" class="btn btn-info btn-sm float-right mt-3">Edit</a>
@endif


@auth
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
        <hr>
        <p class="text-center">
            {!! $d->story !!}
        </p> 
        <hr> 

        <div class="text-center">
          <img class="rounded mx-auto d-block" src="{{asset($d->image)}}" alt=""width="400px" height="400px">
          <p>{{$d->image_cap}}</p>                   
        </div> 

    </div>
    <div class="card-footer">
            <span>
                {{ $d->comments->count() }} Comments
            </span>
            @foreach($d->tags as $tag)
            <a href="{{ route('tag', ['id'=> $tag->id ]) }}" class="float-right badge badge-pill badge-secondary mt-1 mx-1">{{ $tag->name }}</a>
            @endforeach
    </div>
</div>
@auth
@if(!Auth::user()->blocked)
@foreach($d->comments()->paginate(3) as $comment)
  <div class="card my-5">
    <div class="card-header">
      <div class="d-flex justify-content-between">
        <div class="float-left">
          <img width="40px" height="40px" style="border-radius: 50%" src="{{ asset($comment->owner->image) }}" alt="">
          <span>{{ $comment->owner->name }}</span>, <b>{{ $comment->created_at->diffForHumans() }},</b> 
        </div>

        <div>
          @auth
            @if(auth()->user()->id === $comment->user_id )
              <a href="{{ route('comments.edit', ['story'=>$d->id,'comment'=> $comment->id ]) }}" class="btn btn-sm btn-info float-right mx-1 mt-3">edit</a>            
            @endif

            @if(auth()->user()->id === $comment->user_id or auth()->user()->admin)
                <form class="float-right" action="{{ route('comments.destroy', ['story'=>$d->id,'comment'=> $comment->id ]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-sm btn-danger  mx-1 mt-3" type="submit">delete</button>
                </form>             
            @endif
          @endauth
        </div>
      </div>
    </div>

    <div class="card-body">
      {!! $comment->content !!}
    </div>
  </div>
@endforeach

{{ $d->comments()->paginate(3)->links() }}

<div class="card my-5">
  <div class="card-header">
    Add a comment
  </div>
  @include('partials.errors')
  <div class="card-body">
      <form action="{{ route('comments.store', $d->id) }}" method="POST">
        @csrf
        <input class="form-control" type="text" name="content" id="content">
        <button type="submit" class="btn btn-sm my-2 btn-success">
          Add comment
        </button>
      </form>
@else
 <h2 class="mt-2 text-center">You were blocked from reading and writing commment</h2>
@endif
@else
  <a href="{{ route('login') }}" class="btn btn-info my-2">Sign in to add comment and read</a>
@endauth
  </div>
</div>


@endsection
</x-app-layout>