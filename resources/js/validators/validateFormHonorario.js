import { regexCode, regexCorreo, regexLetters, regexRFC } from "../helpers/regex";
import { showErrors } from "../helpers/showError";
import { parseISO, isBefore, isAfter } from 'date-fns';

let validate = true;

export const validateFormHonorario = (data, fields) => {
    validate = true;
    const errors = [];

    if (data.get('name') == '') {
        errors['name'] = 'El nombre es obligatorio';
        validate = false;
    }

    if (data.get('code') == '') {
        errors['code'] = 'El código ha sido modificado, vuelva a recargar la página';
        validate = false;
    }

    if (data.get('code') !== '' && !regexCode.test(data.get('code'))) {
        errors['code'] = 'El código ha sido modificado, vuelva a recargar la página';
        validate = false;
    }

    if (data.get('name') != '' && !regexLetters.test(data.get('name'))) {
        errors['name'] = 'El nombre tiene carácteres inválidos';
        validate = false;
    }

    if (data.get('gender') == '') {
        errors['gender'] = 'El género es obligación';
        validate = false;
    }

    if (data.get('email') != '' && !regexCorreo.test(data.get('email'))) {
        errors['email'] = 'El correo no es válido';
        validate = false;
    }

    if (data.get('birthdate') == '') {
        errors['birthdate'] = 'La fecha de nacimiento es obligatoria';
        validate = false;
    }

    if (data.get('entry_date') === '') {
        errors['entry_date'] = 'La fecha de ingreso a la UDG es obligatorio';
        validate = false;
    }


    if (data.get('degree_of_studies') === '' || data.get('degree_of_studies') === null) {
        errors['degree_of_studies'] = 'El grado de estudios es obligatorio';
        validate = false;
    }

    if (data.get('responsible') === '') {
        errors['responsible'] = 'El responsable es obligatorio';
        validate = false;
    }

    if (data.get('responsible') !== '' && !regexLetters.test(data.get('responsible'))) {
        errors['responsible'] = 'El responsable tiene carácteres inválidos';
        validate = false;
    }

    if (data.get('rfc') === '') {
        errors['rfc'] = 'El RFC es obligatorio';
        validate = false;
    }

    if (data.get('rfc') !== '' && !regexRFC.test(data.get('rfc'))) {
        errors['rfc'] = 'El RFC es inválido';
        validate = false;
    }

    if (data.get('area') === '') {
        errors['area'] = 'El área de asignación es obligatoria';
        validate = false;
    }

    // Validacion para las fechas de nacimiento e ingreso a la universidad
    const now = new Date();
    const birthdate = parseISO(data.get('birthdate'));
    const entryDate = parseISO(data.get('entry_date'));
    
    // Verifica que ambas fechas no sean futuras
    if (isAfter(birthdate, now)) {
        errors['birthdate'] = 'La fecha de nacimiento no puede ser en el futuro';
        validate = false;
    }

    if (isAfter(entryDate, now)) {
        errors['entry_date'] = 'La fecha de ingreso a la UDG no puede ser en el futuro';
        validate = false;
    }
    
    if (isBefore(entryDate, birthdate)) {
        errors['entry_date'] = 'La fecha de ingreso a la UDG debe ser mayo a la fecha de nacimiento';
        validate = false;
    }
    
    showErrors(fields, errors);

    return validate;
}