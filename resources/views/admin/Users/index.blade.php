@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')

    <section>
        <div class="container">
            <h1>Users</h1>
            <h3><a href="{{ route('admin.users.create') }}">Create a user</a></h3>

            <table class="table ">
                <thead class="thead-dark">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>verified at</th>
                    <th>Action</th>

                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><a href="{{route('admin.users.show',$user->id)}}">{{ $user->name }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->email_verified_at ?? 'Not verified' }}</td>
                            <td><a class="btn btn-primary" href="{{ route('admin.users.edit', $user) }}"> edit</a> |    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{ $user->id }}">Delete</button></td>

                            <div class="modal fade" id="Modal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      Do you want to delete this item
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <form action="{{ route('admin.users.destroy',$user) }}" method="POST">@csrf @method('Delete')<input type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" value="delete"></form>
                                    </div>
                                  </div>
                                </div>
                        </tr>

                    @endforeach
                    {{ $users->links() }}
                </tbody>
            </table>
        </div>
    </section>
@endsection
