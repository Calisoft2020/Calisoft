@extends('layouts.dash')

@php
  $role = auth()->user()->role;
@endphp


@section('content')

    @includeWhen($role == 'admin', 'calisoft.admin.admin-home') 

    @includeWhen($role == 'student', 'calisoft.student.student-home')

    @includeWhen($role == 'evaluator', 'calisoft.evaluator.evaluator-home')

@endsection
