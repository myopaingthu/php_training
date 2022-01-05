@extends('layouts.app')

@section('title', 'Lists')

@section('content')
<div class="container">
  @if (count($students) > 0)
  <div class="card">
    <div class="card-header">
      Current Students
      <a href="{{ route('students.upload') }}" class="btn btn-success float-end">Import</a>
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
          <th>Operation</th>
        </thead>
        <tbody>
          @foreach ($students as $student)
          <tr>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->major->name }}</td>
            <td>{{ $student->phone }}</td>
            <td>{{ $student->address }}</td>
            <td>{{ $student->dob }}</td>
            <td>
              <a href="{{ route('students.edit', [$student->id]) }}" class="btn btn-warning btn-sm">Edit</a>
              <button class="btn btn-danger btn-sm delete" data-id="{{ $student->id }}">Delete</button>
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