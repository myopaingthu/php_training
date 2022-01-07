@extends('api.layouts.app')

@section('title', 'Lists')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      Current Students
    </div>

    <div class="card-body">
      <table class="table table-striped">
        <thead>
          <th>Name</th>
          <th>Email</th>
          <th>Major</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Date of Birth</th>
          <th>Created at</th>
          <th>Operation</th>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div><!-- /.card -->
</div>
@endsection

@section('script')
<script src="{{ asset('js/index.js') }}"></script>
@endsection