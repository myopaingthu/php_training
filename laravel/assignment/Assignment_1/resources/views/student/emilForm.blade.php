@extends('layouts.app')

@section('title', 'Email Form')

@section('content')
<div class="container">
  <div class="card mb-5">
    <div class="card-header">Send Email</div>
    <div class="col-md-8 mx-auto my-2">
      <form action="{{ route('postEailFormSubmit') }}" method="POST">
        {{ csrf_field() }}

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
        </div>

        <button type="submit" class="btn btn-primary">
          Send Email
        </button>
      </form>
    </div>
  </div><!-- /.card -->
</div><!-- /.container -->
@endsection