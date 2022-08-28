@extends('layouts.app')

@section("content")
<h1>Журнал вызовов</h1>

<div>
    <a href="{{ route('journal_call.create_view') }}">Добавить запись в журнал</a>
</div>

<div>
    <a href="{{ route('journal_call.all_time_user_stats') }}">Статистика потраченного времени</a>
</div>

<div style="background: #ccc; display: grid;   grid-template-columns: 50px 1fr 1fr 1fr 1fr 100px 100px  100px  ; border-bottom: solid 1px #bbb; padding-bottom: 10px; padding-top: 10px;">
    <div>
        id
    </div>
    <div>Исходящий звонок</div>
    <div>Входящий звонок</div>

    <div>Время начала разговора</div>
    <div>Время конца разговора</div>
    <div>Количество минут</div>
    <div>Прайс за минуту</div>
    <div>Стоимость звонка</div>
</div>
@foreach($journal_calls as $call)
    <div style="display: grid;   grid-template-columns: 50px 1fr 1fr 1fr 1fr 100px 100px 100px ; border-bottom: solid 1px #bbb; padding-bottom: 10px; padding-top: 10px;">
        <div>
            {{$call->id}}
        </div>
        <div>
            <div>
                {{$call->from_user_firstname}}   {{$call->from_user_lastname}}   {{$call->from_user_patronymic}}
            </div>
            <div>
                {{$call->from_phone_number}}
            </div>
            <div>
              (Оператор: {{$call->from_operator_name}} )
            </div>
        </div>

        <div>
            <div>
                {{$call->to_user_firstname}}   {{$call->to_user_lastname}}   {{$call->to_user_patronymic}}
            </div>
            <div>
                {{$call->to_phone_number}}
            </div>
            <div>
                (Оператор: {{$call->to_operator_name}} )
            </div>
        </div>

        <div>{{$call->start_call}}</div>
        <div>{{$call->finish_call}}</div>
        <div>{{$call->count_minutes}}</div>

        <div>{{$call->price}}</div>
        <div>{{$call->cheque_minuts}}</div>
    </div>
@endforeach
@endsection

