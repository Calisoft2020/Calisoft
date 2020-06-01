<template>
  <section >
    <div class="row" v-if="proyecto.nombre">
        <div class="col-sm-6">
            <div class="panel panel-info">
                <div class="panel-heading text-center text-uppercase">PROYECTO</div>
                <div class="panel-body bg-info">
                    <proyecto-preview :proyecto="proyecto"/>

                    <accion-estado :proyecto="proyecto" 
                        @editar="openEditModal(proyecto)"
                        @propuesta="modals.propuesta = true"
                        @eliminar="modals.eliminar = true"
                        @evaluacion="modals.evaluacion = true"/>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <!-- Integrantes -->
            <div class="row">
                <proyecto-integrantes :integrantes="integrantes" :project-id="proyecto.PK_id"></proyecto-integrantes>
            </div>

            <!-- Evaluadores -->
            <div class="row" v-if="evaluadores.length">
                <proyecto-evaluadores :evaluadores="evaluadores"></proyecto-evaluadores>
            </div>

            <!-- Invitados -->
            <div class="row" v-if="proyecto.state == 'creacion'">
              <proyecto-invitados :invitados="invitados" :proyecto-id="proyecto.PK_id"></proyecto-invitados>
            </div>
        </div>

    </div>
    <p class="text-justify" v-else>
        Todavia no ha creado una propuesta de proyecto,
        puede crearla <a href="/proyectos">Aqui.</a>
    </p>

    <!-- comienzo modal de edicion-->
    <modal v-model="modals.editar" title="Editar Proyecto" :footer="false">
        <proyecto-editar :proyecto="fillProyecto" @update="update"></proyecto-editar>
    </modal>

    <!-- comienzo modal de envio de propuesta -->
    <modal v-model="modals.propuesta" title="Propuesta" :footer="false">
      <p class="text-center">
        Despues de pasar el proyecto como propuesta
        <strong>no podra agregar integrantes ni editar los datos del mismo</strong>.<br>
        ¿Desea pasar el proyecto como propuesta?
      </p>
      <div class="form-group">
        <button class="btn blue center-block" @click="propuesta()">Pasar propuesta de proyecto</button>
      </div>
    </modal>
    
    <!-- Eliminar proyecto -->
    <modal v-model="modals.eliminar" title="Eliminar Proyecto" :footer="false">
        <div class="text-center">
            <p>
                Todas las invitaciones seran canceladas y los integrantes seran liberados. <br/>
                ¿Desea eliminar el proyecto?
            </p>
            <div class="form-group">
                <button class="btn red center-block" @click="destroy()">Eliminar</button>
            </div>
        </div>
    </modal>

    <!-- Modal del Evaluacion -->
    <modal v-model="modals.evaluacion" title="Evaluacion del proyecto" :footer="false">
        <div class="text-center">
            <p>
                <strong>despues de esta operacion no podra realizar 
                cambios en niguno de los archivos de documentacion (codigo fuente, diagramas y Base de datos) 
                del proyecto</strong>. <br>
                Desea empezar la evaluación del proyecto? 
            </p>
            <div class="form-group">
                <button class="btn btn-primary" @click="evaluacion()">Aceptar</button>
            </div>
        </div>
    </modal>

  </section>
</template>

<script>
import { Modal } from "uiv"
import ProyectoIntegrantes from "./proyecto-integrantes";
import ProyectoEvaluadores from "./proyecto-evaluadores";
import ProyectoInvitados from "./proyecto-invitados";
import ProyectoPreview from "./proyecto-preview";
import ProyectoEditar from "./proyecto-editar";
import AccionEstado from "./accion-estado";

export default {
    components: {
        ProyectoIntegrantes,
        ProyectoEvaluadores,
        ProyectoInvitados,
        ProyectoPreview,
        ProyectoEditar,
        AccionEstado,
        Modal
    },
    data(){
        return { 
            proyecto: {},
            fillProyecto:{},
            modals: { editar: false, propuesta: false, eliminar: false, evaluacion: false }
        };
    },
    created(){
        axios.get('/api/user/proyectos').then(res => this.proyecto = res.data[0]);
    },

    computed: {
        integrantes(){
            return this.filtrarUsuario('integrante');
        },
        evaluadores(){
            return this.filtrarUsuario('evaluador');
        },
        invitados(){
            return this.filtrarUsuario('invitado');
        }
    },
    methods: {
        filtrarUsuario(tipo){
            return this.proyecto.usuarios ?
                this.proyecto.usuarios.filter(usuario => usuario.pivot.tipo == tipo) : []
        },
        openEditModal(proyecto){
          this.fillProyecto = Object.assign({}, proyecto);
          this.modals.editar = true;
        },
        update(proyecto){
          this.proyecto = proyecto;
          this.modals.editar = false;
          toastr.info('Datos del proyecto actualizados con exito');
        },
        propuesta(){
          axios.put(`/api/proyectos/${this.proyecto.PK_id}/propuesta`).then(res => {
            this.proyecto = Object.assign({}, this.proyecto, res.data);
            this.modals.propuesta = false;
            toastr.info('Ha pasado el proyecto como propuesta');
          })
        },
        destroy(){
          axios.delete('/api/proyectos/' + this.proyecto.PK_id).then(() => {
            this.proyecto = {};
            this.modals.eliminar = false;
            axios.info('Ha eliminado el proyecto');
          })
        },
        evaluacion(){
          axios.put(`/api/proyectos/${this.proyecto.PK_id}/evaluacion`).then(res => {
            this.proyecto = Object.assign({}, this.proyecto, res.data);
            this.modals.evaluacion = false;
            toastr.info('Ha pasado el proyecto a evaluación');
          })
        },
    }
}
</script>
