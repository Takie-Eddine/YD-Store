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
                        <h4 class="card-title">Edit Category</h4>

                        <form class="forms-sample" action="{{route('dashboard.categories.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <x-alert></x-alert>

                            <div class="form-group">
                                {{-- <label for="exampleInputName1">Name</label> --}}
                                {{-- <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{$category->name}}" id="exampleInputName1" placeholder="Name">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror --}}
                                <x-form.input label="Category Name" name="name" value="{{$category->name}}" />
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Category Parent</label>
                                <select class="form-control  @error('parent_id') is-invalid @enderror" name="parent_id" id="exampleSelectGender">
                                    <option value="">Primary Category</option>
                                    @foreach ($categories as $parent)
                                        <option value="{{$parent->id }}" @selected($category->parent_id == $parent->id)>{{$parent->name }}</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                {{-- <label for="exampleInputEmail3">Description</label>
                                <textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="description" rows="1">{{$category->description}}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror --}}
                                <x-form.textarea label="Description" name="description"  value="{{$category->description}}" />
                            </div>
                            <div class="form-group">
                                <x-form.label id="image">Image</x-form.label>
                                <x-form.input type="file" name="image" accept="image/*" />
                                {{-- <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror" accept="image/*">
                                @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror --}}
                                <br>
                                @if ($category->image)
                                    <img src="{{asset('storage/'.$category->image)}}" height="100" width="200" >
                                @endif
                            </div>
                            <div class="form-group">
                                <x-form.label id="status">Status</x-form.label>
                                <x-form.radio name="status" checked="{{$category->status}}" :options="['active'=>'Active' , 'archived'=>'Archived']" />
                                {{-- <label >Status</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input  @error('status') is-invalid @enderror" name="status"  value="active" @checked($category->status == 'active')>
                                        Active
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input  @error('status') is-invalid @enderror" name="status"  value="archived" @checked($category->status == 'archived') >
                                        Archived
                                    </label>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror --}}
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
