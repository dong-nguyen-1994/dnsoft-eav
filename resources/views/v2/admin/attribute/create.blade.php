@extends('core::v2.admin.master')

@section('title', __('eav::attribute.create.page_title'))

@section('breadcrumbs')
<div class="title_left" style="margin-bottom: 2em;">
  <div class="page-title-box">
    <div class="page-title-right">
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">{{ trans('dashboard::message.index.breadcrumb') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route($routeNamePrefix.'index') }}">{{ trans('eav::attribute.index.breadcrumb') }}</a></li>
        <li class="breadcrumb-item active">{{ trans('eav::attribute.create.breadcrumb') }}</li>
      </ol>
    </div>
  </div>
</div>
@endsection

@section('content')
<form action="{{ route($routeNamePrefix.'store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="row" style="display: block;">
    <div class="clearfix"></div>
    <div class="col-md-12 col-sm-12">
      <div class="x_panel">
        @include('eav::v2.admin.attribute._fields', ['item' => null])
        <hr>
        <x-button-save-edit />
      </div>
    </div>
  </div>
</form>
@stop