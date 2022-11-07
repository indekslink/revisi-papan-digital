@extends('layouts')


@section('content')
<iframe src="https://infodesatikusan.com" allow="fullscreen" frameborder="0"></iframe>
@endsection


@section('style')
<style>
    iframe {
        width: calc(100% + 48px);
        margin: -1.5rem 0 0 -24px;
        height: calc(100vh - 85px);
    }
</style>
@endsection