@extends('layouts.app')

@section('title', 'Upload')

@section('content')
<div class="container">
  <div class="card mb-5">
    <div class="card-header">Upload Student</div>
    <div class="col-md-8 mx-auto my-2">
      <form action="{{ route('students.upload') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="mb-3">
          <label for="file" class="form-label">Input your csv</label>
          <input type="file" class="form-control @error('file') is-invalid @enderror" name="file">
        </div>
        <button type="submit" class="btn btn-primary">
          Upload
        </button>
      </form>
    </div>
  </div><!-- /.card -->
</div><!-- /.container -->
@endsection