@extends('layouts.app')

@push('scripts')
<script src="{{asset('js/test-edit.js')}}"></script>
@endpush

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center"><h4>{{$test->name}}</h4></div>
                    <div class="card-body">
                        <form action="{{action('Admin\TestController@update', $test)}}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>Название теста</label>
                                <input name="name" id="testName" type="text" class="form-control"
                                       value="{{$test->name}}">
                                <input type="submit" class="btn btn-success mt-3" value="Изменить">
                            </div>

                            <div class="form-group">
                                <label>Количество вопросов: </label>
                                <p>{{$test->questions->count()}}</p>
                            </div>

                            <div class="form-group">
                                <label>Список вопросов:</label>
                                <select class="form-control" id="all_questions_list">
                                    <option value="0">Все вопросы</option>
                                    @foreach($test->questions as $question)
                                        <option value="{{$question->id}}">{{$question->text}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <a href="{{action('Admin\QuestionController@create', $test)}}" class="btn btn-primary">Добавить
                                вопрос</a>

                        </form>
                        <div class="question mt-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
