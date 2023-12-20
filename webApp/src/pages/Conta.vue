<template>
    <div class="row m-2">
        <div class="row pt-10 w-full flex justify-center items-center flex-col row mt-10 border-2 p-10">
            <h2>Cadastro de Conta</h2>
            <ul></ul>
            <div class="flex flex-col w-[400px]">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Cpf</label>
                    <input v-model="campos.cpf" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Numero da Conta</label>
                    <input v-model="campos.conta" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="col d-flex justify-content-center">
                    <button @click="cadastrar" class="w-[300px] bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 inline-block m-5">
                        Salvar
                    </button>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row my-4 j1">
                    <div>   
                        <div >
                            <ContaComponent/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import { mapActions, mapState } from 'vuex';  
import ContaComponent from '@/components/ContaComponent.vue'
import '@/assets/css/auth.css'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'

export default {

    data() {
        return {
            campos: {
                cpf: '',
                conta: ''
            }
        }
    },
    
    components: {
        ContaComponent
    },

    computed: {
        ...mapState({
            conta: state => state.contas,
      }),
    },

    methods: {
        ...mapActions([
            'storeContas',
            'getContas',
        ]),
        cadastrar() {
            this.storeContas(this.campos)
            .then(response => {
                this.$toast.open({
                    message: response.message,
                    type: response.success ? 'success' : 'error',
                    duration: '3000',
                })
                this.getContas();
            })
        }
    }
}
</script>

<style scoped>

</style>
