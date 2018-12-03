@extends('layouts.admin')


@section('content')
  <h1>Users</h1>

  @if (Session::has('deleted_user'))
    <p class="alert alert-danger">{{session('deleted_user')}}</p>
  @endif
  @if (Session::has('updated_user'))
    <p class="alert alert-success">{{session('updated_user')}}</p>
  @endif

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Photo</th>
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
            <td><img height="50" src="{{$user->photo ? $user->photo->file : 'https://via.placeholder.com/400'}}"></td>
            <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
            <td>{{$user->email}}</td>

            {{-- <td>{{$user->role ? $user->role->name : 'no role'}}</td> --}}

            <td>{{$user->role->name}}</td>
            <td>{{$user->is_active == 1 ? 'Active':'Not Active'}}</td>
            <td>{{$user->created_at ? $user->created_at->timezone('Asia/Manila')->format('m/d/Y H:i') : 'no date'}}</td>
            <td>{{$user->updated_at ? $user->updated_at->timezone('Asia/Manila')->format('m/d/Y H:i') : 'no date'}}</td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>

  <div class="">
    {{$users->render()}}
  </div>
@endsection
