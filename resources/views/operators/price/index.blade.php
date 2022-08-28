@extends('layouts.app')
@section("content")
    <h1>Цены оператора {{$operator->name}}</h1>

    @foreach($operators as $operator_)
        <form action="{{ route('operators.price.create', $operator->id) }}" method="post">
            @csrf
            <div style="display: grid;   grid-template-columns:   1fr  1fr   200px; border-bottom: solid 1px #bbb; padding-bottom: 10px; padding-top: 10px;">
                <div>
                    <input  type="hidden" name="id_from_operator" value="{{$operator->id}}">
                    <input  type="hidden" name="id_to_operator" value="{{$operator_->id}}">
                    {{$operator_->name}}
                </div>
                <div>
                    <input placeholder="Цена за минуту" type="text" name="price" value="{{$operator_->price}}"> (р/минута)
                </div>
                <div style="text-align: right;">
                    <button>Сохранить</button>
                </div>
            </div>
        </form>
    @endforeach
@endsection
