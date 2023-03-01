@extends('dashboard.layouts.app')

@section('title', ' - '.__('Recharge Requests'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">{{__('Recharge Requests')}} ({{$records->total()}})</h3>
                    <div class="card-tools">
                        {{--                        <a class="btn btn-sm btn-warning" href="{{route('users.create')}}">--}}
                        {{--                            <i class="fa fa-plus"></i>--}}
                        {{--                            {{__('create')}}--}}
                        {{--                        </a>--}}
                    </div>
                </div>

                <div class="card-body">
                    <form>
                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="user">{{__('user')}}</label>
                                    <input value="{{request('user')}}" class="form-control" name="user" id="user"
                                           placeholder="{{__('user')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="number">{{__('number')}}</label>
                                    <input value="{{request('number')}}" class="form-control" name="number"
                                           id="number" placeholder="{{__('number')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="status">{{__('status')}}</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="">{{__('all')}}</option>
                                        <option @if(request('status') == 'pending') selected
                                                @endif value="pending">{{__('pending')}}</option>
                                        <option @if(request('status') == 'refused') selected
                                                @endif value="refused">{{__('refused')}}</option>
                                        <option @if(request('status') == 'confirmed') selected
                                                @endif value="confirmed">{{__('confirmed')}}</option>
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
                                <th>{{__('user')}}</th>
                                <th>{{__('amount')}}</th>
                                <th>{{__('balance')}}</th>
                                <th>{{__('currency')}}</th>
                                <th>{{__('number')}}</th>
                                <th>{{__('image')}}</th>
                                <th>{{__('status')}}</th>
                                <th>{{__('created_at')}}</th>
                                <th>{{__('accepted amount')}}</th>
                                <th>{{__('confirmed at')}}</th>
                                <th>{{__('actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($records->total() > 0)
                                @foreach($records as $index=>$record)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>
                                            {{$record->first_name}} {{$record->last_name}} <br>
                                            {{$record->email}} <br>
                                            {{$record->phone}}
                                        </td>
                                        <td>{{number_format($record->amount,2 )}}</td>
                                        <td>{{number_format($record->balance,2 )}}</td>
                                        <td>{{ $record->{"name_".app()->getLocale()} ?? ""}}</td>
                                        <td>{{$record->number}}</td>
                                        <td><img src="{{asset('images/recharge_requests/'.$record->img)}}" alt=""
                                                 style="max-height: 60px"></td>
                                        <td>{{__($record->status)}}</td>
                                        <td dir="ltr">{{Carbon\Carbon::parse($record->created_at)->format('d/m/Y h:i A')}}</td>
                                        <td>{{$record->accepted_amount}}</td>
                                        <td dir="ltr">{{$record->accept_date ? Carbon\Carbon::parse($record->accept_date)->format('d/m/Y h:i A') : ""}}</td>
                                        <td>
                                            @if($record->status == 'pending')
                                                <form class="row"
                                                      action="{{route("update_recharge_requests", $record->id)}}"
                                                      method="post" style="min-width: 350px;">
                                                    @csrf
                                                    <div class="col">
                                                        <input type="number" step="0.1"
                                                               value="{{number_format($record->amount,2 )}}"
                                                               name="accepted_amount"
                                                               class="form-control"
                                                               placeholder="{{__("accepted amount")}}">
                                                    </div>
                                                    <div class="col">
                                                        <select type="text" name="status" class="form-control">
                                                            <option value="">{{__('choose')}}</option>
                                                            <option value="refused">{{__('refused')}}</option>
                                                            <option value="confirmed">{{__('confirmed')}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col">

                                                        <button type="submit"
                                                                class="btn btn-warning">{{__("Submit")}}</button>
                                                    </div>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="12" class="text-danger text-center">
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

