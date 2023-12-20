<template>
    <div class="grid grid-cols-2 gap-4 mt-20" style="background-color: ;">
        <router-link to="/pessoa" class="rounded-lg overflow-hidden shadow-lg bg-white">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">Pagina Pessoas</h3>
                <p>- Cadastro de pessoa</p>
                <p>- Edição de pessoa</p>
                <p>- Exclusão de pessoa</p>
                <p>- Listagem de pessoas</p>
            </div>
        </router-link>
      
        <router-link to="conta" class="rounded-lg overflow-hidden shadow-lg bg-white ">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">Pagina Contas</h3>
                <p>- Cadastro de nova Conta</p>
                <p>- Listagem de todas as contas</p>
                <p>- Listagem dos saldos das constas</p>    
            </div>
        </router-link>
  
        <router-link to="movimentacao" class="rounded-lg overflow-hidden shadow-lg bg-white">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">Pagina Movimentações</h3>
                <p>- Listagem das movimentações do cliente</p>
                <p>- Ação de depositar na conta do cliente</p>
                <p>- Ação de sacar na conta do cliente</p> 
                <p>- Outras informações</p> 
            </div>
        </router-link>

        <div class="p-4 rounded-lg overflow-hidden shadow-lg bg-white ">
            <h3 class="text-lg font-semibold mb-2">Informações</h3>
            <p>Cadastro de Cep via Postman</p>
            <p>Busca de Cep</p>
            <p>Outras informações</p>
        </div>
    </div>
  </template>