import AnalizadorLexico from './analizador-lexico';
import FiltroItems from './filtro-items';
import FiltroNotaciones from './filtro-notaciones';

export default class ReglasEstandar{

    constructor(){
        this.calificacionItems = [];
        this.items = null;
        this.idItems = [];
        this.itemsEvaluados = [];
        this.anLex = new AnalizadorLexico();
        this.filItems = new FiltroItems(); 
    }

    evaluarEstandar(code,scriptId,idItems){
        let peticion;
        this.idItems = idItems;
        this.items = this.filItems.filtrarItems(this.anLex.scanner(code));
        this.evaluarItems('T_VARIABLE');
        this.evaluarItems('T_CLASS');
        this.evaluarItems('T_FUNCTION');
        this.evaluarItems('T_NAMESPACE');
        this.evaluarItems('T_CONST');
        this.evaluarItems('T_INDENTACION');
        this.evaluarComentarios();
        peticion = this.construirPeticion(scriptId);
        peticion = peticion.concat(this.construirPeticionItems(scriptId));
        this.guardarCalificacion(peticion);   
    }

    evaluarItems(item){
        let totalItems = 0;
        let itemsCorrectos = 0;
        let nota;
        let idItem;
        this.items.forEach( e => {
            if(e.item === item){
                totalItems++;
                if(this.tipoDeEvaluacion(e)){
                   itemsCorrectos++;
                }      
            }
        });
        
        nota = (totalItems > 0) ? (itemsCorrectos/totalItems) : 0;  
        idItem = this.buscarIdItem(item);

        this.calificacionItems.push({
            PK_id : idItem,
            nota : nota, 
            acertadas : itemsCorrectos,
            total : totalItems 
        });

    }
    
    tipoDeEvaluacion(elemento){
        switch(elemento.item){
            case 'T_VARIABLE'    :
            case 'T_FUNCTION'    : return this.esLowerCamelCase(elemento); 
            case 'T_CONST'       : return this.esSnakeCase(elemento);
            case 'T_INDENTACION' : return this.evaluarIndentacion(elemento);
            case 'T_CLASS'       :
            case 'T_NAMESPACE'   : return this.esUpperCamelCase(elemento); 
        }
    }

    evaluarIndentacion(elemento){
        this.itemsEvaluados.push({
            atributo : elemento.atributo.substring(2,elemento.atributo.length).toLowerCase(),
            fila: elemento.fila,
            calificacion : elemento.calificacion,
            FK_itemId : this.buscarIdItem(elemento.item),     
        });
        return elemento.calificacion;
    }

    evaluarComentarios(){
        let nodoAnt = this.items[0];
        let totalItems = 0;
        let itemsCorrectos = 0;
        let calificacion = false;
        let nota;
        let idItem;
        this.items.forEach( e =>{
            if(e.atributo === 'T_FUNCTION' || e.atributo === 'T_CLASS'){
                totalItems++;
                if(nodoAnt.atributo === 'T_COMENTARIO' || nodoAnt.atributo === 'T_COMENTARIO_L'){
                    itemsCorrectos++;
                    calificacion = true; 
                }
                this.itemsEvaluados.push({
                    atributo : e.atributo.substring(2,e.atributo.length).toLowerCase(),
                    fila: e.fila,
                    calificacion : calificacion,
                    FK_itemId : this.buscarIdItem('T_COMENTARIO'),     
                });
                calificacion = false;    
            }
            nodoAnt = e;
        });
        
        nota = (totalItems > 0) ? (itemsCorrectos/totalItems) : 0;  
        idItem = this.buscarIdItem('T_COMENTARIO'); 

        this.calificacionItems.push({
            PK_id : idItem,
            nota : nota, 
            acertadas : itemsCorrectos,
            total : totalItems 
        });
    }

    esLowerCamelCase(elemento){
        let validacion = FiltroNotaciones.validarLowerCamelCase(elemento.atributo);
        if(elemento.atributo.length < 5){
           if(FiltroNotaciones.tieneMasyuscula(elemento.atributo)){
              validacion = false; 
           }   
        }
        this.itemsEvaluados.push({
            atributo : elemento.atributo,
            fila: elemento.fila,
            calificacion : validacion,
            FK_itemId : this.buscarIdItem(elemento.item),     
        });
        return validacion;
    }

    esUpperCamelCase(elemento){
        let validacion = FiltroNotaciones.validarUpperCamelCase(elemento.atributo);
        if(elemento.atributo.length < 5){
            if(FiltroNotaciones.tieneMasyuscula(elemento.atributo)){
                validacion = false; 
             }
        }
        this.itemsEvaluados.push({
            atributo : elemento.atributo,
            fila: elemento.fila,
            calificacion : validacion,
            FK_itemId : this.buscarIdItem(elemento.item),     
        });
        return validacion;
    }

    esSnakeCase(elemento){
        let validacion = FiltroNotaciones.validarSnakeCase(elemento.atributo);
        this.itemsEvaluados.push({
            atributo : elemento.atributo,
            fila: elemento.fila,
            calificacion : validacion,
            FK_itemId : this.buscarIdItem(elemento.item),     
        });
        return validacion;
    }

    buscarIdItem(item){
        let nombreItem; 
        switch(item){
            case 'T_VARIABLE'    : nombreItem = 'variables';
                                   break;
            case 'T_FUNCTION'    : nombreItem = 'funciones';
                                   break;
            case 'T_CLASS'       : nombreItem = 'clases';
                                   break;
            case 'T_CONST'       : nombreItem = 'constantes';
                                   break;
            case 'T_NAMESPACE'   : nombreItem = 'espacios de nombre';
                                   break;
            case 'T_INDENTACION' : nombreItem = 'identacion';
                                   break;
            case 'T_COMENTARIO'  : nombreItem = 'comentarios';
                                   break;
        }
        
        let id = this.idItems.find( e =>{
                    return e.item.toLowerCase() === nombreItem;                    
                 });
        return id.PK_id;
    }

    guardarCalificacion(peticion){
        $.blockUI({ 
            message: '<h3><img src="/img/carga.gif" /> </h3>',
            css : {
                border: '1px solid black',
                padding: '10px',
                'border-radius' : '20px' 
            },
            onBlock: function(){
                         axios.all(peticion)
                         .then(axios.spread((a)=>{
                             toastr.success("Script calificado correctamente");
                             $.unblockUI();
                             location.reload(true);
                         }))
                         .catch(reason => console.log(reason.response.data.errors));  
                   }
        });    
    }

    construirPeticion(scriptId){
        let peticion = [];
        for(let i = 0; i < 7;i++){
            peticion.push(axios.put('/api/evaluacionesScript/'+ scriptId,{
                PK_id: this.calificacionItems[i].PK_id,
                nota: this.calificacionItems[i].nota,
                total: this.calificacionItems[i].total,
                acertadas: this.calificacionItems[i].acertadas,
            }));
        }
        return peticion;
    }
    
    construirPeticionItems(scriptId){
        let peticion = [];
        let longitud = this.itemsEvaluados.length;
        for(let i=0; i < longitud;i++){
            peticion.push(axios.post('/api/itemsEvaluados',{ 
                atributo : this.itemsEvaluados[i].atributo,
                fila : this.itemsEvaluados[i].fila,
                calificacion : this.itemsEvaluados[i].calificacion,
                FK_scriptId : scriptId,
                FK_itemId : this.itemsEvaluados[i].FK_itemId
            })); 
        }
        return peticion;
    }
}