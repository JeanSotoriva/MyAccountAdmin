<template>
    <div class="row m-2">
        <div class="row pt-10 w-full flex justify-center items-center flex-col row mt-10 border-2 p-10">
            <h2>
                {{ is_edit ? 'Editar Pessoa:' : 'Cadastro de Pessoa' }}
            </h2>
            <br>
            <div class="flex flex-col w-[400px]">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nome</label>
                    <input v-model="user.nome" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">CPF</label>
                    <input v-model="user.cpf" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Data Nascimento</label>
                    <input v-model="user.data_nascimento" type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
            </div>

            <div class="row mt-10 border-2 p-10">
                <div class="mb-3" style="display:flex; ">
                    <label for="exampleInputEmail1" class="form-label mr-5">CEP</label>
                    <input v-model="endereco.cep" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <button @click="buscarCep(endereco.cep)" class="btn btn-outline-primary ml-3" type="button" id="button-addon2">Buscar</button>
                </div>
                <div class="mb-3 flex">
                    <div class="mb-3 flex-grow">    
                        <label for="exampleInputEmail1" class="form-label">Rua</label>
                        <input v-model="endereco.rua" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3 flex-grow ml-4">
                        <label for="exampleInputEmail1" class="form-label">Número</label>
                        <input v-model="endereco.numero" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="flex mt-10">
                    <div class="mb-3 flex-grow">
                        <label for="exampleInputEmail1" class="form-label">Cidade</label>
                        <input v-model="endereco.cidade" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3 flex-grow ml-4">
                        <label for="exampleInputEmail1" class="form-label">Estado</label>
                        <input v-model="endereco.estado" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                </div>
            </div>
            <div style="text-align:left;">
                <button v-if="is_edit" @click="editar(user, endereco)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 inline-block">
                    Editar
                </button>
                <button v-else @click="cadastrar(user, endereco)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 inline-block">
                    Salvar
                </button>
            </div>
            <div class="col-lg-12">
                <div class="row my-4 j1">
                    <div>   
                        <div >
                            <PessoaComponent/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import { mapActions, mapState } from 'vuex';  
import PessoaComponent from '@/components/PessoaComponent.vue'
import '@/assets/css/auth.css'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'

export default {
    components: {
        PessoaComponent,
    },

    computed: {
        ...mapState({
            user: state => state.usuarios.user,
            endereco: state => state.usuarios.endereco,
            is_edit: state => state.usuarios.is_edit,
        }),
    },
    methods: {
        ...mapActions([
            'storeUsuarios',
            'getUsuarios',
            'editUsuarios',
            'getCeps',
        ]),
        cadastrar(user, endereco) {
            if(endereco.cep){ 
                if(!endereco.rua || !endereco.cidade || !endereco.numero || !endereco.estado ){
                    return this.$toast.open({
                        message: 'Preencha os dados do Endereço!',
                        type: 'error',
                        duration: '3000',
                    })
                }
            }       
            this.storeUsuarios({user, endereco})
            .then(response => {
                this.$toast.open({
                    message: response.message,
                    type: response.success ? 'success' : 'error',
                    duration: '3000',
                })
                this.getUsuarios();
            })
        },
        editar(user, endereco) {
        this.editUsuarios(user)
        .then(response => {
            this.$toast.open({
                message: response.message,
                type: response.success ? 'success' : 'error',
                duration: '3000',
            })
            this.getUsuarios();
        })
        },
        buscarCep(cep) {
            this.getCeps(cep)
            .then(response => {
                console.log(response)
                this.$toast.open({
                    message: response.message,
                    type: response.success ? 'success' : 'error',
                    duration: '3000',
                })
                this.getUsuarios();
            })
        }
    },
}
</script>

<style scoped>

</style>