<template>
  <div>
    <h2>Lista de Contas</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Nome</th>
          <th>CPF</th>
          <th>Numero da Conta</th>
          <th>Editar</th>
          <th>Excluir</th>
        </tr>
      </thead>
      <tbody>
        <tr  v-for="(conta, index) in displayedRecords()" :key="index">
          <td>{{ conta.nome }}</td>
          <td>{{ conta.cpf }}</td>
          <td>{{ conta.conta }}</td>
          <td>
            <button @click="editConta(conta.conta)" class="edit-button">
              <i class="fas fa-edit"></i>
            </button>
          </td>
          <td>
            <button @click="deleteConta(conta.conta)" class="delete-button">
              <i class="fas fa-trash-alt"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <Pagination
      v-model="page"
      :records="contas.length"     
      :per-page="perPage"  
      @paginate="handlePagination"
    />
  </div>
</template>

<script>
  import { mapActions, mapMutations, mapState } from 'vuex'
  import Pagination from 'v-pagination-3';
  import '@/assets/css/auth.css'
  import 'bootstrap'
  import 'bootstrap/dist/css/bootstrap.min.css'

  export default {
    
    name: 'ContaComponent',

    data() {
      return {
        page: 1,
        perPage: 5,
      };
    },

    created() {
    },

    mounted(){
      this.getContas()
        .catch(_ => {
          this.$toast.open({
            message: 'falha ao carregar contas',
            type: 'error',
            duration: '3000',
          })
      })
    },

    computed: {
      ...mapState({
        contas: state => state.contas.contas,
      }),
    },

    methods: {

      ...mapActions([
        'getContas',
        'deleteContas'
      ]),
      
      deleteConta(numConta) {
        this.deleteContas({ conta:numConta })
        .then(response => {
          this.$toast.open({
              message: 'Conta excluída com sucesso',
              type: 'success',
              duration: '3000',
          })
          this.getContas();
        })
      },
      displayedRecords() {
        console.log(this.contas)
        const startIndex = this.perPage * (this.page - 1);
        const endIndex = startIndex + this.perPage;
        try {
          return this.contas.slice(startIndex, endIndex);
        } catch (error) {
          return this.contas
        } 
        
      }
    },

    components: {
      Pagination,
    },
  
}
</script>