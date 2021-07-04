import axios from "../Utility/AxiosWrapper.js";

export default class Project 
{
    static async createProject(json)
    {
        let result = await axios.Post("/project/", json)
        return result;
    }

        let result = await axios.Post(endpoint, data);
        return result;
    }
}