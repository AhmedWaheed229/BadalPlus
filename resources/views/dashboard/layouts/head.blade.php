<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" @if(app()->getLocale() == 'ar') dir="rtl" @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$settings->name}} @yield('title')</title>
    <link rel="icon" type="image/png" href="{{asset($settings->icon_url)}}"/>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
{{--    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
{{--    <link rel="stylesheet" href="{{asset('admin/plugins/jqvmap/jqvmap.min.css')}}">--}}

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <!-- Theme style -->
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{asset('admin/css/adminlte_rtl.css')}}">
    @else
        <link rel="stylesheet" href="{{asset('admin/css/adminlte.min.css')}}">
    @endif
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
{{--    <link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">--}}
    <!-- summernote -->
{{--    <link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.min.css')}}">--}}
<style>
    .page-link{
        color: #000;
        border-color: #000;
        margin: 0 0.5rem;
        border-radius: 0.25rem;
    }
    .page-item.active .page-link {
        color: #000;
        background-color: #ffc107;
        border-color: #ffc107;
    }
    .pagination .page-item:first-child,.pagination .page-item:last-child{
        display: none;
    }
    @if(app()->getLocale() == 'ar')
    .select2-container--bootstrap4 .select2-selection--single .select2-selection__arrow{
        right: auto;
        left: 3px;
    }
    @endif
</style>
</head>
