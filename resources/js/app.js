import './bootstrap';
import '../css/app.css';
import '@mdi/font/css/materialdesignicons.css';
import '@fortawesome/fontawesome-free/css/all.css';
import 'vuetify/styles';
import "vue-toastification/dist/index.css";
import Toast, { POSITION } from "vue-toastification";
import { createApp, h } from 'vue';
import { createVuetify } from 'vuetify';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { aliases, fa } from 'vuetify/iconsets/fa';
import { mdi } from 'vuetify/iconsets/mdi';
// import * as components from "vuetify/components";
// import * as directives from "vuetify/directives";
const vuetify = createVuetify({
    theme: {
        defaultTheme: "dark"
    },
    icons: {
        defaultSet: 'fa',
        aliases,
        sets: {
            fa,
            mdi
        }
    }
});

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async (name) => await resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        let apps = createApp({ render: () => h(app, props) });
        apps.use(vuetify)
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(Toast, {
                position: POSITION.TOP_RIGHT,
                timeout:1000
            })
            .mount(el);
        return apps;
    },
});

InertiaProgress.init({ color: '#BB86FC' });