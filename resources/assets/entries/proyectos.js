import "./bootstrap";
import Vue from "vue";
import ProyectoVista from "../components/proyecto/proyecto-vista";
new Vue({
    el: '#app',
    render: h => h(ProyectoVista)
});
