<template>
    <div>
      <h2>Movimentações</h2>
      <table class="table">
        <thead>
          <tr>
            <th>Data</th>
            <th>Valor</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in extratos" :key="index">
            <td>{{ item.data }}</td>
            <td>
                <span :class="{'text-[red]': item.valor < 0}">
                    R$ {{ parseFloat(item.valor).toFixed(2) }}
                </span>
            </td>
          </tr>
        </tbody>
      </table>
      <Pagination
        v-model="page"
        :records="10"     
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
                perPage: 5              
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
                usuarios: state => state.usuarios.usuarios,
                extratos: state => state.contas.extratos,
            }),
        },
  
        methods: {
            ...mapActions([
                'getUsuarios',
                'getContas',
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
        },

        created() {
            this.getUsuarios();
            this.getContas();
        },

        components: {
        Pagination,
    },
    
}
</script>