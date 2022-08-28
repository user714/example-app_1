<?php

namespace App\Http\Controllers;


use App\Models\Operators;
use App\Models\Price_operators;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/*Контроллер для работы с прайсами операторов */
class OperatorsPriceController extends Controller
{
    //метод рендера прайса у текущего оператора
    public function index(int $id = 1){

        // получаем информацию о текущем операторе
        $this_operator = Operators::findOrFail($id);

        // получаем информацию о остальных опреаторах и цену разговора текущего оператора с ними
        $operators_price_list = DB::table('operators')
            ->leftJoin('price_operators', function ($join)  use ($id){
                $join->on('price_operators.id_to_operator', '=', 'operators.id')->where('price_operators.id_from_operator', '=', $id);
            })->select('operators.*', 'price_operators.price')
            ->where('operators.id', '<>', $id)

            ->get();
        return ['this_operator'=> $this_operator, 'operators_price_list'=>$operators_price_list];
        return view('operators.price.index',   compact('operator', 'operators') );
    }

    //метод сохранения ценовой политики оператора
    public  function save(){


        $data = \request()->validate([
            'id_from_operator' => 'integer',
            'id_to_operator' => 'integer',
            'price' => 'numeric',
        ]);
        try {
            // пытаемся  создать новый прайс для казаннах опрераторов
            Price_operators::create($data);

        } catch (\Exception $e) {
            // случилась какая то ошибка в момент создания прайса возможно уже есть связь между двумя операторами

            /*
            Можно добавить обработку этой ошибки (если к примеру мы создаем прайс по несуществующим операторам и так далее )
            return  "Хьюстон, у нас проблемы !!!";
            */

            // возможно у них уже был создан ранее прайс и его нужно изменить попробуем его изменить
            // можно вынести в отдельную функцию - так код будет чище
            try {
                DB::table('price_operators')
                    ->where('id_from_operator', '=', $data['id_from_operator'])
                    ->where('id_to_operator', '=', $data['id_to_operator'])
                    ->update(['price' => $data['price']]);
            } catch (\Exception $e) {

                $response['message'] = "Хьюстон, у нас проблемы! Случилась какая-то ошибка";
                $response['message_error'] = $e;
                return  response()->json($response, 400);
            }

        }
        $response['message'] = "Запись успешно добавлена.";
        return  response()->json($response, 200);
        //если все ок, то мы делаем редерект на станицу с тариынм планом оператора
        return redirect()->route('operators.price.list', $data['id_from_operator']);

    }


}
