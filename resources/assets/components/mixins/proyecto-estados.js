export default {
    computed: {
        creacion() {
            return this.proyecto.state == "creacion"
        },
        activo() {
            return this.proyecto.state == "activo"
        },
        propuesta() {
            return this.proyecto.state == "propuesta"
        },
        evaluacion() {
            return this.proyecto.state == "evaluacion"
        },
        completado() {
            return this.proyecto.state == "completado"
        }
    }
}