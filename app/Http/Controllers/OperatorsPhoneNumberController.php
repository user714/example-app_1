<?php

namespace App\Http\Controllers;

use App\Models\Phone_numbers;
use App\Models\Operators;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*Контроллер для работы с номерами телефонов*/
class OperatorsPhoneNumberController extends Controller
{
    /*метод возвращает полный список номеров (всех операторов) из бд*/
    public function  all_numbers(){
        $phone_numbers = DB::table('phone_numbers')->get();
        return $phone_numbers;
    }


    /*метод возвращает полный список номеров (по конкретному оператору из бд) и рендерит его */
    public function index(int $id = 1){
        $this_operator = Operators::findOrFail($id);
        $phone_numbers_list = DB::table('phone_numbers')->where('id_operator', '=', $id)->get();
        return ["phone_numbers_list"=> $phone_numbers_list, "this_operator"=> $this_operator];
        return view('operators.phone_number.index',   compact('operator', 'phone_numbers') );
    }

    /*  метод рендерит форму создания номера телефона для конкретного оператора */
    public function create(int $id = 1){
        $operator = Operators::findOrFail($id);
        return  $operator;
        return view('operators.phone_number.create',   compact('operator') );
    }

    /*  метод создает новый номер телефона для конкретного оператора  */
    public  function save(){

        $data = \request()->validate([
            'id_operator' => 'integer',
            'number_phone' => 'integer|regex:/(8)[0-9]{9}/',
        ]);
        try {
            Phone_numbers::create($data);
        } catch (\Exception $e) {
            // возможно в момент сохранения номера в базу была ошибка ( обтобоаем ее )
            $response['message'] = "Хьюстон, у нас проблемы! Случилась какая-то ошибка";
            $response['message_error'] = $e;
            return  response()->json($response, 400);
        }


        $response['message'] = "Запись успешно добавлена.";
        return  response()->json($response, 200);
        /*  Если номер успешно создан нас перебрасывает на страницу с полным списком номеров (конкретного оператора)  */
        return redirect()->route('operators.phone_number.list', $data['id_operator']);

    }


}
