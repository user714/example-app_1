@extends('layouts.app')
@section("content")
    <h1>Сколько каждый пользователь потратил времени на звонки</h1>

    <div style="background: #ccc; display: grid;   grid-template-columns: 1fr 1fr  ; border-bottom: solid 1px #bbb; padding-bottom: 10px; padding-top: 10px;">
        <div>Пользователь</div>
        <div>Количество секунд</div>
    </div>
    @foreach($count_seconds_users as $count_second_user)
        <div style="display: grid;   grid-template-columns: 1fr 1fr  ; border-bottom: solid 1px #bbb; padding-bottom: 10px; padding-top: 10px;">
            <div>
                {{$count_second_user->id_user}}
            </div>
            <div>
                {{$count_second_user->count_seconds}}
            </div>
        </div>
    @endforeach
@endsection

