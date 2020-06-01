export default {
    methods: {
        filtrar(tipo) {
            return this.proyecto.usuarios.filter(usuario => usuario.pivot.tipo == tipo);
        },
    },
    computed: {
        integrantes() {
            return this.filtrar('integrante')
        },
        evaluadores() {
            return this.filtrar('evaluador')
        },
        invitados() {
            return this.filtrar('invitado')
        }
    }
}