@extends('api.layouts.app')

@section('title', 'Edit')

@section('content')
<div class="container">
  <div class="card mb-5">
    <div class="card-header">Edit Student</div>
    <div class="col-md-8 mx-auto my-2">
      <form id="edit-form" action="#" method="POST">

        <input type="hidden" id="student-id" value="{{ request()->route('id') }}">
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" id="name" class="form-control" name="name" autofocus>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" id="email" class="form-control" name="email">
        </div>
        <div class="mb-3">
          <label for="major" class="form-label">Major</label>
          <select class="form-select" name="major">
          </select>
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Phone</label>
          <input type="tel" id="phone" class="form-control" name="phone">
        </div>
        <div class="mb-3">
          <label for="address" class="form-label">Address</label>
          <textarea id="address" class="form-control" name="address"></textarea>
        </div>
        <div class="mb-3">
          <label for="dob" class="form-label">Date of Birth</label>
          <input type="date" id="dob" class="form-control" name="dob">
        </div>

        <button id="submit-post" type="submit" class="btn btn-primary">
          Edit Student
        </button>
      </form>
    </div>
  </div><!-- /.card -->
</div><!-- /.container -->
@endsection

@section('script')
<script src="{{ asset('js/edit.js') }}"></script>
@endsection