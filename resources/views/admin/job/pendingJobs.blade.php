@extends('admin.layouts.adminMaster')

@push('css')
@endpush

@section('content')
  @include('admin.job.parts.PendingJobslist')
@endsection


@push('js')

@endpush