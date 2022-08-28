<template>
    <h1 style="border-bottom: solid 1px   rgba(0, 0, 0, 0.28);">Список всех пользователей</h1>
    <div>

        <div style="text-align: right; padding: 10px 0px;" >
            <router-link :to="{name:'user_create'}">Создать пользователя</router-link>
        </div>
        <div v-for="user in list_users">
            <form action="" method="post">
                <div style="display: grid;   grid-template-columns: 1fr  1fr 200px; border-bottom: solid 1px #bbb; padding-bottom: 10px; padding-top: 10px;">
                    <div>
                        {{user.firstname}}
                        {{user.lastname}}
                        {{user.patronymic}}
                    </div>
                    <div>
                        <input type="hidden" name="user_id" v-bind:value="user.id">

                        <select name="id_phone_number"  autocomplete="off"   v-model="user.id_phone_number" >
                            <template  v-for="phone_number in all_phone_numbers">

                                <option v-bind:value="phone_number.id">{{phone_number.number_phone}}</option>

                            </template>
                        </select>
                    </div>
                    <div style="text-align: right;">
                        <button @click.prevent="edit_user_phone(user.id)">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Users",

    data (){
        return{
            // инициализирует набор данных
            list_users:[],
            all_phone_numbers:[],
        }
    },
    mounted() {
        this.get_list_users();
    },
    methods:{
        get_list_users(){
            axios.get("/users_list")
                .then(rez => {
                    this.list_users = rez.data.users;
                    this.all_phone_numbers = rez.data.all_phone_numbers;
                }).catch(function (){
                alert("Ошибка получения списка");
            });
        },

        edit_user_phone(user_id){
            let this_user_phone = null;

            this.list_users.forEach(function (element) {

                if(element.id == user_id){
                    this_user_phone = element.id_phone_number;
                    return false;
                }
            });

            axios.post("/users/save_phone", {
                user_id : user_id,
                id_phone_number : this_user_phone
                })
                .then(rez=>{
                    console.log(rez);
                    alert(rez.status +" "+ rez.data.message);
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
