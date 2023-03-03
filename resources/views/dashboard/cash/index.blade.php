@extends('dashboard.layouts.app')

@section('title', ' - '.__('vf cash number'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">{{__('vf cash number')}} ({{count($records)}})</h3>
                    <div class="card-tools">
                        <a class="btn btn-sm btn-warning" href="{{route('cash.create')}}">
                            <i class="fa fa-plus"></i>
                            {{__('create')}}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered text-nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('vf cash number')}}</th>
                                <th>{{__('vf cash show')}}</th>
                                <th>{{__('created_at')}}</th>
                                <th>{{__('actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($records) > 0)
                                    @foreach($records as $index=>$record)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$record->number}}</td>
                                            <td>
                                                @if($record->show=='1')
                                                    <div class="badge badge-success">{{__('active')}}</div>
                                                @else
                                                    <div class="badge badge-danger">{{__('inactive')}}</div>
                                                @endif
                                            </td>
                                            <td dir="ltr">{{Carbon\Carbon::parse($record->created_at)->format('d/m/Y h:i A')}}</td>
                                            <td>
                                                <a class="btn btn-info btn-sm" href="{{route('cash.edit', $record->id)}}">
                                                    <i class="fa fa-pen-alt"></i>
                                                    {{__('edit')}}
                                                </a>

                                                <a class="btn btn-sm btn-danger" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{$record->id}}').submit();">
                                                    <i class="fa fa-trash"></i> {{__('delete')}}
                                                    <form id="delete-form-{{$record->id}}" action="{{ route('cash.destroy',$record->id) }}" method="POST" class="d-none">
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
