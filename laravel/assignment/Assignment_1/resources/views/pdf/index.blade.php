<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    .card-header {
      padding: 0.5rem 1rem;
      margin-bottom: 0;
      background-color: rgba(0, 0, 0, 0.03);
      border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }

    .table {
      width: 100%;
      margin-bottom: 1rem;
      color: #212529;
      vertical-align: top;
      border-color: #dee2e6;
      caption-side: bottom;
      border-collapse: collapse;
    }

    tr:nth-child(even) {
      background-color: rgba(0, 0, 0, 0.05);
    }
  </style>
</head>

<body>
  <h2 class="card-header">
    Current Students
  </h2>

  <table class="table table-striped">
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Major</th>
      <th>Phone</th>
      <th>Address</th>
      <th>Date of Birth</th>
      <th>Created at</th>
    </tr>
    <tbody>
      @foreach ($students as $student)
      <tr>
        <td>{{ $student->name }}</td>
        <td>{{ $student->email }}</td>
        <td>{{ $student->major->name }}</td>
        <td>{{ $student->phone }}</td>
        <td>{{ $student->address }}</td>
        <td>{{ $student->dob }}</td>
        <td>{{ \Carbon\Carbon::parse($student->created_at)->format('Y-m-d')}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>