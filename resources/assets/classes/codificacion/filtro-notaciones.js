

export default class FiltroNotaciones {
      
     static esMayuscula(letra){
         return letra === letra.toUpperCase();    
     }
     
     static esMinuscula(letra){
         return letra === letra.toLowerCase();    
     }

     static mayusculasSeguidas(palabra){
         let longitud = palabra.length;
         for(let i = 0; i < longitud; i++){
             if(i != 0){
                if(this.esMayuscula(palabra[i]) && this.esMayuscula(palabra[i-1])){
                    return true;   
                 }
             }    
         }
         return false;
     }

     static numeroDePalabras(palabra){
         let longitud = palabra.length;
         if(longitud > 9 && longitud <= 17){
             return 2;   
         }else if(longitud > 17 && longitud <= 24){
             return 3;
         }else if(longitud > 24){
             return 4;
         }
         return 1;
     }

     static buscarPreposiciones(palabra){ 
        let prefijos = ["de","desde","entre","para","por","sin","tras"];
        let validacion = false;
        palabra = palabra.toLowerCase();
        prefijos.forEach( e => {
            if(palabra.includes(e)){
                validacion = true;
            } 
        });
        return validacion; 
     }
     
     static contarMayusculas(palabra){
         let longitud = palabra.length;
         let totalMayusculas = 0;
         for(let i = 0; i < longitud; i++){
             if(this.esMayuscula(palabra[i])){
                 totalMayusculas++;     
             }
         }
         return totalMayusculas;
     }
     
     //retorna true si encuentra un caracter de tipo _ en una posicion diferente de la inicial
     static validarCaracteres(palabra){
         let longitud = palabra.length;
         let validacion = false;
         for(let i = 0; i < longitud; i++){
             if(palabra[i] === '_'){
                 validacion = (i > 1) ? true : false;   
             }    
         }
         return validacion;    
     }

     static contarCaracteres(palabra,caracter){
         let longitud = palabra.length;
         let total = 0;
         for(let i = 0; i < longitud; i++){
            if(palabra[i] === caracter){
                total++;           
            }    
        }
        return total;
     }

     static eliminarCaracter(palabra,caracter){
         let longitud = palabra.length;
         let nuevaPalabra = "";
         for(let i = 0; i < longitud; i++){
             if(palabra[i] != caracter){
                 nuevaPalabra += palabra[i];
             }
         }
         return nuevaPalabra;
     }

     static variablesDeUnCaracter(caracter){
          let variables = ['i','j','k'];
          let validacion = false;
          variables.forEach(e => {
              if(e == caracter){
                 validacion = true;
              }  
          });
          return validacion;
     }

     static tieneMasyuscula(palabra){
         let validacion = false;
         let longitud = palabra.length;
         for(let i = 0; i < longitud; i++){
            if(this.esMayuscula(palabra[i])){
                validacion = true;
            }
         }
         return validacion;
     }

     static tieneMinuscula(palabra){
        let validacion = false;
        let longitud = palabra.length;
        for(let i = 0; i < longitud; i++){
           if(this.esMinuscula(palabra[i])){
               validacion = true;
           }
        }
        return validacion;       
     }

     static validarLowerCamelCase(atributo){
         let numPalabras = this.numeroDePalabras(atributo);
         let totalMayusculas = this.contarMayusculas(atributo);
         if(atributo.length  >= 3){ 
             if(this.esMinuscula(atributo[0])){
                 if(!this.mayusculasSeguidas(atributo)){
                     if(!this.validarCaracteres(atributo)){
                         if(totalMayusculas > numPalabras-1){
                             return ((totalMayusculas - (numPalabras - 1)) < 2)? true : false;
                         }else if(totalMayusculas == numPalabras-1){
                              return true    
                         }
                     }
                 }
             }
         }else if(atributo.length == 1){
              return this.variablesDeUnCaracter(atributo);
         }
         return false;
     }

    static validarUpperCamelCase(atributo){
        let numPalabras = this.numeroDePalabras(atributo);
        let totalMayusculas = this.contarMayusculas(atributo);
        if(atributo.length  >= 3){ 
            if(this.esMayuscula(atributo[0])){
                    if(!this.validarCaracteres(atributo)){
                        if(totalMayusculas > numPalabras){
                            return ((totalMayusculas - (numPalabras)) < 2)? true : false;
                        }else if(totalMayusculas == numPalabras){
                             return true    
                        }
                    }
            }
        }else if(atributo.length == 1){
             return this.variablesDeUnCaracter(atributo);
        }
        return false;    
     }

     static validarSnakeCase(atributo){
         let numCaracteres = this.contarCaracteres(atributo,'_');
         atributo = this.eliminarCaracter(atributo,'_');
         let numPalabras = this.numeroDePalabras(atributo);
         if(atributo.length >= 3){
             if(!this.tieneMinuscula(atributo)){
                    if(numCaracteres > numPalabras-1){
                        return ((numCaracteres - (numPalabras - 1)) < 2)? true : false;
                    }else if(numCaracteres == numPalabras-1){
                         return true    
                    }   
             }
         }
         return false;
     }
}