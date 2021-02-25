import AxiosWrapper from "../Utility/AxiosWrapper.js"
import DataTypeUtility from "../Utility/DataTypeUtility.js"
import Validator from "../Utility/Validator.js"

export default class RegisterController {
    
    static async validateUsername(username) {
        return await AxiosWrapper.QuickPostRequest("../../User/target.php", "checkUsername", "username", username);
    }
}