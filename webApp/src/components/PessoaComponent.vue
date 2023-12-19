<template>
  <div>
    <h2>Pessoas Cadastradas</h2>

    <table class="table">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Cpf</th>
          <!-- <th>Cidade</th> -->
          <th>Editar</th>
          <th>Deletar</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(usuario, index) in usuarios" :key="index">
          <td>{{ usuario.nome }}</td>
          <td>{{ usuario.cpf }}</td>
          <!-- <td>{{ usuario.cidade }}</td> -->
          <td>
            <button @click="editUser(usuario)" class="edit-button">
              <i class="fas fa-edit"></i>
            </button>
          </td>
          <td>
            <button @click="deleteUser(usuario.cpf)" class="delete-button">
              <i class="fas fa-trash-alt"></i>
            </button>
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
import { mapActions, mapState, mapMutations } from 'vuex';  
import Pagination from 'v-pagination-3';

export default {
  name: 'PessoaComponent',

  data() {
    return {
      page: 1,
      perPage: 5,
    };
  },

  created() {
  },

  mounted() {
    this.getUsuarios()
      .catch(_ => {
        this.$toast.open({
          message: 'falha ao carregar os usuarios',
          type: 'error',
          duration: '3000',
        })
    });
  },

  computed: {
    ...mapState({
      usuarios: state => state.usuarios.usuarios,
      user: state => state.usuarios.user,
    }),  
  },

  methods: {
    ...mapActions([
      'getUsuarios',
      'deleteUsuarios'
    ]),
    ...mapMutations([
      'SET_EDIT_USER',
    ]),
    deleteUser(userCpf) {
      this.deleteUsuarios({ cpf:userCpf })
      .then(response => {
        this.$toast.open({
          message: response.message,
          type: response.success ? 'success' : 'error',
          duration: '3000',
        })
        this.getUsuarios();
      })
    },
    editUser(usuario) {
      this.SET_EDIT_USER(usuario)
    },
    displayedRecords() {
      const startIndex = this.perPage * (this.page - 1);
      const endIndex = startIndex + this.perPage;
      return this.usuarios.slice(startIndex, endIndex);
    }
  },

  components: {
    Pagination
  },

};
</script>

<style scooped>
</style>