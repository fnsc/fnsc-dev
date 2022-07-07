import { createApp } from "vue";
const Vue = createApp({})

/** Components */
import Container from "../components/home/Container"
import Header from "../components/home/Header"
import Footer from "../components/home/Footer"

Vue.component('container-component', Container)
Vue.component('header-component', Header)
Vue.component('footer-component', Footer)
/** Components */

Vue.mount('#app')
