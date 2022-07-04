import { createApp } from "vue";
const Vue = createApp({})

import HelloWorld from "../components/HelloWorld"

Vue.component('hello-world', HelloWorld)
Vue.mount('#app')
