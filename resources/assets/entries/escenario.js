import './bootstrap';
import Vue from 'vue';
import axios from 'axios';
import { Modal, Popover } from "uiv";

import TextInput from "../components/inputs/text-input";
import BsSwitch from '../components/bs/bs-switch';
import SelectInput from "../components/inputs/select-input";
import TextareaInput from "../components/inputs/textarea-input";
import Validate from "../plugins/Validate"
import inputList from '../components/plataforma/input-list';

Vue.use(Validate);
new Vue({
    el: '#app',
    components: {
        Modal,
        BsSwitch,
        TextInput,
        TextareaInput,
        SelectInput,
        Popover,
        inputList
    },
    data() {
        return {

            json: [],
            test: {},
            prueba: {},
            formErrors: {},
            formErrorsUpdate: {},
            casoPruebaId: window.casoPruebaId,
        }
    },

    created() {
        this.refresh();


    },
    methods: {
        refresh() {

            axios.get(`/api/casoPrueba/${window.casoPruebaId}`)
                .then(res => this.json = res.data);
            axios.get(`/pruebasCasoPrueba/${window.casoPruebaId}`)
                .then(res => this.totales = res.data);
        },
        store() {
            //prueba[text] = test[1];
            console.log(this.test[3]);

            for (var i = 0; i < this.json.length; i++) {

                this.prueba[i] = this.test[this.json[i]['testInput']];
                console.log(this.json[i]['type']);

            }
            console.log(this.prueba);
            this.refresh();
            axios.post('/api/testing', this.test)
                .then(response => {
                    this.test.push(response.data);
                    this.formErrors = {};
                    this.test = {};
                    this.totales = this.totales + 1;
                    this.refresh();
                    toastr.success('primera prueba');

                })
                .catch(error => this.formErrors = error.response.data.errors);

        }

    }
});