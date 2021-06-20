import axios from "../Utility/AxiosWrapper.js";

export default class AdminController
{
    // Active has to be true or false 
    static async getUsers(active) {
        let endpoint = active == "true" ? "/admin/user/active" : "/admin/user/inactive";
        let result = await axios.Get(endpoint);
        return result;
    }
}