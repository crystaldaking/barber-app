@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit user: {{$user->phone}}</div>

                    <div class="card-body">
                        <form action="{{route('admin.users.update',$user)}}" method="POST">

                            <div class="form-group row">
                                <label for="phone" class="col-md-2 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$user->phone}}" required autocomplete="phone" autofocus>

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @csrf
                            {{method_field('PUT')}}
                            <div class="form-group row">
                                <label for="roles" class="col-md-2 col-form-label text-md-right">{{ __('Roles') }}</label>
                                <div class="col-md-6">
                                    @foreach($roles as $role)
                                        <div class="form-check">
                                            <input type="radio" name="roles[]" value="{{$role->id}}"
                                            @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                            <label>{{$role->name}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

