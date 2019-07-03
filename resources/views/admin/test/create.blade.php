@extends('layouts.app')

@section('content')
    <div class="container test-block">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header head">
                        <div>Новый тест</div>
                    </div>

                    <div class="card-body">
                        <form action="{{action('Admin\TestController@store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Название теста</label>
                                <input name="name" id="testName" type="text" class="form-control">
                                <input type="submit" class="btn btn-success mt-3" value="Создать тест">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
