<template>
    <div>
        <PreloaderComponent />
        <HeaderComponent />
        <div class="container container-body">
            <router-view></router-view>
        </div>
        <FooterComponent />
    </div>
</template>

<script>
    // import 'bootstrap'
    // import 'bootstrap/dist/css/bootstrap.min.css'
    import HeaderComponent from './_partials/header'
    import FooterComponent from './_partials/footer'
    import PreloaderComponent from '../components/Preloader.vue'

    export default {
        components: {
            HeaderComponent,
            FooterComponent,
            PreloaderComponent,
        }
    }
</script>

<style scoped>
    @import url('../assets/css/vuefood.css');
    @import url('../assets/css/reset.css');
    @import url('../assets/css/footer.css');
</style>