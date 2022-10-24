@extends('layouts.dashboard')

@section('title','Edit')


@push('style')

@endpush

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Edit Product</h4>

                        <form class="forms-sample" action="{{route('dashboard.products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <x-alert></x-alert>

                            <div class="form-group">
                                <x-form.input label="Product Name" name="name"  placeholder="Product Name" value="{{$product->name}}" />
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Category </label>
                                <select class="form-control  @error('category') is-invalid @enderror" name="category" id="exampleSelectGender">
                                    <option value="">Primary Category</option>
                                    @foreach (App\Models\Category::all() as $category)
                                        <option value="{{$category->id }}" @selected(old('category_id',$product->category_id) == $category->id)>{{$category->name }}</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <x-form.textarea label="Description" name="description" value="{{$product->description}}" />
                            </div>
                            <div class="form-group">

                                <x-form.label id="image">Image</x-form.label>
                                <x-form.input type="file" name="image" accept="image/*" />
                                <br>
                                @if ($product->image)
                                    <img src="{{asset('storage/'.$product->image)}}" height="100" width="200" >
                                @endif
                            </div>
                            <div class="form-group">
                                <x-form.input label="Price" name="price" :value="$product->price" />
                            </div>
                            <div class="form-group">
                                <x-form.input label="Compare Price" name="compare_price" :value="$product->compare_price" />
                            </div>
                            <div class="form-group">
                                <x-form.input label="Tags" name="tags" :value="$tags" />
                            </div>
                            <div class="form-group">
                                <x-form.label id="status">Status</x-form.label>
                                <x-form.radio name="status" checked="{{$product->status}}" :options="['active' => 'Active', 'draft' => 'Draft', 'archived' => 'Archived']" />
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Update</button>
                        </form>
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
