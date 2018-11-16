@extends('layouts.admin')


@section('content')
  <h1>Users</h1>


  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Created</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>
      @if ($users)
        @foreach ($users as $user)
          <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td>{{$user->is_active == 1 ? 'Active':'Not Active'}}</td>
            <td>{{$user->created_at->timezone('Asia/Manila')->format('m/d/Y H:i')}}</td>
            <td>{{$user->updated_at->timezone('Asia/Manila')->format('m/d/Y H:i')}}</td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>
@endsection
