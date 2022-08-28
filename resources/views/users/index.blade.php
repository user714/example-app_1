@extends('layouts.app')
@section("content")
<h1>Список пользователей</h1>
<div>
    <a href="{{ route('users.create_view') }}">Создать пользователя</a>
    @foreach($users as $user)
        <form action="{{ route('users.edit_phone') }}" method="post">
            @csrf
            <div style="display: grid;   grid-template-columns: 1fr  1fr 200px; border-bottom: solid 1px #bbb; padding-bottom: 10px; padding-top: 10px;">
                <div>
                    {{$user->firstname}}
                    {{$user->lastname}}
                    {{$user->patronymic}}
                </div>
                <div>
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <select name="id_phone_number"  autocomplete="off">
                     @foreach($all_phone_numbers as $phone_number)
                            <option value="{{$phone_number->id}}" @if($user->id_phone_number == $phone_number->id) selected  @endif>{{$phone_number->number_phone}}</option>
                        @endforeach
                    </select>
                </div>
                <div style="text-align: right;">
                    <button>Сохранить</button>
                </div>
            </div>
        </form>
    @endforeach

</div>
@endsection
