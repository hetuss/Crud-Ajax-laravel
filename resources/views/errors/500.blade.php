@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '')
<div class="text-center">
    <img src=" {{ asset('assets/admin') }}/dist/img/mad-designer.png" width="75%" alt="">
    <h1><b>Sorry ! We Are Working On It.</b></h1>
</div>
@section('message', __(''))
