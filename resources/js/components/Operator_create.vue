<template>
    <h1 style="border-bottom: solid 1px   rgba(0, 0, 0, 0.28);">Форма создания оператора</h1>
    <form action="" method="post">

        <div>
            <input id="name" v-model="name" placeholder="Название" type="text">
        </div>
        <div>
            <button  @click.prevent="operator_create" >Сохранить</button>
        </div>
    </form>
</template>

<script>
export default {
    name: "Operator_create",


    data (){
        return{
            // инициализирует набор данных
            name:null,
        }
    },

    methods:{


        operator_create(){

            axios.post("/operators/create", {
                name: this.name
            })
                .then(rez=>{
                    console.log(rez);
                    alert(rez.status +" "+ rez.data.message);
                    this.$router.push({ name: 'operators_list' })
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
