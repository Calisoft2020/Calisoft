export default class TablaIdentificadores {

       constructor(){
           
          this.palabrasReservadas = [
               { key: 'abstract', value : 'T_ABSTRACT'},
               { key: 'and', value: 'T_AND' }, 
               { key: 'array', value : 'T_ARRAY'},
               { key: 'as', value: 'T_AS'},
               { key: 'break', value: 'T_BREAK'},
               { key: 'callable', value: 'T_CALLABLE'},
               { key: 'case', value: 'T_CASE'},
               { key: 'catch', value: 'T_CATCH'},
               { key: 'class', value: 'T_CLASS'},
               { key: 'clone', value: 'T_CLONE'},
               { key: 'const', value: 'T_CONST'},
               { key: 'continue', value: 'T_CONTINUE'},
               { key: 'declare', value: 'T_DECLARE'},
               { key: 'default', value: 'T_DEFAULT'},
               { key: 'define', value: 'T_DEFINE'},
               { key: 'die', value: 'T_DIE'},
               { key: 'do', value: 'T_DO'},
               { key: 'echo', value: 'T_ECHO'},
               { key: 'else', value: 'T_ELSE'},
               { key: 'elseif', value: 'T_ELSEIF'},
               { key: 'empty', value: 'T_EMPTY'},
               { key: 'enddeclare', value: 'T_ENDDECLARE'},
               { key: 'endfor', value: 'T_ENDFOR'},
               { key: 'endforeach', value: 'T_ENDFOREACH'},
               { key: 'endif', value: 'T_ENDIF'},
               { key: 'endswitch', value: 'T_ENDSWITCH'},
               { key: 'endwhile', value: 'T_ENDWHILE'},
               { key: 'eval', value: 'T_EVAL'},
               { key: 'exit', value: 'T_EXIT'},
               { key: 'extends', value: 'T_EXTENDS'},
               { key: 'false', value: 'T_FALSE'},
               { key: 'final', value: 'T_FINAL'},
               { key: 'finally', value: 'T_FINALLY'},
               { key: 'for', value: 'T_FOR'},
               { key: 'foreach', value: 'T_FOREACH'},
               { key: 'function', value: 'T_FUNCTION'},
               { key: 'global', value: 'T_GLOBAL'},
               { key: 'goto', value: 'T_GOTO'},
               { key: 'if', value: 'T_IF'},
               { key: 'implements', value: 'T_IMPLEMENTS'},
               { key: 'include', value: 'T_INCLUDE'},
               { key: 'include_once', value: 'INCLUDE_ONCE'},
               { key: 'instanceof', value: 'T_INSTANCEOF'},
               { key: 'insteadof', value: 'T_INSTEADOF'},
               { key: 'interface', value: 'T_INTERFACE'},
               { key: 'isset', value: 'T_ISSET'},
               { key: 'list', value: 'T_LIST'},
               { key: 'namespace', value: 'T_NAMESPACE'},
               { key: 'new', value: 'T_NEW'},
               { key: 'null', value: 'T_NULL'},
               { key: 'or', value: 'T_OR'},
               { key: 'php', value: 'T_PHP'},
               { key: 'print', value: 'T_PRINT'},
               { key: 'private', value: 'T_PRIVATE'},
               { key: 'protected', value: 'T_PROTECTED'},
               { key: 'public', value: 'T_PUBLIC'},
               { key: 'require', value: 'T_REQUIRE'},
               { key: 'require_once', value: 'T_REQUIRE_ONCE'},
               { key: 'return', value: 'T_RETURN'},
               { key: 'self', value: 'T_SELF'},
               { key: 'static', value: 'T_STATIC'},
               { key: 'switch', value: 'T_SWITCH'},
               { key: 'throw', value: 'T_THROW'},
               { key: 'trait', value: 'T_TRAIT'},
               { key: 'true', value: 'T_TRUE'},
               { key: 'try', value: 'T_TRY'},
               { key: 'unset', value: 'T_UNSET'},
               { key: 'use', value: 'T_USE'},
               { key: 'var', value: 'T_VAR'},
               { key: 'while', value: 'T_WHILE'},
               { key: 'xor', value: 'T_XOR'},
               { key: 'yield', value: 'T_YIELD'},
               { key: '$this', value: 'T_THIS'}      
         ];

         this.operadores = [
               { key:'+', value: 'T_SUMA'},
               { key: '-', value: 'T_RESTA'},
               { key: '*', value: 'T_MULTIPLICACION'},
               { key: '/', value: 'T_DIVISION'},
               { key: '%', value: 'T_MODULO'},
               { key: '**', value: 'T_POTENCIA'},
               { key: '=', value: 'T_ASIGNACION'},
               { key: '&', value: 'T_OP_AND'},
               { key: '|', value: 'T_OP_OR'},
               { key: '^', value: 'T_OP_XOR'},
               { key: '~', value: 'T_NEGACION'},
               { key: '<<', value: 'T_IZQUIERDA'},
               { key: '>>', value: 'T_DERECHA'},
               { key: '==', value: 'T_IGUAL'},
               { key: '===', value: 'T_IDENTICO'},
               { key: '!=', value: 'T_DIFERENTE'},
               { key: '<>', value: 'T_DIFERENTE'},
               { key: '!==', value: 'T_NOIDENTICO'},
               { key: '<', value: 'T_MENOR_Q'},
               { key: '>', value: 'T_MAYOR_Q'},
               { key: '<=', value: 'T_MENOR_IGUAL'},
               { key: '>=', value: 'T_MAYOR_IGUAL'},
               { key: '<=>', value: 'T_NAVE'},
               { key: '??', value: 'T_FUSION'},
               { key: '@', value: 'T_ERROR'},
               { key: '++', value: 'T_INCREMENTO'},
               { key: '--', value: 'T_DECREMENTO'},
               { key: '&&', value: 'T_OP_AND'},
               { key: '||', value: 'T_OP_OR'},
               { key: '!', value: 'T_NEGACION'},
               { key: '.', value: 'T_CONCATENACION'},
               { key: '.=', value: 'T_CONCATENACION'},
               { key: '?', value: 'T_TERNARIO'},
               { key: ':', value: 'T_TERNARIO'},
               { key: '::', value: 'T_ESTATICA'},
               { key: '+=', value: 'T_ASIGNACION'},
               { key: '-=', value: 'T_ASIGNACION'},
               { key: '*=', value: 'T_ASIGNACION'},
               { key: '**=', value: 'T_ASIGNACION'},
               { key: '/=', value: 'T_ASIGNACION'},
               { key: '%=', value: 'T_ASIGNACION'},
               { key: '&=', value: 'T_ASIGNACION'},
               { key: '|=', value: 'T_ASIGNACION'},
               { key: '^=', value: 'T_ASIGNACION'},
               { key: '<<=', value: 'T_ASIGNACION'},
               { key: '>>=', value: 'T_ASIGNACION'},
               { key: '->', value: 'T_FLECHA'},
               { key: '=>', value: 'T_FLECHA_A'},
               { key: '<?', value: 'T_OP_PHP'},
               { key: '?>', value: 'T_OP_PHP'},
               { key: '//', value: 'T_COMENTARIO'},
               { key: '/*', value: 'T_COMENTARIO_L'},
               { key: '/**', value: 'T_COMENTARIO_L'} 
         ];

         this.delimitadores = [
               { key: '(', value: 'T_PARENTESIS_A'},
               { key: ')', value: 'T_PARENTESIS_C'},
               { key: '[', value: 'T_CORCHETE_A'},
               { key: ']', value: 'T_CORCHETE_C'},
               { key: '{', value: 'T_LLAVE_A'},
               { key: '}', value: 'T_LLAVE_C'},
               { key: ';', value: 'T_PUNTO_COMA'},
               { key: ',', value: 'T_COMA'}
         ];
       }

       findWord(word){
            return this.palabrasReservadas.find( (e) => {
                   return e.key === word;
            });
       }

       findOperator(operator){
            return this.operadores.find( (e) => {
                    return  e.key === operator;
            });
       }

       findDelimiter(delimiter){
            return this.delimitadores.find( (e) => {
                    return e.key === delimiter; 
            }); 
       } 
}