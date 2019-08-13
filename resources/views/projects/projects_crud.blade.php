@extends('layouts.master')

@section('css')
@parent
<link href="{{asset('/')}}assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/')}}assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('title')
    Project CRUD
@endsection

@section('content')
    <project-crud></project-crud>
@endsection

@section('js')
    @parent
    <script src="{{asset('/')}}assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{asset('/')}}assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <script src="{{asset('/')}}assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="{{asset('/')}}assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>
@endsection