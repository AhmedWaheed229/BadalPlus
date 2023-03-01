@extends('dashboard.layouts.app')

@section('title', ' - '.__('why_us'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">{{__('why_us')}} ({{count($records)}})</h3>
                    <div class="card-tools">
                        <a class="btn btn-sm btn-warning" href="{{route('why_us.create')}}">
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
                                    <label for="title">{{__('title')}}</label>
                                    <input value="{{request('title')}}" class="form-control" name="title" id="title" placeholder="{{__('title')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="active">{{__('active')}}</label>
                                    <select class="form-control" name="active" id="active">
                                        <option value="">{{__('all')}}</option>
                                        <option @if(request('active') == '1') selected @endif value="1">{{__('active')}}</option>
                                        <option @if(request('active') == '0') selected @endif value="0">{{__('inactive')}}</option>
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
                                <th>{{__('title_ar')}}</th>
                                <th>{{__('title_en')}}</th>
                                <th>{{__('icon')}}</th>
                                <th>{{__('description_ar')}}</th>
                                <th>{{__('description_en')}}</th>
                                <th>{{__('active')}}</th>
                                <th>{{__('created_at')}}</th>
                                <th>{{__('actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($records) > 0)
                                    @foreach($records as $index=>$record)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$record->title_ar}}</td>
                                            <td>{{$record->title_en}}</td>
                                            <td><img src="{{$record->icon_url}}" alt="" style="max-height: 70px"></td>
                                            <td>{{$record->description_ar}}</td>
                                            <td>{{$record->description_en}}</td>
                                            <td>
                                                @if($record->active)
                                                    <div class="badge badge-success">{{__('active')}}</div>
                                                @else
                                                    <div class="badge badge-danger">{{__('inactive')}}</div>
                                                @endif
                                            </td>
                                            <td dir="ltr">{{Carbon\Carbon::parse($record->created_at)->format('d/m/Y h:i A')}}</td>
                                            <td>
                                                <a class="btn btn-info btn-sm" href="{{route('why_us.edit', $record->id)}}">
                                                    <i class="fa fa-pen-alt"></i>
                                                    {{__('edit')}}
                                                </a>

                                                <a class="btn btn-sm btn-danger" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{$record->id}}').submit();">
                                                    <i class="fa fa-trash"></i> {{__('delete')}}
                                                    <form id="delete-form-{{$record->id}}" action="{{ route('why_us.destroy',$record->id) }}" method="POST" class="d-none">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
