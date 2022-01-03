@extends('layouts.app')

@section('title', 'Create')

@section('content')
<div class="container">
  <div class="card mb-5">
    <div class="card-header">New Student</div>
    <div class="col-md-8 mx-auto my-2">
      <form action="{{ route('students.store') }}" method="POST">
        {{ csrf_field() }}

        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
        </div>
        <div class="mb-3">
          <label for="major" class="form-label">Major</label>
          <select class="form-select @error('major') is-invalid @enderror" name="major">
            @foreach ($majors as $major)
            @if (old('major') == $major->id)
            <option value="{{ $major->id }}" selected>{{ $major->name }}</option>
            @else
            <option value="{{$major->id}}">{{ $major->name }}</option>
            @endif
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Phone</label>
          <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
        </div>
        <div class="mb-3">
          <label for="address" class="form-label">Address</label>
          <textarea class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address') }}</textarea>
        </div>
        <div class="mb-3">
          <label for="dob" class="form-label">Date of Birth</label>
          <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}">
        </div>

        <button type="submit" class="btn btn-primary">
          Add Student
        </button>
      </form>
    </div>
  </div><!-- /.card -->
</div><!-- /.container -->
@endsection