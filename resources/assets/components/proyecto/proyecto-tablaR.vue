<template>
    <div class="panel">
        <div class="panel-heading text-center text-uppercase" :class="{ 'bg-grey bg-font-grey': completado, 'bg-grey-cararra bg-font-rey-cararra': completado }">
            PROYECTO
        </div>
        <div class="panel-body" :class="{ 'bg-grey': completado, 'bg-grey-cararra': completado }">
            <table class="table table-condensed borderless">
                <tbody>
                    <tr>
                        <th>Nombre:</th>
                        <td>{{ proyecto.nombre }}</td>
                    </tr>
                    <tr>
                        <th>Integrantes:</th>
                        <td>
                            <span class="badge badge-info" v-for="integrante in integrantes" :key="integrante.PK_id" style="margin-right: 1%">
                                {{ integrante.name }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Estado:</th>
                        <td class="text-uppercase">{{ proyecto.state }}</td>
                    </tr>
                    <tr>
                        <th>Categoria:</th>
                        <td>{{ proyecto.categoria.nombre }}</td>
                    </tr>
                    <tr>
                        <th>Semillero</th>
                        <td>{{ proyecto.semillero.nombre }}</td>
                    </tr>
                    <tr>
                        <th>Grupo de investigación:</th>
                        <td>{{ proyecto.grupo_de_investigacion.nombre }}</td>
                    </tr>
                    <tr>
                        <th>Creado el:</th>
                        <td>{{ new Date(proyecto.created_at).toLocaleDateString() }}</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</template>

<script>
import { Modal } from 'uiv';
import UserSearch from '../utils/user-search'
import UsersMixin from '../mixins/proyecto-users'
import EstadosMixin from '../mixins/proyecto-estados'
export default {
    components: { Modal, UserSearch },
    mixins: [UsersMixin, EstadosMixin],
    props: ['proyecto'],
    data() {
        return { asignedModal: false, destroyModal: false, acceptModal: false, formErrors: {}, text: "" }
    },
    methods: {
        
        aceptar() {
            axios.put(`/api/proyectos/${this.proyecto.PK_id}/aceptar`).then(res => {
                this.acceptModal = false
                toastr.success('Ha Aceptado la propuesta del proyecto ' + this.proyecto.nombre);
                this.$emit('updated', Object.assign({}, this.proyecto, res.data));
            });
        },
        asignar(user) {
            axios.put(`/api/proyectos/${this.proyecto.PK_id}/asignar`, { user_id: user.PK_id })
                .then(res => {
                    this.$emit('updated', Object.assign({}, this.proyecto, {
                        usuarios: res.data
                    }));
                    toastr.info(`El evaluador ${user.name} ha sido asignado a ${this.proyecto.nombre}`);
                    this.asignedModal = false
                })
        },
        desasignar(evaluador) {
            axios.put(`/api/proyectos/${this.proyecto.PK_id}/desasignar`, { user_id: evaluador.PK_id })
                .then(res => {
                    this.$emit('updated', Object.assign({}, this.proyecto, {
                        usuarios: res.data
                    }));
                    toastr.info(`El evaluador ${evaluador.name} ha sido desasignado de ${this.proyecto.nombre}`);
                    this.asignedModal = false
                })
        },
        eliminar() {
            axios.delete('/api/proyectos/' + this.proyecto.PK_id, { params: { text: this.text } }).then(() => {
                this.destroyModal = false
                toastr.info('Ha eliminado del proyecto ' + this.proyecto.nombre);
                this.$emit('removed', this.proyecto)
            }).catch(err => this.formErrors = err.response.data.errors);
        }
    }
}
</script>

<style scoped>
.borderless td,
.borderless th {
    border: none;
}
</style>
