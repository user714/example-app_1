<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*Контроллер для работы с пользователями */
class UsersController extends Controller
{
    function __construct()
    {
        // инициализаруем экземплар класса пользователей, что бы в дольнейшем обрашиться к методам этого класса
       $this->m_phone_number_controller = new OperatorsPhoneNumberController();
    }
    private $m_phone_number_controller;

    //метод рендерит весь список пользователей
    public function index(){
        $users = Users::all();
        // получаем все номера телефонов, чтобы можно было изменить номер телефона пряма в списке пользователей
        $all_phone_numbers = $this->m_phone_number_controller->all_numbers();
        return ["users"=>$users, "all_phone_numbers" => $all_phone_numbers];

        return view('users.index', compact('users',  'all_phone_numbers'));
    }

    //метод рендерит форму создания нового пользователя
    public function create(){
        // получаем все номера телефонов, чтобы выбрать нужный при создании пользователя
        $phone_numbers_list = $this->m_phone_number_controller->all_numbers();
        return  $phone_numbers_list;
        return view('users.create', compact('all_phone_numbers'));
    }

    // метод сохраняет изменения номера телефона у пользователя
    public  function edit_phone(){
        $data = \request()->validate([
            'user_id' => 'integer',
            'id_phone_number' => 'integer',
        ]);

        try {
            // пытаемся сохранить номер телефона
            DB::table('users')
                ->where('id', '=', $data['user_id'])->limit(1)
                ->update(['id_phone_number' => $data['id_phone_number']]);

        } catch (\Exception $e) {
            // возможно в момент сохранения номера в базу была ошибка (если номер не уникально и так далее обтобоаем ее )
            $response['message'] = "Хьюстон, у нас проблемы! Случилась какая-то ошибка";
            $response['message_error'] = $e;
            return  response()->json($response, 400);
        }

        $response['message'] = "Запись успешно добавлена.";
        return  response()->json($response, 200);
        // если номер телефона сохранен перебрасываем на страницу с списком пользователей
        return redirect()->route('users.list');

    }

    //метод сохраняет нового пользователя
    public  function save(){

        $data = \request()->validate([
            'firstname' => 'string',
            'lastname' => 'string',
            'patronymic' => 'string',
            'id_phone_number' => 'integer',
        ]);
        try {

            Users::create($data);

        } catch (\Exception $e) {
            // возможно в момент создания нового пользователя была ошибка (если номер не уникально и так далее обтобоаем ее )
            $response['message'] = "Хьюстон, у нас проблемы! Случилась какая-то ошибка";
            $response['message_error'] = $e;
            return  response()->json($response, 400);
        }

        $response['message'] = "Запись успешно добавлена.";
        return  response()->json($response, 200);

    }

    public function all_users()
    {
        return Users::all();
    }

}
