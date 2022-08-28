<template>
    <h1 style="border-bottom: solid 1px   rgba(0, 0, 0, 0.28);">Создать запись в журнале вызовов</h1>

        <div style="background: #cccccc; display: grid;  grid-template-columns: 1fr  1fr  1fr  1fr 1fr;  padding-bottom: 10px; padding-top: 10px;">
            <div>
                Исходящий звонок
            </div>
            <div>
                Входящий звонок
            </div>
            <div>
                Время начала разговора <br> (Y-m-d H:i:s) -> 2022-08-25 23:02:01
            </div>
            <div>
                Время завершения разговора  <br> (Y-m-d H:i:s)  -> 2022-08-25 23:02:02
            </div>
        </div>
        <div style="display: grid;  grid-template-columns: 1fr  1fr 1fr  1fr 1fr;  padding-bottom: 10px; padding-top: 10px;">
            <div>
                <select id="id_from_user"  v-model="id_from_user" autocomplete="off" style="width: 100%;">
                    <template  v-for="user in users_list">
                        <option v-bind:value="user.id">{{user.firstname}} {{user.lastname}} {{user.patronymic}}</option>
                    </template>
                </select>
            </div>
            <div>
                <select id="id_to_user" v-model="id_to_user"  autocomplete="off" style="width: 100%;">
                    <template  v-for="user in users_list">
                        <option v-bind:value="user.id">{{user.firstname}} {{user.lastname}} {{user.patronymic}}</option>
                    </template>
                </select>
            </div>
            <div>
                <input id="start_call"  v-model="start_call" type="text">
            </div>
            <div>
                <input id="finish_call" v-model="finish_call" type="text">
            </div>
            <div style="text-align: right;">
                <button @click.prevent="add_journal_history" type="submit">Сохранить</button>
            </div>
        </div>

</template>

<script>

import axios from "axios";

export default {
    name: "Journal_create_element",

    data (){
        return{
            // инициализирует набор данных
            users_list:[],
            id_from_user: null,
            id_to_user: null,
            start_call: null,
            finish_call: null,
        }
    },
    mounted() {
        this.get_list_operators();

    },
    methods:{
        get_list_operators(){
            axios.get("/journal_call/create")
                .then(rez => {

                    this.users_list = rez.data;
                }).catch(function (){
                alert("Ошибка получения списка");
            });
        },
        add_journal_history(){

            axios.post("/journal_call/save", {
                id_from_user : this.id_from_user,
                id_to_user : this.id_to_user,
                start_call : this.start_call,
                finish_call : this.finish_call})
                .then(rez=>{
                    console.log(rez);
                    alert(rez.status +" "+ rez.data.message);
                    this.$router.push({ name: 'journal_list' })
                }).catch(function (error){
                    console.error(error);
                    alert( error.response.status + " "+ error.response.data.message);
                });
        }

    }
}
</script>

<style scoped>

</style>
