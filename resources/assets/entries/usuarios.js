import "./bootstrap";
import Vue from "vue";
import { Pagination, Modal } from "uiv";
import Validate from "../plugins/Validate"
import UserForm from "../components/admin/UserForm"
import Paginator from '../classes/paginator';
import VeeValidate, { Validator } from 'vee-validate'
import Search from '../mixins/Search'

Vue.use(Validate);
new Vue({
    el: '#app',
    mixins: [Search],
    components: { Modal, Pagination, UserForm },
    data() {
        return {
            usuarios: [],
            deleteUser: {},
            paginator: new Paginator(),
            search: "",
            modal: false,
            deleteModal: false
        }
    },
    created() {
        axios.get('/api/usuarios').then(response => {
            this.usuarios = this.paginator.data = response.data;
        });
    },
    methods: {
        add(usuario) {
            this.usuarios.push(usuario);
            this.paginator.data = this.usuarios;
            this.modal = false
            toastr.success('Usuario Creado Correctamente');
        },
        openDeleteModal(user) {
            this.deleteUser = user;
            this.deleteModal = true;
        },
        destroy(user) {
            axios.delete('/api/usuarios/' + user.PK_id)
                .then(() => {
                    this.usuarios = this.paginator.data = this.usuarios.filter(value => value != user);
                    this.deleteModal = false;
                    toastr.info('Usuario Eliminado Correctamente');
                });
        },
    },

    watch: {
        search(query) {
            this.paginator.data = this.searchBy(this.usuarios, query, 'name', 'email', 'role')
        }
    },





});