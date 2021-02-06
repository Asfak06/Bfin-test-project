<x-app-layout>
@section('content')
            <div class="card card-default">
                @include('partials.errors')
                <div class="card-header text-center">Edit reply</div>

                <div class="card-body">
                    <form action="{{ route('comments.update',['story'=>$story,'comment'=>$comment]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                              <label for="content">Reply to this discussion</label>
                              <textarea name="content" id="content" cols="30" rows="5" class="form-control">{{ $comment->content }}</textarea>
                        </div>
                        <div class="form-group">
                              <button class="btn btn-success pull-right" type="submit">update reply</button>
                        </div>
                    </form>
                </div>
            </div>

@endsection	
</x-app-layout>


