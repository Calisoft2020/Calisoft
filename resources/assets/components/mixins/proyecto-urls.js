
export default {
    methods: {
        getUrl(suffix) {
            return `/proyectos/${this.proyecto.PK_id}/${suffix}`
        }
    },
    computed: {
        modelacion() {
            return this.getUrl('modelacion')
        },
        plataforma() {
            return this.getUrl('plataforma')
        },
        codificacion() {
            return this.getUrl('codificacion')
        },
        basedatos() {
            return this.getUrl('basedatos')
        }
    }
}