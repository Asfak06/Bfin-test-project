<x-app-layout>

@section('content')
<div class="d-flex justify-content-end mb-2">
  <a href="{{ route('sections.create') }}" class="btn btn-success">Add Section</a>
</div>

<div class="card card-default">
  <div class="card-header">sections</div>
  <div class="card-body">
    @if($sections->count() > 0)
    <table class="table">
      <thead>
        <th>Name</th>
        <th>Story Count</th>
      </thead>

      <tbody>
        @foreach($sections as $section)
          <tr>
            <td>
              {{ $section->name }}
            </td>
            <td>
              {{ $section->stories->count() }}
            </td>
            <td>
              <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-info btn-sm">
                Edit
              </a>
              <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $section->id }})">Delete</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form action="" method="POST" id="deleteSectionForm">
            @csrf
            @method('DELETE')
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete section</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="text-center text-bold">
                  Are you sure you want to delete this section ?
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
              </div>
            </div>
        </form>
      </div>
    </div>
    @else
    <h3 class="text-center">No sections yet.</h3>
    @endif
  </div>
</div>
@endsection

@section('scripts')
  <script>
    function handleDelete(id) {
      var form = document.getElementById('deleteSectionForm');
      form.action = '/sections/' + id;
      $('#deleteModal').modal('show');
    }
  </script>
@endsection
</x-app-layout>