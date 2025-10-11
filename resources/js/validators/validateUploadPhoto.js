import { showErrors } from "../helpers/showError";

let validate = true;

export const validateUpdatePhoto = (data, fields) => {
    validate = true;
    const errors = [];

    if(data.get('code') == ''){
        errors['code'] = 'El código es requerido';
        validate = false;
    }

    if(data.get('photo') == ''){
        errors['photo'] = 'La foto es requerida'
        validate = false;

    }
    
    showErrors(fields, errors);

    return validate;
}