<template>
    <div class="col d-flex justify-content-center">
        <div class=" row m-2 w-[800px]">
            <div class="row pt-10 w-full flex justify-center items-center flex-col row mt-10 border-2 p-10">
                <h2>Cadastro de Movimentações</h2>
                <br>
                <div class="flex flex-col w-[400px]">
                    <div class="mb-3">
                        <label for="pessoaSelect" class="form-label">Pessoa</label>
                        <select v-model="campos.selectedPessoaCpf" id="pessoaSelect" class="form-select">
                            <option v-for="item in usuarios" :key="item.id" :value="item.cpf">{{ item.nome + ' - ' + item.cpf}}</option>
                        </select>
                    </div>
                        <div class="mb-3">
                        <label for="contaSelect" class="form-label">Conta</label>
                        <select v-model="campos.conta" id="contaSelect" class="form-select" @change="getExtratos">
                            <option v-for="item in contas.filter((element)=>{return element.cpf == campos.selectedPessoaCpf})" :key="item.id" :value="item.conta">{{ item.conta + ' - R$ ' + parseFloat(item.saldo).toFixed(2) }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="acao" class="form-label">Ação</label>
                        <select v-model="campos.acao" id="acao" class="form-select">
                            <option value="sacar" >Sacar</option>
                            <option value="depositar" >Depositar</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Valor</label>
                        <input v-model="campos.valor" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="col d-flex justify-content-center">
                        <button @click="cadastrar" class=" w-[200px] bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 inline-block m-1">
                            Salvar
                        </button>
                    </div>

                </div>
                <div class="col-lg-12">
                    <div class="row my-4 j1">
                        <div>   
                            <div >
                                <MovimentacaoComponent/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import { mapActions, mapState } from 'vuex';  
import MovimentacaoComponent from '@/components/MovimentacaoComponent.vue'
import '@/assets/css/auth.css'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'

export default {

    data() {
        return {
            page: 1,
            perPage: 5,
            campos: {
                selectedPessoaCpf: '',
                conta: '',
                acao:'depositar',
                valor: 0,
            }
        };
 
    },

    computed: {
        ...mapState({
            usuarios: state => state.usuarios.usuarios,
            contas: state => state.contas.contas,
        }),
    },

    methods: {
        ...mapActions([
            'getMovimentacoes',
            'storeMovimentacoes',
            'getContas'
        ]),
    
        getExtratos() {
            this.getMovimentacoes({ conta:this.campos.conta })
            .then(response => {console.log(response)})
        },

        cadastrar() {
            if(!this.campos.valor || !this.campos.selectedPessoaCpf || !this.campos.conta){
                return this.$toast.open({
                    message: 'Preencha os dados!',
                    type: 'error',
                    duration: '3000',
                })
            }
            
            this.storeMovimentacoes(this.campos)
            .then(response => {
                this.$toast.open({
                    message: response.message,
                    type: response.success ? 'success' : 'error',
                    duration: '3000',
                })
                this.campos.valor = 0
                this.getExtratos(); 
                this.getContas();
            }) 
        },
    },
    components: {
        MovimentacaoComponent
    },
}
</script>

<style scoped>

</style>
