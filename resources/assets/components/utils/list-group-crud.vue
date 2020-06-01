<template>
    <section>
    <ul class="list-group text-center" style="">
        <li class="list-group-item list-group-item-info">
            <form class="form-inline text-center" @submit.prevent="store">
                <div class="input-group">
                    <input type="text" class="form-control" v-model="newItem.nombre" pattern="[0-9a-zA-ZáéíóúñÁÉÍÓÚ ,.:-]{2,300}" required>
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-info">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <span v-show="error" class="help-block text-danger">{{ error }}</span>
            </form>
        </li>
        <li class="list-group-item" v-for="item in items" :key="item.PK_id">
            <template v-if="item.PK_id != editable.PK_id">
                <a class="pull-left" @click="selectEditable(item)">
                    <i class="fa fa-edit text-info"></i>
                </a>
                {{ item.nombre }}
                <a class="pull-right">
                    <i class="fa fa-remove text-danger" @click="destroy(item)"></i>
                </a>
            </template>
            <template v-else>
                <form class="form-inline text-center" @submit.prevent="update" >
                    <div class="input-group" >
                        <input type="text" class="form-control" v-model="editable.nombre" pattern="[0-9a-zA-ZáéíóúñÁÉÍÓÚ ,.:-]{2,300}" required
                            v-focus="true">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-info">
                                <i class="fa fa-save"></i>
                            </button>
                        </div>
                    </div>
                    <span v-show="updateError" class="help-block text-danger">{{ updateError }}</span>
                </form>
            </template>
        </li>
    </ul>
    </section>
</template>


<script>
import { focus } from "vue-focus";

export default {
    directives: { focus },

    props: {
        rest: { type: String, required: true }
    },

    data(){
        return { items: [], newItem: {}, error: "", updateError: "", editable: {} }
    },
    created(){
        axios.get(this.rest).then(res => this.items = res.data);
    },
    methods: {
        store(){
            axios.post(this.rest, this.newItem)
                .then(res => {
                    this.items.push(res.data);
                    this.newItem = {};
                    this.error = "";
                })
                .catch(error => this.error = error.response.data.errors.nombre[0]);
        },
        destroy(item){
            axios.delete(this.rest + '/' + item.PK_id)
                .then(() => {
                    this.items = this.items.filter(value => value != item);
                });
        },
        selectEditable(item){
            this.editable = Object.assign({}, item);
        },
        update(){
            axios.put(this.rest + '/' + this.editable.PK_id, this.editable)
                .then(res => {
                    this.items = this.items.map(value => {
                        return value.PK_id == this.editable.PK_id ? this.editable : value;
                    });
                    this.editable = {};
                    this.updateError = "";
                })
                .catch(error => this.updateError = error.response.data.errors.nombre[0]);

        }
    }
}
</script>
