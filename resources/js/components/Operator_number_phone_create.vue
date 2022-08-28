<template>
    <h1 style="border-bottom: solid 1px   rgba(0, 0, 0, 0.28);">Форма создания номера телефона для оператора {{this_operator.name}}</h1>
    <form action="" method="post">
        <div>
            <input id="number_phone" v-model="number_phone" placeholder="Номер телефона" type="text" >
        </div>
        <div>
            <button @click.prevent="operator_number_phone_create">Сохранить</button>
        </div>
    </form>
</template>

<script>
export default {
    name: "Operator_number_phone_create",


    data (){
        return{
            // инициализирует набор данных
            number_phone:null,
            this_operator:[],
        }
    },
    mounted() {
        this.$route.params.id;

        this.get_this_operator();
    },
    methods:{
        get_this_operator() {
            axios.get("/operator/" + this.$route.params.id + "/phone_number/create_view")
                .then(rez => {
                    this.this_operator = rez.data;
                }).catch(function () {
                alert("Ошибка получения списка");
            });
        },

        operator_number_phone_create(){

            axios.post("/operator/phone_number/create", {
                id_operator: this.$route.params.id,
                number_phone: this.number_phone,
                })
                .then(rez=>{
                    console.log(rez);
                    alert(rez.status +" "+ rez.data.message);
                   this.$router.push({ name: 'operator_phone_numbers_list', 'params':{'id':this.$route.params.id} })
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
