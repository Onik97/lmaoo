import axios from "../Utility/AxiosWrapper.js";

export default class Project 
{
    static async createProject(json)
    {
        let result = await axios.Post("/project/", json)
        return result;
    }

    static async createFeature(json)
    {
        let result = await axios.Post("/feature/",json);
        return result;
    }
}