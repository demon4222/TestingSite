@extends('layouts.app')

@push('styles')

@endpush

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="container">
        <div class="card">
            <div class="card-header text-center"><h4>Список всех тестов</h4></div>
            <div class="card-body">
                <a href="{{action('Admin\TestController@create')}}" class="btn btn-success mb-2">Создать новый тест</a>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Название</th>
                        <th scope="col">Всего вопросов</th>
                        <th scope="col">Создан</th>
                        <th scope="col">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tests as $test)
                        <tr>
                            <td>
                                <a href="{{action('Admin\TestController@show', $test)}}">{{$test->name}}</a>
                            </td>
                            <td>{{$test->questions->count()}}</td>
                            <td>{{$test->created_at}}</td>
                            <td>
                                <form class="mb-2" action="{{action('Admin\TestController@destroy', $test)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-sm btn-danger" value="Удалить">
                                </form>
                                <form action="{{action('Admin\TestController@edit', $test)}}" method="GET">
                                    <input type="submit" class="btn btn-sm btn-primary" value="Редактировать">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="paginator">
                {{$tests->links()}}
            </div>
        </div>
    </div>
@endsection
