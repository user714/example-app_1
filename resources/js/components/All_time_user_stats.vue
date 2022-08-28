<template>
    <h1 style="border-bottom: solid 1px   rgba(0, 0, 0, 0.28);">Статистика потраченного времени на звонки</h1>

    <div style="background: #ccc; display: grid;   grid-template-columns: 1fr 1fr  ; border-bottom: solid 1px #bbb; padding-bottom: 10px; padding-top: 10px;">
        <div>Пользователь</div>
        <div>Количество секунд</div>
    </div>
    <div v-for="all_time_call_user_element in list_all_time_call_user">
        <div style="display: grid;   grid-template-columns: 1fr 1fr  ; border-bottom: solid 1px #bbb; padding-bottom: 10px; padding-top: 10px;">
            <div>
                {{all_time_call_user_element.id_user}}
            </div>
            <div>
                {{all_time_call_user_element.count_seconds}}
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "All_time_user_stats",
    data (){
        return{
            // инициализирует набор данных
            list_all_time_call_user:[],
        }
    },
    mounted() {
        this.get_all_time_call_user();
    },
    methods:{
        get_all_time_call_user(){
            axios.get("/journal_call/all_time_call_user")
                .then(rez => {
                    this.list_all_time_call_user = rez.data;
                }).catch(function (){
                alert("Ошибка получения списка");
            });
        },

    }
}
</script>

<style scoped>

</style>
