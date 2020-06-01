export default class Token{

       constructor(id,atr,col,fil){
           this.identificador = id;
           this.atributo = atr;
           this.columna = col;
           this.fila = fil;
           this.siguiente = null; // referencia al siguiente nodo de la lista
           this.anterior = null; // referencia al anterior nodo de la lista  
       }

       get datos(){
           return {
               id : this.identificador,
               atributo : this.atributo,
               columna : this.columna,
               fila : this.fila,
               siguiente : this.siguiente,
               anterior : this.anterior
           };
       }
       
       agregarSiguiente(token){
          this.siguiente = token;  
       }

       agregarAnterior(token){
           this.anterior = token;
       }

}
