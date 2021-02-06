<x-app-layout>
@section('content')

<div class="card card-default">
  <div class="card-header">
      <h4 class="float-left">Users</h4>
      <a href="{{ route('admin') }}" class="btn btn-info btn-sm float-right">Create new admin</a>
  </div>
  <div class="card-body">
    @if($user->count() > 0)
    <table class="table">
      <thead>
        <th>Name</th>
        <th>Story Count</th>
        <th>Contact</th>
        <th>Role</th>
        <th>Action</th>
      </thead>

      <tbody>
        @foreach($user as $user)
          <tr>
            <td>
              {{ $user->name }}
            </td>
            <td>
              {{ $user->stories->count() }}
            </td>
            <td>
              {{ $user->phone }}
            </td>

            <td>
              @if(!$user->admin)
                user
              @else
                admin
              @endif
            </td>

            <td>
            @if(!$user->admin)
             @if($user->blocked)
              <a href="{{ route('profile.unblock', $user->id) }}" class="btn btn-info btn-sm">
                Unblock
              </a>
             @else
              <a href="{{ route('profile.block', $user->id) }}" class="btn btn-danger btn-sm">
                Block
              </a>
             @endif
            @else
             @if($user->id !== Auth::id())
              <a href="{{ route('admin.remove', $user->id) }}" class="btn btn-danger btn-sm"> Remove admin
              </a> 
             @endif            
            @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    @else
    <h3 class="text-center">No user yet.</h3>
    @endif
  </div>
</div>
@endsection

</x-app-layout>