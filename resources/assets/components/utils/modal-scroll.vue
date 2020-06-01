<template>
    <div :id="id" class="modal fade" role="dialog">
        <div class="modal-dialog" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ title }}</h4>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <slot name="footer"></slot>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    props: ['id', 'title']
}
</script>
