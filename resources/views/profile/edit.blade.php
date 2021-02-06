<x-app-layout>
@section('content')

<div class="card card-default">
  @include('partials.errors')
  <div class="card-header">
    Edit profile
  </div>

  <div class="card-body">
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id='name' value="{{ Auth::user()->name }}">
      </div>

      <div class="form-group">
        <label for="birthday">Date of birth</label>
        <input type="date" class="form-control" name="birthday" id='birthday' value="{{ Auth::user()->birthday }}">
      </div>

      <div class="form-group">
        <label for="phone">Contact </label>
        <input type="text" class="form-control" name="phone" id='phone' value="{{ Auth::user()->phone }}">
      </div>

      <div class="form-group">
        <label for="email">Contact </label>
        <input type="text" class="form-control" name="email" id='email' value="{{ Auth::user()->email }}">
      </div>

      <div class="form-group">
        <label for="password">New password </label>
        <input type="password" class="form-control" name="password" id='password'  autocomplete="new-password">
      </div>

      <div class="form-group">
        <label for="password_confirmation">New password confirmation </label>
        <input type="password" class="form-control" name="password_confirmation" id='password_confirmation'>
      </div>

      <div class="mt-4">
        <span class="text-gray-700">Gender</span>
        <div class="mt-2">

          <label class="inline-flex items-center">
            @if(Auth::user()->gender == 'male')
            <input type="radio" class="form-radio" name="gender" value="male" checked   >
            @else
            <input type="radio" class="form-radio" name="gender" value="male" >
            @endif
            <span class="ml-2">Male</span>
          </label>
          <label class="inline-flex items-center ml-6">
            @if(Auth::user()->gender == 'female')
            <input type="radio" class="form-radio" name="gender" value="female" checked >
            @else
            <input type="radio" class="form-radio" name="gender" value="female" >
            @endif
            <span class="ml-2">Female</span>
          </label>
        </div>
      </div>

      <div class="form-group">
        <img src="{{ asset(Auth::user()->image) }}" alt="" style="width: 60%">
      </div>

      <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control" name="image" id='image'>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-success">
          Update Profile
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
	
</x-app-layout>