<x-app-layout>
@section('content')

<div class="card card-default">
  @include('partials.errors')
  <div class="card-header">
    Add new admin
  </div>

  <div class="card-body">
    <form action="{{ route('admin.create') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id='name'>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" id='email' >
      </div>

      <div class="form-group">
        <label for="password">New password </label>
        <input type="password" class="form-control" name="password" id='password'  autocomplete="new-password">
      </div>

      <div class="form-group">
        <label for="password_confirmation">New password confirmation </label>
        <input type="password" class="form-control" name="password_confirmation" id='password_confirmation'>
      </div>


      <div class="form-group">
        <button type="submit" class="btn btn-success">
          Create admin user
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
	
</x-app-layout>