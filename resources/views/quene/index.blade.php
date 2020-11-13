@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @can('edit-users')
                    <div class="card-header">
                        Quene status: {{env('APP_QUENE')}}

                        @if(env('APP_QUENE') == 'ACTIVE')
                            <a href=""><button type="button" class="btn btn-danger">Stop</button></a>
                        @else
                            <a href=""><button type="button" class="btn btn-primary">Resume</button></a>
                        @endif

                    </div>

                    @endcan
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                @can('edit-users')
                                    <th scope="col">Phone</th>
                                @endcan
                                <th scope="col">Role</th>
                                <th scope="col">Time</th>
                                @can('edit-users')
                                    <th scope="col">Actions</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($quene as $item)
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{$item->user->phone}}</td>
                                    <td>{{implode(',',$item->user->roles()->get()->pluck('name')->toArray())}}</td>
                                    <td>{{$item->updated_at->format('H:i')}}</td>
                                    <td>
                                        @can('edit-users')
                                            <a href="{{route('quene.quene.edit',$item)}}"><button type="button" class="btn btn-primary">Serve</button></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

