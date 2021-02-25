import AxiosWrapper from "../Utility/AxiosWrapper.js"

export default class RegisterController {
    
    static async validateUsername(username) {
        return await AxiosWrapper.QuickPostRequest("../User/target.php", "checkUsername", "username", username);
    }
}