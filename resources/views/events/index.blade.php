@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <div>
              <h3>Events</h3> 
            </div>
            <div>
              <a href="{{ route('events.create') }}" class="btn btn-success">Create</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="serial-column">#</th>
                <th>Project title</th>
                <th>Cost</th>
                <th>Project type</th>
                <th>Company</th>
                <th>Date</th>
                <th>Time shift</th>
                <th>Duty holder</th>
                <th class="actions-column">Actions</th>
              </tr>
            </thead>
            <tbody>
              @if(count($events) > 0)
              @foreach($events as $event)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $event->project_title }}</td>
                <td>{{ $event->cost }}</td>
                <td>{{ $event->project_type }}</td>
                <td>{{ $event->company->name }}</td>
                <td>{{ $event->date->format('D j, M Y') }}</td>
                <td>{{ $event->timeShift->title }}</td>
                <td>{{ $event->duty_holder_full_name }}</td>
                <td>
                  <a href="{{ route('events.edit', $event->id) }}" class="btn btn-primary btn-sm">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                  </a>
                  <a onclick="submitForm({{ $event->id }})" class="btn btn-danger btn-sm">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                    </svg>
                  </a>
                  <form action="{{ route('events.destroy', $event->id) }}" method="POST" id="event{{ $event->id }}">
                    @csrf
                    @method('delete')
                  </form>
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="9">No data to display</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

<script>
  function submitForm(id) {
    let formID = 'event' + id;
    document.getElementById(formID).submit();
  }

</script>
