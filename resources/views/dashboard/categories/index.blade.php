@extends('layouts.dashboard')

@section('title','Categories')


@push('style')

@endpush

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Categories</h4>
                            <br>
                            <div  class="table-responsive">
                                <div class="mb-5">
                                    <a href="{{route('dashboard.categories.create')}}" class="btn btn-sm btn-primary btn-rounded btn-fw">Create</a>
                                </div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Parent</th>
                                            <th>Created At</th>
                                            <th colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @forelse ($categories as $category)
                                                <tr>
                                                    <td><img src="{{asset('storage/'.$category->image)}}" height="100" width="100" ></td>
                                                    <td>{{$category->id}}</td>
                                                    <td >{{$category->name}}</td>
                                                    <td>{{$category->parent_id ?? '__'}}</td>
                                                    <td>{{$category->created_at}}</td>
                                                    <td>
                                                        <a href="{{route('dashboard.categories.edit',$category->id)}}" class="btn btn-sm btn-secondary btn-rounded btn-fw">Edit</a>
                                                        <form action="{{route('dashboard.categories.destroy',$category->id)}}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-sm btn-danger btn-rounded btn-fw">Delete</button>
                                                        </form>
                                                    </td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">No categories defined.</td>
                                                </tr>
                                            @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>

@endsection



@push('script')

@endpush


