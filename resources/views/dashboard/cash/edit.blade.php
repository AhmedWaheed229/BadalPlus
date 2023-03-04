@extends('dashboard.layouts.app')

@section('title', ' - '.__('edit') .' '. __('vf cash number'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-warning">
            <div class="card-header">
                <h3 class="card-title">{{__('edit')}} {{__('vf cash number')}}</h3>
            </div>

            <form action="{{route('cash.update', $record->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="content_ar">{{__('number')}} <span class="text-danger">*</span></label>
                                <input type="text" name="number" id="number" value="{{ $record->number }}"
                                    class="form-control @error('number') is-invalid @enderror">
                                @error('number')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="active">
                                    {{__('Showing')}}
                                </label>
                                <select name="show" class="form-control" id="">
                                    <option value="0">not showing</option>
                                    <option value="1">showing</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-sm btn-warning">
                        <i class="fa fa-pen-alt"></i>
                        {{__('edit')}}
                    </button>
                    <a class="btn btn-sm btn-dark" href="{{route('welcomes.index')}}">
                        <i class="fa fa-undo"></i>
                        {{__('cancel')}}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
