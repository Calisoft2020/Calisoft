import "./bootstrap";
import Vue from "vue";
import PorcentajeCod from "../components/utils/porcentaje-cod";

let vm = new Vue({
    el: '#app',
    components: { PorcentajeCod },
    data: {
        items: [],

    },
    created() {
        axios.get('/api/codificacion')
            .then(response => {
                this.items = response.data;
            });
    },
});