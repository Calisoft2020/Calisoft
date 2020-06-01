import './bootstrap';
import Vue from 'vue';
import axios from 'axios';
import TextInput from "../components/inputs/text-input";
import Modal from "../components/utils/modal";
import BsSwitch from '../components/bs/bs-switch';
import SelectInput from "../components/inputs/select-input";
import TextareaInput from "../components/inputs/textarea-input";
import { Popover } from "uiv";

new Vue({
    el: '#app',
    components: {
        Modal,
        BsSwitch, 
        TextInput,
        TextareaInput, 
        SelectInput,
        Popover 
    },
    data() {
        return {
            casoPrueba: [],
            newCasoPrueba: this.schema(),
            formErrors: {},
            formErrorsUpdate: {},
            proyectoId: window.proyectoId,
            modalState: false,
            selected: {},
            dia: {},
        }
    },
    created() {
        this.fetch()

        // Obtener el día de hoy.
        var dt = new Date();
        var m = dt.getMonth()+1;
        var d = dt.getDate();
        var y = dt.getFullYear();

        if (m<10 && d>=10){
            this.dia = y +'-0'+ m + '-' + d;
        }
        if(d<10 && m>=10){
            this.dia = y +'-'+ m + '-0' + d;
        }
        if(m<10 && d<10){
            this.dia = y +'-0'+ m + '-0' + d;
        }
        if(m>=10 && d>=10){
            this.dia = y +'-'+ m + '-' + d;
        }

        // FIN Obtener el día de hoy.
                
    },
    methods: {
        schema(){
            return {
                limite: "",
                nombre: "",
                prioridad: "",
                proposito:"",
                alcance:"",
                criterios:"",
                resultado_esperado: "",

            }
        },
        store() {
            this.newCasoPrueba.FK_ProyectoId = this.proyectoId;
            axios.post('/api/casoPrueba', this.newCasoPrueba)
                .then(response => {
                    this.fetch();
                    this.formErrors = {};
                    this.newCasoPrueba = {};
                    $("#crear-caso").modal("hide");
                    toastr.success('Caso Prueba Creado Correctamente');
                })
                .catch(error => this.formErrors = error.response.data.errors);
        },
        destroy(caso) {
            axios.delete('/api/casoPrueba/' + caso.PK_id).then(() => {
                this.casoPrueba = this.casoPrueba.filter(value => value != caso);
                toastr.info('Caso prueba eliminado correctamente');
            });
        },
        fetch() {
            axios.get(`/api/proyectos/${window.proyectoId}/plataforma`)
                .then(res => this.casoPrueba = res.data);
        }
    }
})