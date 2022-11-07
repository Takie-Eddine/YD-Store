@extends('layouts.dashboard')

@section('title','Products')


@push('style')

@endpush

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Products</h4>
                            <br>
                            <div  class="table-responsive">
                                <div class="mb-5">
                                    <a href="{{route('dashboard.products.create')}}" class="btn btn-sm btn-primary btn-rounded btn-fw mr-2">Create</a>
                                    <a href="" class="btn btn-sm btn-dark btn-rounded btn-fw">Trash</a>
                                </div>

                                <form action="{{URL::current()}}" method="GET" class="d-flex justify-content-between mb-4">
                                    <x-form.input name="name" placeholder="Name" class="mx-2" value="{{request('name')}}" />
                                    <select name="status" class="form-control mx-2">
                                        <option value="">All</option>
                                        <option value="active" @selected(request('status') == 'active')>Active</option>
                                        <option value="archived" @selected(request('status') == 'archived')>Archived</option>
                                    </select>
                                    <button class="btn btn-sm btn-dark mx-2">Filter</button>
                                </form>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Store</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @forelse ($products as $product)
                                                <tr>
                                                    <td><img src="{{$product->image_url}}" height="100" width="100" ></td>
                                                    <td>{{$product->id}}</td>
                                                    <td >{{$product->name}}</td>
                                                    <td>{{$product->category->name}}</td>
                                                    <td>{{$product->store->name}}</td>
                                                    <td>{{$product->status}}</td>
                                                    <td>{{$product->created_at}}</td>
                                                    <td>
                                                        <a href="{{route('dashboard.products.edit',$product->id)}}" class="btn btn-sm btn-secondary btn-rounded btn-fw">Edit</a>
                                                        <form action="{{route('dashboard.products.destroy',$product->id)}}" method="POST">
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
                                <div>
                                    {{$products->withQueryString()->links()}}
                                </div>
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


