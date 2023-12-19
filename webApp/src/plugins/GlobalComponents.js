import { createApp } from 'vue';
import PreloaderComponent from '@/components/Preloader.vue'

const app = createApp({});
app.component('preloader-component', PreloaderComponent);

export default app;