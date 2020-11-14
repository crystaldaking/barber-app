@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @can('edit-users')
                    <div class="card-header">
                        Quene status: {{$settings->get('app_active')}}

                        @if($settings->get('app_active') == 'active')
                            <a href="{{route('global',['status' => 0])}}"><button type="button" class="btn btn-danger">Stop</button></a>
                        @else
                            <a href="{{route('global',['status' => 1])}}"><button type="button" class="btn btn-primary">Resume</button></a>
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
                                <th scope="col">Status</th>
                                @can('edit-users')
                                    <th scope="col">Serve</th>
                                    <th scope="col">Exit</th>
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
                                    <td>{{$item->status}}</td>
                                    <td>
                                        @can('edit-users')
                                            <a href="{{route('status',['id' => $item->id, 'completed' => '1'])}}"><button type="button" class="btn btn-primary">Serve</button></a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('edit-users')
                                            <a href="{{route('status',['id' => $item->id, 'completed' => '0'])}}"><button type="button" class="btn btn-primary">Exit</button></a>
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

