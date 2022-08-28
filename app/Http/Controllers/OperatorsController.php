<?php

namespace App\Http\Controllers;

use App\Models\Operators;
use Illuminate\Http\Request;

/*Контроллер для работы с операторами  */
class OperatorsController extends Controller
{
    // метод рендера всего списка операторов
    public function index(){
        return Operators::all();

        return view('operators.index',  compact('operators'));
    }
    // метод рендера формы создания операторов
    public function create(){
        return view('operators.create');
    }

    public  function save(){
        $data = \request()->validate([
            'name' => 'string',
        ]);

        try {
            Operators::create($data);
        } catch (\Exception $e) {
            // возможно в момент создания нового орератора была ошибка ( обтобоаем ее )
            $response['message'] = "Хьюстон, у нас проблемы! Случилась какая-то ошибка";
            $response['message_error'] = $e;
            return  response()->json($response, 400);
        }

        $response['message'] = "Запись успешно добавлена.";
        return  response()->json($response, 200);
        // если все успешно создано редиректом на страницу с списком операторов
        return redirect()->route('operators.list');
    }
}
