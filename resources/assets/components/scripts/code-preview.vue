<template>
    <codemirror :code="code" :options="codeOptions"></codemirror>
</template>


<script>
export default {
    data(){
        return {
            code: "",
            codeOptions: {
                lineNumbers: true,
                mode: this.mode,
                readOnly: true,
                theme: 'eclipse'
            },
        }
    
    },

    created(){
        axios.post(this.prefix + this.url).then(res => {
        this.code = res.data.code;
        });
    },
  props:{
      prefix:{
          type: String,
          default: '/api/scripts/preview/'
      },
      mode:{
          type:String,
          default: 'application/x-httpd-php'
      },
      url:{
          type: String,
          required: true,
      }
  }
}   
</script>

