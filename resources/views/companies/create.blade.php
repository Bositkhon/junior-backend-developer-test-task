@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h3>Create Company</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('companies.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Name</label>
              <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
