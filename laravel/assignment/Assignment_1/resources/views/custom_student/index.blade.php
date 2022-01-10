@extends('custom_student.layouts.app')

@section('title', 'Lists')

@section('content')
<div class="container">
  @if (count($students) > 0)
  <div class="card">
    <div class="card-header">
      Current Students
      <form class="row row-cols-lg-auto g-3 align-items-center search-form ms-1" action="{{ route('students#showList') }}" method="GET">
        <div class="col-12">
          <label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>
          <div class="input-group">
            <div class="input-group-text">@</div>
            <input type="text" class="form-control" name="name" id="inlineFormInputGroupUsername" placeholder="Username">
          </div>
        </div>
        <div class="col-12">
          <label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>
          <div class="input-group">
            <div class="input-group-text">S</div>
            <input type="date" class="form-control" name="start" id="inlineFormInputGroupUsername">
          </div>
        </div>
        <div class="col-12">
          <label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>
          <div class="input-group">
            <div class="input-group-text">E</div>
            <input type="date" class="form-control" name="end" id="inlineFormInputGroupUsername">
          </div>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Search</button>
        </div>
      </form>
      <a href="{{ route('students.uploadView') }}" class="btn btn-success float-end">Import</a>
      <a href="{{ route('downloadStudentCSV') }}" class="btn btn-primary float-end me-1">Export</a>
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
          @foreach ($students as $student)
          <tr>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->major }}</td>
            <td>{{ $student->phone }}</td>
            <td>{{ $student->address }}</td>
            <td>{{ $student->dob }}</td>
            <td>{{ \Carbon\Carbon::parse($student->created_at)->format('Y-m-d')}}</td>
            <td>
              <a href="{{ route('students#showEditView', [$student->id]) }}" class="btn btn-warning btn-sm">Edit</a>
              <button class="btn btn-danger btn-sm custom-delete" data-id="{{ $student->id }}">Delete</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div><!-- /.card -->
  @endif
</div>
@endsection