import Token from './token';

export default class ListaTokens {
     
    constructor(){
        this.ini = null; // incia la lista de tokens
        this.ult = null; // ultimo token de la lista
        this.actual = null; 
    }

    agregarToken(token){
        if(this.ini == null){
            this.ini = token;
            this.ult = token;
            this.actual = token;
        }else{
            this.ult.agregarSiguiente(token);
            token.agregarAnterior(this.ult);
            this.ult = token;
        }
    }

    recorrerLista(){
        let aux = this.ult;

        while(aux.datos.anterior != null){
            console.log(aux.datos);
            aux = aux.datos.anterior;    
        }
        console.log("fin ///");
    }

    siguienteToken(){
       let token = this.actual.datos.siguiente;
       this.actual = this.actual.datos.siguiente;
       if(this.actual == null){
          this.actual = this.ini;
       } 

       return token; 
    }

    anteriorToken(){
        let token = this.actual.datos.anterior;
        this.actual = this.actual.datos.anterior;
        if(this.actual == null){
           this.actual = this.ini;
        } 
 
        return token;    
    }
}