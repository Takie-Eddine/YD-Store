@extends('layouts.dashboard')

@section('title','Create')


@push('style')

@endpush

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Create Category</h4>

                        <form class="forms-sample" action="{{route('dashboard.categories.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <h3>Error Occured!</h3>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror " name="name" id="exampleInputName1" placeholder="Name" value="{{old('name')}}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Category Parent</label>
                                <select class="form-control  @error('parent_id') is-invalid @enderror" name="parent_id" id="exampleSelectGender">
                                    <option value="">Primary Category</option>
                                    @foreach ($categories as $parent)
                                        <option value="{{$parent->id }}" @selected(old('parent_id') == $parent->id)>{{$parent->name }}</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror " name="description" id="description" rows="1">{{old('description')}}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Image </label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror " accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label >Status</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input @error('status') is-invalid @enderror" name="status"  value="active" @checked(old('status') == 'active') >
                                        Active
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input @error('status') is-invalid @enderror" name="status"  value="archived" @checked(old('status') == 'archived')>
                                        Archived
                                    </label>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Save</button>
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
