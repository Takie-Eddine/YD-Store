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
                        <h4 class="card-title">Edit Profile</h4>

                        <form class="forms-sample" action="{{route('dashboard.profile.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <x-alert></x-alert>

                            <div class="form-group">
                                <x-form.input label="First Name" name="first_name" :value="$user->profile->first_name" placeholder="First Name"/>
                            </div>
                            <div class="form-group">
                                <x-form.input label="Last Name" name="last_name"  :value="$user->profile->last_name" placeholder="Last Name"/>
                            </div>
                            <div class="form-group">
                                <x-form.input label="Birthday" name="birthday" type="date" :value="$user->profile->birthday" placeholder="Birthday"/>
                            </div>
                            <div class="form-group">
                                <x-form.radio name="gender" label="Gender" :options="['male'=>'Male' , 'female'=>'Female']" :checked="$user->profile->gender"/>
                            </div>
                            <div class="form-group">
                                <x-form.input label="Street Address" name="street_address"  :value="$user->profile->street_address" placeholder="Street Address"/>
                            </div>
                            <div class="form-group">
                                <x-form.input label="City " name="city" :value="$user->profile->city" placeholder="City"/>
                            </div>
                            <div class="form-group">
                                <x-form.input label="State " name="state" :value="$user->profile->state" placeholder="State"/>
                            </div>
                            <div class="form-group">
                                <x-form.input label="Postal Code " name="postal_code" :value="$user->profile->postal_code" placeholder="Postal Code"/>
                            </div>
                            <div class="form-group">
                                <x-form.select label="Country " name="country" :options="$countries" :selected="$user->profile->country" />
                            </div>
                            <div class="form-group">
                                <x-form.select label="Locale " name="locale"  :options="$locales" :selected="$user->profile->locale"/>
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
