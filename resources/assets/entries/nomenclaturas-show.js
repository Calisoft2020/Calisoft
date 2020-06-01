import "./bootstrap";
import Vue from "vue";
import Modal from "../components/utils/modal";
import Porcentajebd from "../components/utils/porcentajebd";

let vm = new Vue({
    el: '#app',
    components: { Modal, Porcentajebd },
    data: {
        componentes: [],

    },
    created() {
        axios.get('/api/basedatos')
        .then(response => {
          this.componentes = response.data;
        });
    },
});