export const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=])(.{4,})$/;
export const regexLetters = /^[a-zA-ZáÁéÉíÍóÓúÚÑñ. -]+$/;
export const regexCode = /^[0-9]{7,9}$/;
export const regexLetrasHorario = /^[a-zA-Z0-9áÁéÉíÍóÓúÚÑñ\s-:,.]+$/;
export const regexHorario = /^\d{2}:\d{2}\s-\s\d{2}:\d{2}$/;
export const regexNumero = /^(?=.*\d)/;
export const regexFecha = /^\d{4}-\d{2}-\d{2}$/;
export const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
export const regexDecimal = /^(?=.*\d)(?:\d*\.\d+|\d+)$/;
export const regexDecimal_mayor = /^(?=.*\d)(?!0*\.0*$)\d*(?:\.\d+)?$/;
export const regexTelefono = /^[0-9]{10}$/;
export const regexArea = /^[a-zA-Z0-9áÁéÉíÍóÓúÚÑñ.,()# -]+$/;
export const regexRFC = /^([A-ZÑ&]{3,4})(\d{2})(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])([A-Z\d]{3})?$/i