import "./bootstrap";
import Vue from "vue";
import VueCodeMirror from 'vue-codemirror';
import { Modal } from "uiv";
import BsSelect from "../components/bs/bs-select";

Vue.use(VueCodeMirror);

new Vue({
    el: "#app",
    components: { Modal, BsSelect },
    data: {
        sqls: [],
        modalState: false,
        deleteModalState: false,
        eliminarSql: {},
        prevSql: {},
        prevModal: false,
        codeOptions: {
            lineNumbers: true,
            mode: 'text/x-sql',
            readOnly: true,
            theme: 'eclipse'
        }
    },
    created() {
        this.refresh();
    },
    methods: {
        refresh() {
            axios.get('/api/sql')
                .then(response => this.sqls = response.data);
        },
        destroy(sql) {
            axios.delete('/api/sql/' + sql.PK_id)
                .then(() => {
                    this.sqls = this.sqls.filter(value => value != sql);
                    this.deleteModalState = false;
                    toastr.success('Documento Eliminado Correctamente');
                });
        },
        openDeleteModal(sql) {
            this.eliminarSql = sql;
            this.deleteModalState = true;
        },
        closeDeleteModal() {
            this.deleteModalState = false;
        },
        preview(sql) {
            if (sql.code) {
                this.prevSql = sql;
                this.prevModal = true;
            } else {
                axios.post('/api/sql/preview/' + sql.url).then(res => {
                    sql.code = res.data.code;
                    this.prevSql = sql;
                    this.prevModal = true;
                });
            }
        }
    },
});