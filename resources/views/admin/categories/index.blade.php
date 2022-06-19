@extends('layouts.app')

@section('title', 'Categories')

@section('content')

    <section>
        <div class="container">
            <h1>Categories</h1>
            <h3><a href="{{ route('admin.categories.create') }}">Create a category</a></h3>

            <table class="table ">
                <thead class="thead-dark">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Name Arabic</th>
                    <th>Capacity</th>
                    <th>Action</th>

                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td><a href="{{route('admin.categories.show',$category->id)}}">{{ $category->name . '('.count($category->cars).')' }}</a></td>
                            <td>{{ $category->capacity }}</td>
                            <td><a href="{{ route('admin.categories.edit', $category) }}"> edit</a> |    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{ $category->id }}">Delete</button></td>

                            <div class="modal fade" id="Modal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                      <form action="{{ route('admin.categories.destroy',$category) }}" method="POST">@csrf @method('Delete')<input type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" value="delete"></form>
                                    </div>
                                  </div>
                                </div>
                        </tr>

                    @endforeach
                    {{ $categories->links() }}
                </tbody>
            </table>
        </div>
    </section>
@endsection
