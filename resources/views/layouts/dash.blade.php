@extends('material.layouts.dashboard')

{{--
  Dash del usuario, los links cambian segun el rol del usuario
--}}
@php
  $role = auth()->user()->role;
@endphp

@section('links')
  

    @includeWhen($role == 'admin', 'calisoft.admin.admin-dash') 

    @includeWhen($role == 'student', 'calisoft.student.student-dash')

    @includeWhen($role == 'evaluator', 'calisoft.evaluator.evaluator-dash')

  
@endsection

@push('styles')
    <link rel="stylesheet" href="/assets/global/plugins/bootstrap-toastr/toastr.min.css">
 @endpush

@push('plugins')
    <script src="/js/manifest.js"></script>
    <script src="/js/vendor.js"></script>
    <script src="/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
    <script>
        Object.assign(toastr.options, {
            positionClass: "toast-bottom-right"
        })
    </script>
@endpush
