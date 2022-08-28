<template>
    <h1 style="border-bottom: solid 1px   rgba(0, 0, 0, 0.28);">Список всех операторов</h1>

    <div style="text-align: right; padding: 10px 0px;" >
        <router-link :to="{name:'operator_create'}">Создать оператора</router-link>
    </div>
    <div v-for="operator in list_operators">
        <div style="display: grid;   grid-template-columns: 1fr 200px 200px; border-bottom: solid 1px #bbb; padding-bottom: 10px; padding-top: 10px;">
            <div>
                {{operator.name}}
            </div>
            <div>
                <router-link :to="{name:'operator_price_list', 'params': { 'id' : operator.id }}">Тарифная сетка</router-link>
            </div>
            <div>
                <router-link :to="{name:'operator_phone_numbers_list', 'params': { 'id' : operator.id }}">Номера телефонов</router-link>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "Operators",

    data (){
        return{
            // инициализирует набор данных
            list_operators:[],
        }
    },
    mounted() {
        this.get_list_operators();
    },
    methods:{
        get_list_operators(){
            axios.get("/operators_list")
                .then(rez => {
                    this.list_operators = rez.data;
                }).catch(function (){
                alert("Ошибка получения списка");
            });
        },

    }
}
</script>

<style scoped>

</style>
