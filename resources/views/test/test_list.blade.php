@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/test_list.css')}}">
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header text-center"><h4>Список доступных тестов</h4></div>
            <div class="card-body">
                <ul>
                    @foreach($tests as $test)
                        <li><a href="/test/{{$test->id}}">{{$test->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="paginator">
                {{$tests->links()}}
            </div>
        </div>
    </div>
@endsection
