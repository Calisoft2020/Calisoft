import "./bootstrap";
import Vue from "vue";
import Modal from "../components/utils/modal";
import CategoryList from "../components/utils/category-list";


let vm = new Vue({
    el: '#app',
    components: { Modal, CategoryList },
    data: {
        categorias: [],

    },
    created() {
        axios.get('/api/categorias')
            .then(response => {
                this.categorias = response.data;
            });
    },
});