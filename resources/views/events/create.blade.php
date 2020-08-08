@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h3>Create Event</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('events.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="project_title">Project title</label>
              <input type="text" id="project_title" class="form-control" name="project_title" value="{{ old('project_title') }}">
            </div>
            <div class="form-group">
              <label for="cost">Cost</label>
              <input type="text" id="cost" class="form-control" name="cost" value="{{ old('cost') }}">
            </div>
            <div class="form-group">
              <label for="project_type">Project type</label>
              <input type="text" id="project_type" class="form-control" name="project_type" value="{{ old('project_type') }}">
            </div>
            <div class="form-group">
              <label for="company">Company</label>
              <select class="custom-select" name="company_id" id="company">
                <option selected disabled>Select company</option>
                @foreach($companies as $company)
                @if(old('company_id') == $company->id)
                <option value="{{ $company->id }}" selected>{{ $company->name }}</option>
                @else
                <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="date">Date</label>
              <input class="form-control" type="date" id="date" name="date" value="{{ old('company_id') }}">
            </div>
            <div class="form-group">
              <label for="time_shift">Time shift</label>
              <select class="custom-select" name="time_shift_id" id="time_shift" value="{{ old('company_id') }}">
                <option selected disabled>Select time shift</option>
                @foreach($timeShifts as $timeShift)
                @if(old('time_shift_id') == $timeShift->id)
                <option value="{{ $timeShift->id }}" selected>{{ $timeShift->title }}</option>
                @else
                <option value="{{ $timeShift->id }}">{{ $timeShift->title }}</option>
                @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="duty_holder_full_name">Duty holder</label>
              <input type="text" id="duty_holder_full_name" class="form-control" name="duty_holder_full_name" value="{{ old('duty_holder_full_name') }}">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
