<template>
    <h1 style="border-bottom: solid 1px   rgba(0, 0, 0, 0.28);">Цены оператора  {{this_operator.name}}</h1>

    <div v-for="operator_price in operators_price_list">

            <div style="display: grid;   grid-template-columns:   1fr  1fr   200px; border-bottom: solid 1px #bbb; padding-bottom: 10px; padding-top: 10px;">
                <div>
                    <input id="id_to_operator" type="hidden"  v-model="operator_price.id">
                    {{operator_price.name}}
                </div>
                <div>

                    <input placeholder="Цена за минуту" type="text" id="price"  v-model="operator_price.price"> (р/минута)
                </div>
                <div style="text-align: right;">
                    <button @click.prevent="save_price_list(operator_price.id)">Сохранить</button>
                </div>
            </div>

    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Operator_price_list",

    data (){
        return{
            // инициализирует набор данных
            this_operator:[],
            operators_price_list:[],
        }
    },
    mounted() {
         this.$route.params.id
         this.get_price_list();
    },
    methods:{
        get_price_list(){
            axios.get("/operator/"+this.$route.params.id+"/price")
                .then(rez => {

                    this.this_operator = rez.data.this_operator;
                    this.operators_price_list = rez.data.operators_price_list;

                }).catch(function (){
                    alert("Ошибка получения списка");
            });
        },

        save_price_list(to_operator_price_id){

            let this_price = null;
            this.operators_price_list.forEach(function (operator) {
                console.log(operator.id , to_operator_price_id)
                if(operator.id == to_operator_price_id){
                    this_price = operator.price;
                    return false;
                }
            });


            // this.$route.params.id

            axios.post("/operator/save_price", {
                id_from_operator : this.$route.params.id,
                id_to_operator : to_operator_price_id,
                price : this_price,
                })
                .then(rez=>{
                    console.log(rez);
                    alert(rez.status +" "+ rez.data.message);
                    this.$router.push({ name: 'operators_list' })
                }).catch(function (error){
                console.error(error);
                alert( error.response.status + " "+ error.response.data.message);
            });
        },

    }
}
</script>

<style scoped>

</style>
