<?php

namespace App\Http\Controllers;

use App\Models\History_calls;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
/*Контроллер для работы с журналом вызовов */
class JournalCallController extends Controller
{
    function __construct() {
        /*при своем приватной экземпляр класса пользователи что бы в дальнем обращаться к методам этого класса при построении журнала*/
        $this->m_users_controller = new UsersController();
        /*
        m_ насколько мне известно всегда показывает, что переменная  приватана
        https://habr.com/ru/post/26077/
       */
    }

    private $m_users_controller;

    /*Метод отрисовки полной истории вызовов*/
    public function index()
    {
        /*получаем запрос все истории вызовов с информацией о пользователях операторах и номерами телефонов */
        $journal_calls =  DB::table('history_calls')
            ->leftJoin('users AS from_user', function ($join){
                $join->on('from_user.id', '=', 'history_calls.id_from_user');
            })
            ->leftJoin('phone_numbers as from_phone_number', function ($join){
                $join->on('from_phone_number.id', '=', 'history_calls.id_from_phone');
            })
            ->leftJoin('operators as from_operator', function ($join){
                $join->on('from_operator.id', '=', 'from_phone_number.id_operator');
            })

            ->leftJoin('users AS to_user', function ($join){
                $join->on('to_user.id', '=', 'history_calls.id_to_user');
            })
            ->leftJoin('phone_numbers as to_phone_number', function ($join){
                $join->on('to_phone_number.id', '=', 'history_calls.id_to_phone');
            })
            ->leftJoin('operators as to_operator', function ($join){
                $join->on('to_operator.id', '=', 'to_phone_number.id_operator');
            })
            ->orderByDesc('history_calls.id')
            ->select(
                'from_user.firstname AS from_user_firstname',
                'from_user.lastname AS from_user_lastname',
                'from_user.patronymic AS from_user_patronymic',
                'from_phone_number.number_phone AS from_phone_number',
                'from_operator.name AS from_operator_name',
                'to_user.firstname AS to_user_firstname',
                'to_user.lastname AS to_user_lastname',
                'to_user.patronymic AS to_user_patronymic',
                'to_phone_number.number_phone AS to_phone_number',
                'to_operator.name AS to_operator_name',
                'history_calls.start_call',
                'history_calls.finish_call',
                'history_calls.price',
                'history_calls.id'

            )
            ->get();

        /*пробегаемся по полученной истории и соверщаем подсчет количества минут и секунд потраченных на вызов, а так-же стоимости звонка */
        foreach ($journal_calls as $journal_call){
            /*преобразуем дату начала разговора и дату завршения разговора из unix time в форамт date */
            $journal_call->start_call = date("Y-m-d H:i:s", $journal_call->start_call);
            $journal_call->finish_call = date("Y-m-d H:i:s", $journal_call->finish_call);

            /*получаем интервал разговора */
            $datetime_start_call = new \DateTime($journal_call->start_call);
            $datetime_finish_call = new \DateTime($journal_call->finish_call);
            $interval = $datetime_start_call->diff($datetime_finish_call);

            /*подсчитываем количество минут и секунд которые занял разговор */
            $count_minutes_call =  ($interval->days * 24 * 60) + ($interval->h  * 60)+$interval->i;
            $journal_call->count_minutes =   $count_minutes_call ." мин : ". $interval->s . " сек";


            /*так, как у оператора прайс за минуту мы можем первое что посчитать это стоимость количества минут потраченных на разговор */
            $price_minutes_call = ($count_minutes_call *  (float)$journal_call->price);

            /*теперь нам осталось посчитать сколько пользователь должен за секунды в разговоре*/
            $price_seconds_call = $interval->s  * ((float)$journal_call->price /  60);

            /*и последнее суммируем нащу стоимость и округляем до двух знаков после запятой тем самым получаем сколько пользователь должен зам рублей и копеек*/
            $journal_call->cheque_minuts =  round($price_minutes_call + $price_seconds_call, 2);

            /*
              !!!!! что бы все код ниже заработал, нужно будет поменять названия переменных в ренедере
             //если в секундах подразумевалось вообще без минут, то до преобразования даты и времени в формат date можно было произвести подсчтет
             $journal_call->count_seconds =  $journal_call->finish_call -  $journal_call->start_cal;
             //Полсе чего произвести уже само преобразования даты начала и даты завершения разговора
             $journal_call->start_call = date("Y-m-d H:i:s", $journal_call->start_call);
             $journal_call->finish_call = date("Y-m-d H:i:s", $journal_call->finish_call);
            */


            /*
            // если прайс подарумеваля целиком в копейках (без рублей ) умножаем нашу стоимость за минуту на 100 тем самым полаем стоимость за минуту в копейках
            $price_kopecks = (float)$journal_call->price  * 100;

            //далее нам нужно узнать сколько мы должны узнать сколько мы должны за одну секунду разговора получанны прайм делим на 60 так как в одной минуте 60 секунд
            $kopecks_second = $price_kopecks / 60;

            // и последнее умножаем полученный прайс на уже рашее полученный интеравл разговора в секундах
            $journal_call->cheque_seconds = $kopecks_second  *  $journal_call->count_seconds;

            !!!!! что бы все код выше заработал, нужно будет поменять названия переменных в ренедере
             */


        }
        return $journal_calls;
        return view('journal_call', compact("journal_calls"));
    }


    /*Метод рендерит форму создания нового вызова для журнала*/
    public function create()
    {
        $users_list = $this->m_users_controller->all_users();
        return $users_list;
        return view('journal_call_create', compact('all_users'));
    }

    /*Метод сохраняет вызов в журнал */
    public function save(){
        $data = \request()->validate([
            'id_from_user' => 'integer',
            'id_to_user' => 'integer',
            'start_call' => 'date_format:Y-m-d H:i:s',
            'finish_call' => 'date_format:Y-m-d H:i:s',
        ]);
        // преобразуем данные из формы в unix time
        $data['start_call'] = strtotime($data['start_call']);
        $data['finish_call'] = strtotime($data['finish_call']);


        //проверяем чтобы пользователь не позвонил сам себе
        if($data['id_from_user']  === $data['id_to_user'] ){


            $response['message'] ="Пользователь позвонил сам себе? Думаю, что бы пообщаться с самим собой телефон не нужен.";
            return  response()->json($response, 400);
        }

        // Проверяем актуальность времени звонка
        if((int) $data['start_call'] > (int)$data['finish_call']){

            $response['message'] = "Звонок в прошлое? Марти Макфлай на связи";
            return  response()->json($response, 400);
        }else if((int) $data['start_call'] ==  (int)$data['finish_call']){
            $response['message'] = "Снова позвонили и сбросили.";
            return  response()->json($response, 400);

        }

        /*
        // проверку актуальности времени можно было записать и так
        if((int) $data['start_call'] >= (int)$data['finish_call']){
            return  "Ошибка времени звонка";
        }
         */


        // получаем информацию о человеке который звонил (его текущий номер телефона и оператора которому он звонил )
        $info_from_operator  = DB::table('users')
            ->leftJoin('phone_numbers', function ($join){
                $join->on('phone_numbers.id', '=', 'users.id_phone_number');
            })
            ->where('users.id', '=', $data['id_from_user'])
            ->select('users.id_phone_number',  'phone_numbers.id_operator')
            ->first();

        $id_from_operator = $info_from_operator->id_operator;

        // получаем информацию о человеке которому звонили (его номер телефона, оператора, а также актуальную стоимость звонка за минуту разговора)
        $info_to_operator  = DB::table('users')
            ->leftJoin('phone_numbers', function ($join){
                $join->on('phone_numbers.id', '=', 'users.id_phone_number');
            })
            ->leftJoin('price_operators', function ($join) use ($id_from_operator){
                $join->on('price_operators.id_to_operator', '=', 'phone_numbers.id_operator')
                ->where('price_operators.id_from_operator', '=', $id_from_operator);
            })
            ->where('users.id', '=', $data['id_to_user'])
            ->select('users.id_phone_number',  'phone_numbers.id_operator', "price_operators.price")
            ->first();


        $data['id_from_phone'] = $info_from_operator->id_phone_number;
        // в теории можно добавить ещё и операторов в таблицу с историями.
        // на тот случай, если пользователь может изменить оператора и перенести с собой номер.
        //$data['id_from_operator'] = $info_from_operator->id_operator;
        //$data['id_to_operator'] = $info_to_operator->id_operator;


        $data['id_to_phone'] = $info_to_operator->id_phone_number;

        $data['price'] = (float) $info_to_operator->price;

        try {
            History_calls::create($data);
        } catch (\Exception $e) {
            // В момент создания новой записи была ошибка (обтобоаем ее )

            $response['message'] = "Хьюстон, у нас проблемы! Случилась какая-то ошибка";
            $response['message_error'] = $e;
            return  response()->json($response, 400);
        }
        $response['message'] = "Запись успешно добавлена.";
        return  response()->json($response, 200);
        // если все успешно создано редиректом на страницу с историей вызовов
        return redirect()->route('journal_call.list');
    }

    // метод выводит информацию о том сколько всего минут пользователь потратил исходящие звонки
    // наверное правильнее было бы вынести этот метод в отдельный класс
    public function  all_time_call_user_view (){

        $count_seconds_users =  DB::table('history_calls')
        ->groupBy(["history_calls.id_from_user"])
        ->select(   DB::raw("SUM(history_calls.start_call) AS start_call"),
                    DB::raw("SUM(history_calls.finish_call) AS finish_call"),
                    'history_calls.id_from_user AS id_user'
        )
        ->get();

        // получаем количество секунд потраченных на разговор
        foreach ($count_seconds_users AS $count_second_user ){
            $count_second_user->count_seconds = $count_second_user->finish_call - $count_second_user->start_call ;
        }


        return  $count_seconds_users;
        return view('all_time_call_user_view', compact('count_seconds_users'));
    }

}
