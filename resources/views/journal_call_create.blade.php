@extends('layouts.app')
@section("content")
    <h1>Создать запись в журнале вызовов</h1>
    <form action="{{ route('journal_call.create') }}" method="post">
        <div style="background: #cccccc; display: grid;  grid-template-columns: 1fr  1fr  1fr  1fr 1fr;  padding-bottom: 10px; padding-top: 10px;">
            <div>
                Исходящий звонок
            </div>
            <div>
                Входящий звонок
            </div>
            <div>
                Время начала разговора <br> (Y-m-d H:i:s) -> 2022-08-25 23:02:01
            </div>
            <div>
                Время завершения разговора  <br> (Y-m-d H:i:s)  -> 2022-08-25 23:02:02
            </div>
        </div>
        @csrf
        <div style="display: grid;  grid-template-columns: 1fr  1fr 1fr  1fr 1fr;  padding-bottom: 10px; padding-top: 10px;">
            <div>
                <select name="id_from_user">
                    @foreach($all_users as $user)
                        <option value="{{$user->id}}">{{$user->firstname}} {{$user->lastname}} {{$user->patronymic}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select name="id_to_user">
                    @foreach($all_users as $user)
                        <option value="{{$user->id}}">{{$user->firstname}} {{$user->lastname}} {{$user->patronymic}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <input type="text" name="start_call">
            </div>
            <div>
                <input type="text" name="finish_call">
            </div>
            <div style="text-align: right;">
                <button>Сохранить</button>
            </div>
        </div>
    </form>
@endsection
