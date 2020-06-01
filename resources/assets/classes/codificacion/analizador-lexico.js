import Token from './token';
import TablaIdentificadores from './tabla-identificadores';
import ListaTokens from './lista-tokens'; 

export default class AnalizadorLexico {

       constructor(){
           this.columna = 1;
           this.fila = 1;
           this.tokens = new ListaTokens();
           this.tabla = new TablaIdentificadores();
       }

       scanner(code){
           let index = 0;
           let buffer = code[index];
           let salto = true; 

           while(index <= code.length){

               if(buffer === "\t"){
                 this.columna += 4;
                 index++;
                 salto = false; 
               }else if(buffer === ' '){
                 this.columna += 1;
                 index++;
                 salto = false;
               }else if(buffer === "\n"){
                 this.hopLine();
                 index++;
                 salto = false;
               }

               if(/[0-9A-Za-z$\_]/.test(buffer)){
                 index = this.getWords(buffer,index,code);
                 salto = false;
               }

               if(/[\<\>\=\+\-\*\/\%\!\~\?\:\.\&\|\^\@]/.test(buffer)){
                   index = this.getOperators(buffer,index,code);
                   salto = false;
               }

               if(/[\{\}\[\]\(\)\;\,\'\"]/.test(buffer)){
                   if(buffer === '\'' || buffer === "\""){
                      index = this.getDelimiters(buffer,index,code);
                      salto = true;  
                   }else{
                      let delimitador = this.tabla.findDelimiter(buffer);
                      this.tokens.agregarToken(new Token("T_DELIMITADOR",delimitador.value,this.columna,this.fila));
                      this.columna++;  
                      salto = true;
                   }    
               }

               if(salto)index++;
               else salto = true; 
               
               buffer = code[index]; 
           }

           
           return this.tokens;
       }// fin metodo scanner

       getWords(buffer,index,code){
          let lexema = "";
          let col = this.columna;
          do{
              lexema += buffer;
              index++;
              buffer = code[index];
              this.columna++;
          }while(/[0-9A-Za-z$\_]/.test(buffer) && index <= code.length);
          
          let lex;

          if(lex = this.tabla.findWord(lexema.toLowerCase())){
                this.tokens.agregarToken(new Token('T_RESERVADA',lex.value,col,this.fila));
          }else if(isNaN(lexema)){
               this.tokens.agregarToken(new Token('T_IDENTIFICADOR',lexema,col,this.fila));
          }else {
               this.tokens.agregarToken(new Token('T_NUMERO',lexema,col,this.fila)); 
         }
           
         return index--;
       }

       getOperators(buffer,index,code){
           let lexema = "";
           let col = this.columna;
           do{
               lexema += buffer;
               index++;
               buffer = code[index];
               this.columna++;
           }while(/[\<\>\=\+\-\*\/\%\!\~\?\:\.\&\|\^\@]/.test(buffer) && index <= code.length );
          
           if(lexema.length > 3){
              lexema = lexema.substring(0,2);
           }

           let lex;

           if(lex = this.tabla.findOperator(lexema)){
               if(lex.value === 'T_COMENTARIO' || lex.value === 'T_COMENTARIO_L'){
                  index = this.getComment(index,code,lex.value);  
               }
               this.tokens.agregarToken(new Token('T_OPERADOR',lex.value,col,this.fila));   
           }
             
           return index--;
       }

       getDelimiters(buffer,index,code){
           let lexema = "";
           let col = this.columna;
           let delimitador = buffer;
           let fil = this.fila;

           do{
              lexema += buffer;
              index++;
              buffer = code[index];
              this.columna++;   
              if(buffer === "\n"){
                  this.hopLine();
              }
           }while( buffer !== delimitador && index <= code.length);
          
           this.tokens.agregarToken(new Token("T_STRING",lexema.substring(1,lexema.length),col,fil));          
 
           return index;
       }

       getComment(index,code,value){
           let buffer;
           let key = true;
           
           if( value == 'T_COMENTARIO' ){
               do{
                   buffer = code[index];
                   index++;
               }while( buffer !== "\n" && index <= code.length ); 
           } else {
               do{
                  buffer = code[index];
                  index++;
                  if(buffer === '*'){
                     buffer += code[index];
                     if(buffer === '*/'){
                        key = false;
                     }else {
                         buffer = '';
                     }
                  }else  if( buffer === "\n"){
                      this.hopLine();  
                  }
               }while( key  && index <= code.length );
           }          
           return --index;
       }

       hopLine(){
           this.fila += 1;
           this.columna = 1;
       }
}