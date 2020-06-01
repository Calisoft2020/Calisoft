<template>
  <form @submit.prevent="update()">
    <div class="form-group form-md-line-input" :class="{'has-error': errors.nombre }">
        <div class="input-icon">
          <i class="fa fa-cubes"></i>
          <input type="text" required="" placeholder="Nombre Del Proyecto" class="form-control" v-model="proyectoEdit.nombre" maxlength="30"/>
          <label class="help-block" v-if="errors.nombre">
            {{ errors.nombre.join() }}
          </label>
        </div>
    </div>
    <div class="form-group form-md-line-input">
        <div class="input-icon">
            <i class="fa fa-users"></i>
            <label>Categoria</label>
            <select class="form-control" required v-model="proyectoEdit.FK_CategoriaId">
                <option v-for="categoria in categorias" :value="categoria.PK_id">
                  {{ categoria.nombre }}
                </option>
            </select>
        </div>
    </div>
    <div class="form-group form-md-line-input">
        <div class="input-icon">
            <i class="fa fa-users"></i>
            <label>Semillero</label>
            <select class="form-control" required v-model="proyectoEdit.FK_SemilleroId">
                <option v-for="semillero in semilleros" :value="semillero.PK_id">
                  {{ semillero.nombre }}
                </option>
            </select>
        </div>
    </div>
     <div class="form-group form-md-line-input">
        <div class="input-icon">
            <i class="fa fa-users"></i>
            <label>Grupo de investigación</label>
            <select class="form-control" required v-model="proyectoEdit.FK_GrupoDeInvestigacionId">
                <option v-for="grupo in grupos" :value="grupo.PK_id">
                  {{ grupo.nombre }}
                </option>
            </select>
        </div>
    </div>
    <div class="form-group">
      <button  type="submit" class="btn blue center-block">Guardar</button>
    </div>
  </form>
</template>
<script>

export default{
    props:["proyecto"],
    data() {
      return {
        categorias: [],
        semilleros: [],
        grupos: [],
        errors: {},
        proyectoEdit: {
          FK_CategoriaId: null,
          FK_SemilleroId: null,
          FK_GrupoDeInvestigacionId: null
        }
      }
    },
    created(){
      axios.all([
        axios.get('/api/categorias'),
        axios.get('/api/semilleros'),
        axios.get('/api/grupos-de-investigacion')
      ]).then(axios.spread((categorias, semilleros, grupos) => {
        this.categorias = categorias.data;
        this.semilleros = semilleros.data;
        this.grupos = grupos.data;
      }));
    },
    watch: {
      proyecto(val){
        this.proyectoEdit = Object.assign({}, val);
      },
      'proyectoEdit.FK_CategoriaId': function(val){
        this.proyectoEdit.categoria = this.categorias.find(cat => cat.PK_id == val);
      },
      'proyectoEdit.FK_SemilleroId': function(val){
        this.proyectoEdit.semillero = this.semilleros.find(sem => sem.PK_id == val);
      },
      'proyectoEdit.FK_GrupoDeInvestigacionId': function(val){
        this.proyectoEdit.grupo_de_investigacion = this.grupos.find(grp => grp.PK_id == val);
      }
    },
    methods: {
      update(){
        let proyecto = this.proyectoEdit;
        axios.put('/api/proyectos/' + proyecto.PK_id, proyecto)
          .then(() => {
            this.errors = {};
            this.$emit('update', proyecto)
          })
          .catch(error => this.errors = error.response.data.errors)
      }
    }
}
</script>
