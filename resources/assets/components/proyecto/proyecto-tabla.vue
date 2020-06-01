<template>
    <div class="panel">
        <div class="panel-heading text-center text-uppercase" :class="{ 'bg-grey bg-font-grey': propuesta, 'bg-grey-cararra bg-font-rey-cararra': activo }">
            PROYECTO
        </div>
        <div class="panel-body" :class="{ 'bg-grey': propuesta, 'bg-grey-cararra': activo }">
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
                    <tr v-if="evaluadores.length">
                        <th>Evaluadores:</th>
                        <td>
                            <span class="badge badge-info" v-for="evaluador in evaluadores" :key="evaluador.PK_id" style="margin-right: 1%">
                                {{ evaluador.name }}
                                <a @click.prevent="desasignar(evaluador)" class="fa fa-close text-danger"></a>
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

            <div class="btn-group btn-group-justified">
                <template v-if="propuesta">
                    <a class="btn blue btn-sm" @click.prevent="acceptModal = true">Aceptar Proyecto</a>
                    <a class="btn red btn-sm" @click.prevent="destroyModal = true">Eliminar</a>
                </template>
                <template v-if="activo || evaluacion">
                    <a class="btn blue btn-sm" @click.prevent="asignedModal = true">Asignar Evaluador</a>
                </template>
            </div>

        </div>

        <modal v-model="acceptModal" title="Aceptar propuesta" :footer="false">
            <p class="text-center">
                ¿Desea aprobar la propuesta de proyecto {{ proyecto.nombre }}?
                <br>
                <strong>Despues de esta acción no se podra eliminar el proyecto</strong>
            </p>
            <div class="form-group">
                <button class="btn blue center-block" @click="aceptar()">Aceptar propuesta de proyecto</button>
            </div>
        </modal>

        <modal v-model="destroyModal" title="Eliminar Proyecto" :footer="false">
            <p class="text-center">
                ¿Está seguro de eliminar el proyecto <strong>{{ proyecto.nombre }}</strong>?

                <div class="form-group col-sm-12">
                    <label for="text">Razón</label>
                    <textarea name="text" class="form-control" v-model="text" maxlength="200" required style="resize: none" rows="3">
                    </textarea>
                    <span v-if="formErrors['text']" class="error text-danger">
                        @{{formErrors.text[0]}}
                    </span>
                </div>

                <div class="form-group">
                    <button class="btn red center-block" @click="eliminar()">Eliminar</button>
                </div>
            
        </modal>

        <modal v-model="asignedModal" title="Asignar Evaluador" :footer="false">
            <user-search url="/api/evaluator/search" button-text="Asignar" @selected="asignar">
                <template slot="extra" slot-scope="props">
                    <span class="badge" v-show="props.user.proyectos_count">
                        {{ props.user.proyectos_count }}
                    </span>
                </template>
            </user-search>
        </modal>

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
