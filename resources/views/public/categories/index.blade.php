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
                    <th>Capacity</th>
                    <th>Action</th>

                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td><a href="{{route('categories.show',$category->id)}}">{{ $category->name . '('.count($category->cars).')' }}</a></td>
                            <td>{{ $category->capacity }}</td>
                            <td><a href="{{ route('admin.categories.edit', $category) }}"> edit</a> |    <form action="{{ route('admin.categories.destroy',$category) }}" method="POST">@csrf @method('Delete')<input type="submit" value="delete"></form></td>

                        </tr>
                    @endforeach
                    {{ $categories->links() }}
                </tbody>
            </table>
        </div>
    </section>
@endsection
