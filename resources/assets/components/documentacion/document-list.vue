<template>
    <ul class="list-group">
        <li class="list-group-item" v-for="tipo in tipos" :key="tipo.PK_id">
            <div class="row">
                <div class="col-sm-5 col-xs-12">
                    <span class="label label-success big">{{ tipo.nombre }}</span>
                    <span class="label label-primary big" v-show="tipo.required">r</span>

                </div>
                <div class="col-sm-7 col-xs-12">
                    <div class="text-right">
                        <popover v-for="(doc, index) in filter(tipo)" :title="doc.nombre" :key="doc.PK_id">
                            <a v-if="doc.nota !=null || doc > 0" href="javascript:;" class="label label-success big" data-role="trigger" style="margin-left: 1%">
                                <span class="fa fa-file-pdf-o"></span>
                                {{ index + 1}}
                            </a>
                            <a v-else href="javascript:;" class="label label-danger big" data-role="trigger" style="margin-left: 1%">
                                <span class="fa fa-file-pdf-o"></span>
                                {{ index + 1}}
                            </a>
                            <div slot="popover" class="text-center">

                                <slot name="buttons" :doc="doc"></slot>

                                <a title="descargar" class="btn btn-info btn-xs" :href="`${doc.url}`" target="_blank">
                                    <span class="glyphicon glyphicon-download-alt"></span>
                                </a>

                                <a  title="proceso" class="btn btn-info btn-xs">
                                    <span> {{doc.nota *100 }}%  </span>
                                </a>

                            </div>
                        </popover>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</template>


<script>
import { Popover } from 'uiv';

export default {
    props: ['documentos', 'tipos'],
    components: { Popover },
    methods: {
        filter(tipo) {
            return this.documentos.filter(doc => doc.FK_TipoDocumentoId == tipo.PK_id)
        }
    }
}
</script>

<style scoped>
.big {
    font-size: 11px;
}
</style>

