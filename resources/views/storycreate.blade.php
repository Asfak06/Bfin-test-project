<x-app-layout>
@section('content')

<div class="card card-default">
  @include('partials.errors')
  <div class="card-header">
    {{ isset($story) ? 'Edit story': 'Create story' }}
  </div>

  <div class="card-body">
    <form action="{{ isset($story) ? route('stories.update', $story->id) : route('stories.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      @if(isset($story))
        @method('PUT')
      @endif

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id='title' value="{{ isset($story) ? $story->title: '' }}">
      </div>

      <div class="form-group">
        <label for="content">Story</label>
      <input id="content" type="hidden" name="content" value="{{ isset($story) ? $story->story : '' }}">
        <trix-editor input="content"></trix-editor>
      </div>

      <div class="form-group">
        <label for="description">Image Caption</label>
        <textarea name="description" id="description" cols="5" rows="1" class="form-control">{{ isset($story) ? $story->image_cap : '' }}</textarea>
      </div>

      @if(isset($story))
        <div class="form-group">
          <img src="{{ asset($story->image) }}" alt="" style="width: 100%">
        </div>
      @endif
      <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control" name="image" id='image'>
      </div>

      <div class="form-group">
        <label for="section">Section</label>
        <select name="section" id="section" class="form-control">
          @foreach($sections as $section)
            <option value="{{ $section->id }}"
                @if(isset($story))
                  @if($section->id === $story->section_id)
                    selected
                  @endif
                @endif
              >
              {{ $section->name }}
            </option>
          @endforeach
        </select>
      </div>

      @if($tags->count() > 0)
        <div class="form-group">
          <label for="tags">Tags</label>
              
            <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
              @foreach($tags as $tag)
              <option value="{{ $tag->id }}"
                  @if(isset($story))
                    @if($story->hasTag($tag->id))
                      selected
                    @endif
                  @endif
                >
                  {{ $tag->name }}
                </option>
                @endforeach
            </select>
          </div>
        @endif

      <div class="form-group">
        <button type="submit" class="btn btn-success">
          {{ isset($story) ? 'Update story': 'Create story' }}
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.tags-selector').select2();
    })
  </script>
@endsection

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
	
</x-app-layout>