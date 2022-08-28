@extends('layouts.app')
@section("content")
<h1>Форма создания оператора</h1>
<form action="{{ route('operators.create') }}" method="post">
    @csrf
    <div>
        <input placeholder="Название" type="text" name="name">
    </div>
    <div>
        <button>Сохранить</button>
    </div>
</form>
@endsection
