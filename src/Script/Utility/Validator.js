export default class Validator {
    
    static validateNumber(string) {
        let numberValidator = /\d/;
        return numberValidator.test(string);
    }

    static validateSpecialCharacter(string) {
        let specialValidator = /^[A-Za-z0-9 ]+$/;
        return specialValidator.test(string);
    }

    static validateMinimumLength(string, length) {
        return string.length > length;
    }

    static validateMaximumLength(string, length) {
        return string.length < length;
    }
}