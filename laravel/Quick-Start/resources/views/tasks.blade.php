@extends('layouts.app')

@section('content')

<!-- Bootstrap Boilerplate... -->

<div class="container">
  <!-- Display Validation Errors -->
  @include('common.errors')

  @if (isset($task))
    <!-- Update Task Form -->
    <div class="card mb-5">
      <div class="card-header">Update Task</div>
      <div class="col-md-8 mx-auto my-2">
        <form action="{{ route('task#update', [$task->id]) }}" method="POST">
          {{ csrf_field() }}
          @method('PATCH')

          <!-- Task Name -->
          <div class="mb-3">
            <label for="task" class="form-label">Task</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $task->name) }}">
          </div>

          <!-- Update Task Button -->
          <button type="submit" class="btn btn-light">
            <i class="fa fa-plus"></i> Update Task
          </button>
        </form>
      </div>
    </div><!-- /.card -->
  @else
    <!-- New Task Form -->
    <div class="card mb-5">
      <div class="card-header">New Task</div>
      <div class="col-md-8 mx-auto my-2">
        <form action="/task" method="POST">
          {{ csrf_field() }}

          <!-- Task Name -->
          <div class="mb-3">
            <label for="task" class="form-label">Task</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
          </div>

          <!-- Add Task Button -->
          <button type="submit" class="btn btn-light">
            <i class="fa fa-plus"></i> Add Task
          </button>
        </form>
      </div>
    </div><!-- /.card -->
  @endif
  <!-- Current Tasks -->
  @if (count($tasks) > 0)
    <div class="card">
      <div class="card-header">
        Current Tasks
      </div>

      <div class="card-body">
        <table class="table table-striped">

          <!-- Table Headings -->
          <thead>
            <th>Task</th>
            <th>&nbsp;</th>
          </thead>

          <!-- Table Body -->
          <tbody>
            @foreach ($tasks as $task)
            <tr>
              <!-- Task Name -->
              <td>
                {{ $task->name }}
              </td>

              <!-- Delete Button -->
              <td>
                <form action="/task/{{ $task->id }}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}

                  <a href="{{ route('task#edit', [$task->id]) }}" class="btn btn-warning btn-sm">Edit Task</a>
                  <button class="btn btn-danger btn-sm">Delete Task</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div><!-- /.card -->
  @endif

</div><!-- /.container -->

@endsection