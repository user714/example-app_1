<template>
    <h1 style="border-bottom: solid 1px   rgba(0, 0, 0, 0.28);">Номера телефонов оператора {{this_operator.name}}</h1>
    <div style="text-align: right; padding: 10px 0px;" >

        <router-link :to="{name:'operator_create_number_phone', 'params': { 'id' :  $route.params.id}}">Добавить новый номер</router-link>
    </div>

    <div v-for="phone_number in phone_numbers_list">

        <div style=" border-bottom: solid 1px #bbb; padding-bottom: 10px; padding-top: 10px;">
            {{phone_number.number_phone}}
        </div>
    </div>

</template>

<script>
export default {
    name: "Operator_phone_numbers_list",

    data (){
        return{
            // инициализирует набор данных
            phone_numbers_list:[],
            this_operator:[],
        }
    },
    mounted() {
        this.$route.params.id;
        this.get_list_operators();
    },
    methods:{
        get_list_operators(){
            axios.get("/operator/"+ this.$route.params.id+"/phone_number")
                .then(rez => {
                    this.phone_numbers_list = rez.data.phone_numbers_list;
                    this.this_operator = rez.data.this_operator;

                }).catch(function (){
                alert("Ошибка получения списка");
            });
        },

    }
}
</script>

<style scoped>

</style>
