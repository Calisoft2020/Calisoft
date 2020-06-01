<template>
    <div class="row">
        <div class="col-xs-12">
            <progress-bar v-model="porcentaje" active striped
                :type="porcentaje == 100 ?  'success' : 'info'">
            </progress-bar>
        </div>
    </div>
    
</template>


<script>
import { ProgressBar } from 'uiv';
export default {
    props: ['documentos', 'tipos'],
    components: { ProgressBar },
    computed: {
        porcentaje() {
            let tipos = this.tipos.filter(tipo => tipo.required);
            let files = 0;
            for(let tipo of tipos) {
                let file = this.documentos.find(doc => doc.FK_TipoDocumentoId == tipo.PK_id)
                files += file ? 1 : 0;
            }
            return Math.round(files / tipos.length * 100);
        }
    }
}
</script>
