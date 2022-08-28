<template>
    <h1 style="border-bottom: solid 1px   rgba(0, 0, 0, 0.28);">Журнал вызовов</h1>

    <div style="padding: 10px 0px;  display: grid;  grid-template-columns:   1fr 1fr ;">
        <div>
            <router-link :to="{name:'all_time_user_stats'}">Статистика потраченного времени</router-link>
        </div>
        <div style="text-align: right;">
            <router-link :to="{name:'journal_create_element'}">Добавить запись в журнал</router-link>
        </div>
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

    <div v-for="journal_element in list_journal_call">
        <div  style="display: grid;   grid-template-columns: 50px 1fr 1fr 1fr 1fr 100px 100px 100px ; border-bottom: solid 1px #bbb; padding-bottom: 10px; padding-top: 10px;">
        <div>
            {{journal_element.id}}
        </div>
        <div>
            <div>
                {{journal_element.from_user_firstname}} {{journal_element.from_user_lastname}} {{journal_element.from_user_patronymic}}
            </div>
            <div>
                {{journal_element.from_phone_number}}
            </div>
            <div>
                (Оператор:   {{journal_element.from_operator_name}} )
            </div>
        </div>

        <div>
            <div>
                {{journal_element.to_user_firstname}}   {{journal_element.to_user_lastname}}   {{journal_element.to_user_patronymic}}
            </div>
            <div>
                {{journal_element.to_phone_number}}
            </div>
            <div>
                (Оператор: {{journal_element.to_operator_name}} )
            </div>
        </div>
            <div>{{journal_element.start_call}}</div>
            <div>{{journal_element.finish_call}}</div>
            <div>{{journal_element.count_minutes}}</div>

            <div>{{journal_element.price}}</div>
            <div>{{journal_element.cheque_minuts}}</div>
    </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Home",

    data (){
        return{
            // инициализирует набор данных
             list_journal_call:[],
        }
    },
    mounted() {
      this.get_list_journal_call();
    },
    methods:{
        get_list_journal_call(){
            axios.get("/journal_call")
                .then(rez => {
                    this.list_journal_call = rez.data;
                }).catch(function (){
                    alert("Ошибка получения списка");
            });
        },

    }
}
</script>

<style scoped>

</style>
