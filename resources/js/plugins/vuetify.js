import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css'

Vue.use(Vuetify)

const opts = {
    themes: {
        light:
        {
            primary: "#08D9D6",
            secondary: "#252A34",
            accent: "#FF2E63",
            error: "#f44336",
            warning: "#ffc107",
            info: "#3f51b5",
            success: "#4caf50"
        }, 
        dark:
        {

        }
    },
}

export default new Vuetify(opts)