@extends('dashboard.layouts.app')

@section('title', ' - '.__('users'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">{{__('users')}} ({{$records->total()}})</h3>
                    <div class="card-tools">
                        <a class="btn btn-sm btn-warning" href="{{route('users.create')}}">
                            <i class="fa fa-plus"></i>
                            {{__('create')}}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form>
                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="first_name">{{__('first_name')}}</label>
                                    <input value="{{request('first_name')}}" class="form-control" name="first_name" id="first_name" placeholder="{{__('first_name')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="last_name">{{__('last_name')}}</label>
                                    <input value="{{request('last_name')}}" class="form-control" name="last_name" id="last_name" placeholder="{{__('last_name')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="email">{{__('email')}}</label>
                                    <input value="{{request('email')}}" class="form-control" name="email" id="email" placeholder="{{__('email')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="phone">{{__('phone')}}</label>
                                    <input value="{{request('phone')}}" class="form-control" name="phone" id="phone" placeholder="{{__('phone')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="active">{{__('active')}}</label>
                                    <select class="form-control" name="active" id="active">
                                        <option value="">{{__('all')}}</option>
                                        <option @if(request('active') == '1') selected
                                                @endif value="1">{{__('active')}}</option>
                                        <option @if(request('active') == '0') selected
                                                @endif value="0">{{__('inactive')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="admin">{{__('admin')}}</label>
                                    <select class="form-control" name="admin" id="admin">
                                        <option value="">{{__('all')}}</option>
                                        <option @if(request('admin') == '1') selected
                                                @endif value="1">{{__('admin')}}</option>
                                        <option @if(request('admin') == '0') selected
                                                @endif value="0">{{__('user')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-sm btn-warning">
                                        <i class="fa fa-filter"></i>
                                        {{__('filter')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered text-nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('name')}}</th>
                                <th>{{__('email')}}</th>
                                <th>{{__('phone')}}</th>
                                <th>{{__('image')}}</th>
                                <th>{{__('balance')}}</th>
                                <th>{{__('active')}}</th>
                                <th>{{__('admin')}}</th>
                                <th>{{__('created_at')}}</th>
                                <th>{{__('actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($records->total() > 0)
                                @foreach($records as $index=>$record)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td><a href="{{route("profile", $record->id)}}"> {{$record->name}} </a></td>
                                        <td>{{$record->email}}</td>
                                        <td>{{$record->phone}}</td>
                                        <td><img src="{{$record->image_url}}" alt="" style="max-height: 60px"></td>
                                        <td>{{$record->balance}} {{$record->currency->name ?? ""}}</td>
                                        <td>
                                            @if($record->active)
                                                <div class="badge badge-success">{{__('active')}}</div>
                                            @else
                                                <div class="badge badge-danger">{{__('inactive')}}</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($record->admin)
                                                <div class="badge badge-success">{{__('admin')}}</div>
                                            @else
                                                <div class="badge badge-light">{{__('user')}}</div>
                                            @endif
                                        </td>
                                        <td dir="ltr">{{Carbon\Carbon::parse($record->created_at)->format('d/m/Y h:i A')}}</td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="{{route('users.edit', $record->id)}}">
                                                <i class="fa fa-pen-alt"></i>
                                                {{__('edit')}}
                                            </a>

                                            <a class="btn btn-sm btn-danger" href="#"
                                               onclick="event.preventDefault(); document.getElementById('delete-form-{{$record->id}}').submit();">
                                                <i class="fa fa-trash"></i> {{__('delete')}}
                                                <form id="delete-form-{{$record->id}}"
                                                      action="{{ route('users.destroy',$record->id) }}" method="POST"
                                                      class="d-none">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10" class="text-danger text-center">
                                        {{__('no data found')}}
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        {!! $records->withQueryString()->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
