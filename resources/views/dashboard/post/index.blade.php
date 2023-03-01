@extends('dashboard.layouts.app')

@section('title', ' - '.__('posts'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">{{__('posts')}} ({{$records->total()}})</h3>
                </div>

                <div class="card-body">
                    <form>
                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="user">{{__('user')}}</label>
                                    <select class="form-control select2" id="user" name="user">
                                        <option value="">{{__('all')}}</option>
                                        @foreach($users as $user)
                                            <option @if(request('user') == $user->id) selected
                                                    @endif value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="title">{{__('title')}}</label>
                                    <input value="{{request('title')}}" class="form-control" name="title" id="title"
                                           placeholder="{{__('title')}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="active">{{__('activation')}}</label>
                                    <select class="form-control" name="active" id="active">
                                        <option value="">{{__('all')}}</option>
                                        <option @if(request('active') == '0') selected
                                                @endif value="0">{{__('pending')}}</option>
                                        <option @if(request('active') == '1') selected
                                                @endif value="1">{{__('active')}}</option>
                                        <option @if(request('active') == '2') selected
                                                @endif value="2">{{__('inactive')}}</option>
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
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('title')}}</th>
                                <th>{{__('image')}}</th>
                                <th>{{__('description')}}</th>
                                <th>{{__('category')}}</th>
                                <th>{{__('price')}}</th>
                                <th>{{__('activation')}}</th>
                                <th>{{__('created_at')}}</th>
                                <th>{{__('actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($records->total() > 0)
                                @foreach($records as $index=>$record)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$record->title}}</td>
                                        <td><img src="{{$record->image_url}}" alt=""
                                                 style="max-width: 150px; object-fit: contain" height="200px"></td>
                                        <td>{{$record->description}}</td>
                                        <td>{!!  $record->category ? $record->category->category ? $record->category->category->name .' <br> '. $record->category->name : $record->category->name :""!!}</td>
                                        <td>{{$record->price}}{{$record->currency->name ?? ''}}</td>
                                        <td>
                                            <div class="badge
                                                @if($record->active == 1)
                                                    badge-success
                                                @elseif($record->active == 2)
                                                    badge-danger
                                                @elseif($record->active == 0)
                                                    badge-warning
                                                @endif
                                                 ">
                                                {{$record->active_status}}
                                            </div>
                                        </td>
                                        <td dir="ltr">{{Carbon\Carbon::parse($record->created_at)->format('d/m/Y h:i A')}}</td>
                                        <td>
                                            @if($record->active != 1)
                                                <a class="btn btn-success mb-1 btn-sm text-nowrap"
                                                   href="{{route('posts.activate', $record->id)}}">
                                                    <i class="fa fa-check"></i>
                                                    {{__('activate')}}
                                                </a>
                                            @endif
                                            @if($record->active != 2)
                                                <a class="btn btn-danger mb-1 btn-sm text-nowrap"
                                                   href="{{route('posts.inactivate', $record->id)}}">
                                                    <i class="fa fa-ban"></i>
                                                    {{__('in activate')}}
                                                </a>
                                            @endif
                                            @if($record->active != 0)
                                                <a class="btn btn-warning btn-sm text-nowrap"
                                                   href="{{route('posts.pending', $record->id)}}">
                                                    <i class="fa fa-pause"></i>
                                                    {{__('pending')}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="text-danger text-center">
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
