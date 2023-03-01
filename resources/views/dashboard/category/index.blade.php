@extends('dashboard.layouts.app')

@section('title', ' - '.__('categories'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">{{__('categories')}} ({{count($records)}})</h3>
                    <div class="card-tools">
                        <a class="btn btn-sm btn-warning" href="{{route('categories.create')}}">
                            <i class="fa fa-plus"></i>
                            {{__('create')}}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form>
                        <div class="row align-items-end">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="category">{{__('categories')}}</label>
                                    <select class="form-control" name="category" id="category">
                                        <option value="">{{__('all')}}</option>
                                        <option @if(request()->filled('category') && request('category') == 0) selected @endif value="0">{{__('main category')}}</option>
                                        @foreach($categories as $category)
                                        <option @if(request('category') == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="name">{{__('name')}}</label>
                                    <input value="{{request('name')}}" class="form-control" name="name" id="name" placeholder="{{__('name')}}">
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
                                <th>{{__('category')}}</th>
                                <th>{{__('name')}}</th>
                                <th>{{__('percent')}}</th>
                                <th>{{__('image')}}</th>
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
                                            <td>
                                                @if($record->category)
                                                    {{$record->category->name ?? ""}}
                                                    @if($record->category->active)
                                                        <div class="badge badge-success">{{__('active')}}</div>
                                                    @else
                                                        <div class="badge badge-danger">{{__('inactive')}}</div>
                                                    @endif
                                                @elseif($record->parent_id == 0)
                                                    {{__('main category')}}
                                                @endif
                                            </td>
                                            <td>{{$record->name_ar}} <br> {{$record->name_en}}</td>
                                            <td>@if($record->parent_id){{$record->percent}}%@endif</td>
                                            <td>@if($record->image_url)<img style="width: 200px; object-fit: contain" height="200" src="{{$record->image_url}}" alt="" /> @endif</td>
                                            <td>
                                                @if($record->active)
                                                    <div class="badge badge-success">{{__('active')}}</div>
                                                @else
                                                    <div class="badge badge-danger">{{__('inactive')}}</div>
                                                @endif
                                            </td>
                                            <td dir="ltr">{{Carbon\Carbon::parse($record->created_at)->format('d/m/Y h:i A')}}</td>
                                            <td>
                                                <a class="btn btn-info btn-sm" href="{{route('categories.edit', $record->id)}}">
                                                    <i class="fa fa-pen-alt"></i>
                                                    {{__('edit')}}
                                                </a>

                                                <a class="btn btn-sm btn-danger" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{$record->id}}').submit();">
                                                    <i class="fa fa-trash"></i> {{__('delete')}}
                                                    <form id="delete-form-{{$record->id}}" action="{{ route('categories.destroy',$record->id) }}" method="POST" class="d-none">
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
