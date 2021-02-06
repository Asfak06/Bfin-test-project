<x-app-layout>
@section('content')
<div class="card card-default">
  <div class="card-header">
    {{ isset($section)  ? 'Edit Section' : 'Create section' }}
  </div>
  <div class="card-body">
    @include('partials.errors')
    <form action="{{ isset($section) ? route('sections.update', $section->id) : route('sections.store') }}" method="POST">
      @csrf
      @if(isset($section))
        @method('PUT')
      @endif
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" class="form-control" name="name" value="{{ isset($section) ? $section->name : '' }}">
      </div>
      <div class="form-group">
        <button class="btn btn-success mt-2">
          {{ isset($section) ? 'Update Section': 'Add Section' }}
        </button>
      </div>
    </form>
  </div>
</div>
@endsection	
</x-app-layout>