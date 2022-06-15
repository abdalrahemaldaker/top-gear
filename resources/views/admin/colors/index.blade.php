@extends('layouts.app')

@section('title', 'Colors')

@section('content')

    <section>
        <div class="container">
            <h1>Colors</h1>
            <h3><a href="{{ route('admin.colors.create') }}">Create a color</a></h3>

            <table class="table ">
                <thead class="thead-dark">
                    <th>Id</th>
                    <th>Name</th>

                    <th>Action</th>

                </thead>
                <tbody>
                    @foreach ($colors as $color)
                        <tr>
                            <td>{{ $color->id }}</td>
                            <td><a href="{{route('admin.colors.edit',$color->id)}}">{{ $color->name . '('.count($color->cars).')' }}</a></td>

                            <td><a href="{{ route('admin.colors.edit', $color) }}"> edit</a> |  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{ $color->id }}">Delete</button></td>


                                <div class="modal fade" id="Modal{{ $color->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                          <form action="{{ route('admin.colors.destroy',$color) }}" method="POST">@csrf @method('Delete')<input type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" value="delete"></form>
                                        </div>
                                      </div>
                                    </div>
                        </tr>


                    @endforeach
                    {{ $colors->links() }}
                </tbody>
            </table>
        </div>
    </section>
@endsection
