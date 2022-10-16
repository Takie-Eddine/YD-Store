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
                        <h4 class="card-title">{{$category->name}}</h4>
                        <br>
                        <div  class="table-responsive">
                            <div class="mb-5">
                                <a href="{{route('dashboard.categories.index')}}" class="btn btn-sm btn-primary btn-rounded btn-fw">Back</a>
                            </div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Store</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @php
                                            $products = $category->products()->with('store')->paginate(5);
                                        @endphp
                                        @forelse ($products as $product)
                                            <tr>
                                                <td><img src="{{asset('storage/'.$product->image)}}" height="100" width="100" ></td>
                                                <td >{{$product->name}}</td>
                                                <td>{{$product->store->name }}</td>
                                                <td>{{$product->status}}</td>
                                                <td>{{$product->created_at}}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No categories defined.</td>
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
