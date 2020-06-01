
const ATTRS = {
    'min': 'min_value',
    'max': 'max_value',
    'maxlength': 'max',
    'minlength': 'min',
    'pattern': 'regex',
    'required': 'required'
}

const TYPES = {
    'email': 'email',
    'number': 'numeric',
    'url': 'url'
}

/**
 * Convirte los atributos tipo objeto al formato string de vee-validate
 * @param {string} type
 * @param {object} attributes 
 */
export function parseRule(type, attributes) {
    let regla = []
    for (let attribute of Object.keys(attributes)) {
        if(attribute in ATTRS) {
            let value = attributes[attribute]
            let validation = ATTRS[attribute] + (value ? ':' + value : '')
            regla.push(validation)
        }
    }
    if(type && type in TYPES) {
        regla.unshift(TYPES[type])
    }
    return regla.join('|')
}

/**
 * Convierte un arreglo de inputs a arreglo de validaciones tipo
 * string de vee-validate
 * @param {object[]} inputs 
 */
export function parseInputs(inputs) {
    return inputs.map(input => parseRule(input.type, input))
}