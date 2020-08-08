@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <ul class="nav nav-pills">
            @foreach($companies as $company)
              @if($loop->index == 0)
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="pill" href="#{{ $company['name'] }}">{{ $company['name'] }}</a>
                </li>
              @else
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#{{ $company['name'] }}">{{ $company['name'] }}</a>
              </li>
              @endif
            @endforeach
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mt-3">
          @foreach($companies as $company)
            @if($loop->index == 0)
              <div class="tab-pane active" id="{{ $company['name'] }}">
                @include('calendar_table', [
                  'events' => $events,
                  'dates' => $dates,
                  'timeShifts' => $timeShifts,
                  'companyIndex' => $loop->index
                ])
              </div>
            @else
              <div class="tab-pane fade" id="{{ $company['name'] }}">
                @include('calendar_table', [
                  'events' => $events,
                  'dates' => $dates,
                  'timeShifts' => $timeShifts,
                  'companyIndex' => $loop->index
                ])
              </div>
            @endif
          @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
