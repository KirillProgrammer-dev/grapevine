import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css'

Vue.use(Vuetify)

const opts = {
    themes: {
        light:
        {
            primary: "#2196f3",
            secondary: "#009688",
            accent: "#ff5722",
            error: "#f44336",
            warning: "#ffc107",
            info: "#3f51b5",
            success: "#4caf50"
        }
    },
}

export default new Vuetify(opts)