import './bootstrap';
import Vue from 'vue';
import axios from 'axios';
import { Modal, Popover } from "uiv";
import TextInput from "../components/inputs/text-input";
import BsSwitch from '../components/bs/bs-switch';
import SelectInput from "../components/inputs/select-input";
import TextareaInput from "../components/inputs/textarea-input";
import TestList from "../components/plataforma/test-list"
import TblCaso from "../components/plataforma/tbl-caso"

new Vue({
    el: '#app',
    components: {
        Modal,
        BsSwitch,
        TextInput,
        TextareaInput,
        SelectInput,
        Popover,
        TestList,
        TblCaso
    },
    data() {
        return {
            casoPrueba: [],
            casoUpdate: {},
            json: {},
            tiposInputs: {},
            newCasoPrueba: {},
            fillCasoPrueba: this.schema(),
            formErrors: {},
            formErrorsUpdate: {},
            proyectoId: window.proyectoId,
            enviarModalState: false,
            showPruebas: false,
            selected: {},
            dia: {},
        }
    },
    created() {
        axios.get(`/api/proyectos/${window.proyectoId}/plataforma`)
            .then(res => this.casoPrueba = res.data);
        axios.get(`api/tiposInputs`)
            .then(res => this.tiposInputs = res.data);

        // Obtener el día de hoy.
        var dt = new Date();
        var m = dt.getMonth() + 1;
        var d = dt.getDate();
        var y = dt.getFullYear();

        if (m < 10 && d >= 10) {
            this.dia = y + '-0' + m + '-' + d;
        }
        if (d < 10 && m >= 10) {
            this.dia = y + '-' + m + '-0' + d;
        }
        if (m < 10 && d < 10) {
            this.dia = y + '-0' + m + '-0' + d;
        }
        if (m >= 10 && d >= 10) {
            this.dia = y + '-' + m + '-' + d;
        }

        // FIN Obtener el día de hoy.                
    },
    methods: {
        schema() {
            return {
                formulario: "",
                observacion: "",
                PK_id: "",
                testInput: []

            }
        },
        cerrarModalEnv() {
            this.fillCasoPrueba = this.schema();
            this.casoPrueba.formulario = "";

        },
        update(caso) {

            axios.post('/api/enviarCasoPrueba/' + this.fillCasoPrueba.PK_id, this.fillCasoPrueba)
                .then(response => {
                    this.formUpdateErrors = {};
                    this.casoPrueba = this.casoPrueba.map(value => {
                        return value.PK_id == caso.PK_id ? caso : value;
                    });
                    this.enviarModalState = false;
                    toastr.info('Caso prueba subido correctamente');
                })
                .catch(error => this.formErrorsUpdate = error.response.data.errors);

        },
        cadenaJson(json, caso) {
            if (this.IsJsonString(json) == false) {
                this.formErrorsUpdate.formulario = 'El texto introducido no corresponde a un Json'
                toastr.error('El texto introducido no corresponde a un Json');
            } else {
                caso.formulario = this.fillCasoPrueba.formulario;
                this.fillCasoPrueba = caso;
                this.json = JSON.parse(json);
                this.enviarModalState = true;
                this.fillCasoPrueba.testInput = new Array(this.json.length);
            }
        },
        IsJsonString(str) {
            try {
                JSON.parse(str);
            } catch (e) {
                return false;
            }
            return true;
        }
    }
});