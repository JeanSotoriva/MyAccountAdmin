<template>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-vuefood">   
      <div class="default">
        <router-link :to="{name: 'home'}" class="navbar-brand newColor"><span> Home</span></router-link>
        <router-link :to="{name: 'conta'}" class="navbar-brand newColor"><span> Conta</span></router-link>
        <router-link :to="{name: 'pessoa'}" class="navbar-brand newColor"><span> Pessoa</span></router-link>
        <router-link :to="{name: 'movimentacao'}" class="navbar-brand newColor"><span> Movimentações</span></router-link>
      </div>
    </nav>
  </header>
</template>


<script>
  import { mapState, mapActions } from 'vuex'

export default {
  name: 'header',

  computed: {
  },

  methods: {
  },
}
</script>

<style scoped>
  @import url('@/assets/css/default.css');
</style>