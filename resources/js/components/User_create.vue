<template>
    <h1 style="border-bottom: solid 1px   rgba(0, 0, 0, 0.28);">Форма создания пользователя</h1>
    <form action="" method="post">

        <div>
            <input id="firstname"  v-model="firstname"  placeholder="Имя" type="text">
        </div>
        <div>
            <input id="lastname"  v-model="lastname" placeholder="Фамилия" type="text">
        </div>
        <div>
            <input id="patronymic" v-model="patronymic"  placeholder="Отчество" type="text">
        </div>
        <div>
            <div>
                Номер телефона
            </div>
            <select id="id_phone_number"  autocomplete="off"   v-model="id_phone_number" >
                <template  v-for="phone_number in phone_numbers_list">
                    <option v-bind:value="phone_number.id">{{phone_number.number_phone}}</option>
                </template>
            </select>
        </div>
        <div>
            <button @click.prevent="users_create">Сохранить</button>
        </div>
    </form>
</template>

<script>
export default {
    name: "User_create",

    data (){
        return{
            // инициализирует набор данных
            phone_numbers_list: [],
            id_phone_number:null,
            firstname:null,
            lastname:null,
            patronymic:null,
        }
    },
    mounted() {
        this.get_phone_numbers_list();
    },
    methods:{
        get_phone_numbers_list(){
            axios.get("/users/create_view")
                .then(rez => {
                    this.phone_numbers_list = rez.data;
                }).catch(function (){
                alert("Ошибка получения списка");
            });
        },

        users_create(){

            axios.post("/users_create", {
                firstname: this.firstname,
                lastname: this.lastname,
                patronymic: this.patronymic,
                id_phone_number: this.id_phone_number,
            })
                .then(rez=>{
                    console.log(rez);
                    alert(rez.status +" "+ rez.data.message);
                    this.$router.push({ name: 'users_list' })
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
