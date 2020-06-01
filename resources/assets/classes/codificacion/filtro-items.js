import ListaTokens from './lista-tokens';
import Token from './token';

export default class FiltroItems{

    constructor(){
        this.tokens = null;
        this.items = [];    
    }

    filtrarItems(tokens){
        this.tokens = tokens;
        this.getVariables();
        this.getConstantes();
        this.getIdentificadores('T_RESERVADA','T_FUNCTION');
        this.getIdentificadores('T_RESERVADA','T_CLASS');
        this.getIdentificadores('T_RESERVADA','T_CONST');
        this.getComentarios();
        this.getEspaciosDeNombre();
        this.validarIndentacion();
        return this.items;
    } 
    
    getVariables(){
        let variables = [];
        let token = this.tokens.siguienteToken();
        let varFil = [];
        let variablesGlobales = ['$GLOBALS','$_SERVER','$_GET','$_POST','$_FILES','$_COOKIE','$_SESSION','$_REQUEST','$_ENV'];
        while(token != null){
            if(token.identificador === 'T_IDENTIFICADOR'){
                if(/[$]/.test(token.atributo)){
                     variables.push(token);   
                }
            }
            token = this.tokens.siguienteToken();
        }

        variables.forEach(e => {
             if(!varFil.includes(e.atributo) && !variablesGlobales.includes(e.atributo)){
                varFil.push(e.atributo);
                this.items.push({
                     item : 'T_VARIABLE',
                     atributo : e.atributo.substring(1,e.atributo.length),
                     fila : e.fila,
                     columna : e.columna,
                     calificacion : true
                });    
             }
        });
    }

    getIdentificadores(id,atributo){
         let token = this.tokens.siguienteToken();

         while(token != null){
               if(token.identificador == id && token.atributo == atributo){
                   do{
                      token =  this.tokens.siguienteToken();   
                   }while(token.identificador != 'T_IDENTIFICADOR');
                   if(token.atributo != '__construct' && token.atributo != undefined){
                       this.items.push({
                           item : atributo,
                           atributo : token.atributo,
                           fila : token.fila,
                           columna : token.columna,
                           calificacion : true
                       });
                   }
                   
               }
               token =  this.tokens.siguienteToken();    
         }
    }

    getConstantes(){
        let token = this.tokens.siguienteToken();

        while(token != null){
            if(token.atributo == 'T_DEFINE'){
                do{
                    token = this.tokens.siguienteToken();
                }while(token.identificador != 'T_STRING');      
                this.items.push({
                    item : 'T_CONST',
                    atributo : token.atributo,
                    fila : token.fila,
                    columna : token.columna,
                    calificacion : true
                });
            }
            token = this.tokens.siguienteToken();
        }
    }
    
    getComentarios(){
        let token = this.tokens.siguienteToken();
        while(token != null){
            switch(token.atributo){
                case "T_COMENTARIO"   :   
                case "T_COMENTARIO_L" :                         
                case "T_CLASS"        : this.items.push({
                                            item : 'T_COMENTARIO',
                                            atributo : token.atributo,
                                            fila : token.fila,
                                            columna : token.columna,
                                            calificacion : true    
                                        });
                                        break;
                case "T_FUNCTION"     : this.items.push({
                                            item : 'T_COMENTARIO',
                                            atributo : token.atributo,
                                            fila : token.fila,
                                            columna : token.columna,
                                            calificacion : true    
                                         });
                                        this.recorrerEstructura(this.validarEstructura(token.atributo));
                                        break;                                                         
            }
            token = this.tokens.siguienteToken();
        }
    }
    
    recorrerEstructura(idCierre,tokenAnt,funcion){
        let token = this.tokens.siguienteToken();
        let tokenIni = tokenAnt;
        let estructura;
        if(funcion != undefined){
           this.items.push({
                item : 'T_INDENTACION',
                atributo : tokenAnt.atributo,
                fila : tokenAnt.fila,
                columna : tokenAnt.columna,
                calificacion : true    
           });
        } 
        while(true){
            if(token.atributo == 'T_PARENTESIS_A' || token.atributo == 'T_LLAVE_A'){
                if(token.atributo == 'T_PARENTESIS_A'){
                    this.saltarParentesis();
                    token = this.tokens.siguienteToken();
                }
                do{
                    if(token.atributo == 'T_LLAVE_A' || token.atributo == 'T_TERNARIO'){
                        do{
                            token = this.tokens.siguienteToken();
                            if(estructura = this.validarEstructura(token.atributo)){
                                this.recorrerEstructura(estructura,token,funcion); 
                            }
                            if(funcion != undefined && token.atributo != 'T_LLAVE_C' && token.atributo != idCierre && token.atributo != 'T_PUNTO_COMA'){
                               
                               if(tokenAnt.fila == tokenIni.fila && tokenAnt.columna == tokenIni.columna){
                                    funcion(tokenAnt,token,tokenIni,idCierre);      
                               }else{
                                    funcion(tokenAnt,token);     
                               }
                               
                               if(token.fila > tokenAnt.fila){
                                   tokenAnt = token;
                               }     
                            }
                        }while(token.atributo != 'T_LLAVE_C' && token.atributo != idCierre);
                        if(funcion != undefined){
                            funcion(tokenAnt,token,tokenIni,idCierre); 
                        } 
                        break;    
                    }else if(token.atributo == 'T_PUNTO_COMA'){    
                        break;
                    }else{
                        token = this.tokens.siguienteToken();    
                    }
                }while(true);
                break;  
            }else if(token.atributo == 'T_PUNTO_COMA'){
                    this.items.pop();
                    break;      
            }else{
                token = this.tokens.siguienteToken();       
            }
        }
        return token;
    }

    getEspaciosDeNombre(){
        let token = this.tokens.siguienteToken();
        let espNombre = [];
        while(token != null){
            if(token.atributo == 'T_NAMESPACE'){
               do{
                   token = this.tokens.siguienteToken();
               }while(token.atributo != 'T_PUNTO_COMA' && token.atributo != 'T_LLAVE_A');
               token = this.tokens.anteriorToken();
               this.items.push({
                   item : 'T_NAMESPACE',
                   atributo : token.atributo,
                   fila : token.fila,
                   columna : token.columna,
                   calificacion : true    
               });
            }
            token = this.tokens.siguienteToken();
        }
    }

    saltarParentesis(){
        let token;
        do{
            token = this.tokens.siguienteToken();
            if(token.atributo == 'T_PARENTESIS_A'){
                this.saltarParentesis();
            }
        }while(token.datos.atributo != 'T_PARENTESIS_C');
    }

    validarEstructura(estructura){
        switch(estructura){
            case 'T_ELSE'     :  
            case 'T_ELSEIF'   : 
            case 'T_DO'       : 
            case 'T_FUNCTION' : 
            case 'T_TRY'      : 
            case 'T_CATCH'    : 
            case 'T_FINALLY'  : 
            case 'T_STATIC'   : 
            case 'T_PRIVATE'  : 
            case 'T_PROTECTED': 
            case 'T_PUBLIC'   : return 'T_LLAVE_C';
                                break;
            case 'T_IF'       : return 'T_ENDIF';
                                break;
            case 'T_WHILE'    : return 'T_ENDWHILE';
                                break;
            case 'T_FOR'      : return 'T_ENDFOR';
                                break;                   
            case 'T_FOREACH'  : return 'T_ENDFOREACH';
                                break;
            case 'T_SWITCH'   : return 'T_ENDSWITCH';
                                break;
        }
    }

    validarIndentacion(){
        let token = this.tokens.siguienteToken();
        let funcion = (tokenAnt,tokenAct,tokenIni,idCierre) =>{

            if(tokenIni != undefined && idCierre != undefined){
                if(tokenAct.atributo != 'T_LLAVE_C' && tokenAct.atributo != idCierre){
                    if(!((tokenAct.columna > (tokenIni.columna+3)) && (tokenAct.fila > tokenIni.fila))){
                        this.calificarIndentacion(); 
                    } 
                }else{
                    if(this.esEstructuraDeControl(tokenAnt.atributo)){
                        if(((tokenAnt.columna-1) != tokenAct.columna) && (tokenAct.columna != tokenIni.columna)){
                            this.calificarIndentacion();
                        } 
                    }else if(tokenAct.columna != tokenIni.columna){
                        this.calificarIndentacion(); 
                    }       
                }
            }else if(tokenAct.fila > tokenAnt.fila){
                  if(this.esEstructuraDeControl(tokenAct.atributo)){
                     if(((tokenAnt.columna+1) != tokenAct.columna) && (tokenAct.columna != tokenAnt.columna)){
                        this.calificarIndentacion();
                     }
                  }else if(tokenAct.columna != tokenAnt.columna){
                      this.calificarIndentacion();
                  }                   
            }
        }
        
        let estructura;
        while(token != null){
            if(estructura = this.validarEstructura(token.atributo)){
                this.recorrerEstructura(estructura,token,funcion);
            }
            token = this.tokens.siguienteToken();
        }
    }

    esEstructuraDeControl(estructura){
        switch(estructura){
            case 'T_ELSE'    :
            case 'T_ELSEIF'  : 
            case 'T_WHILE'   :
            case 'T_CATCH'   :
            case 'T_FINALLY' : return true;
                               break;
                     default : return false;
                               break;  
        }
    }

    calificarIndentacion(){
        let ultimoItem = this.items.pop();
        ultimoItem.calificacion = false;
        this.items.push(ultimoItem);
    }
} 