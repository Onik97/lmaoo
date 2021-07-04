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
    static async updateFeature(json)
    {
        let result = await axios.Put("/feature/", json);
        return result;
    }
    static async deleteFeature(featureId)
    {
        let result = await axios.Delete("/feature/", featureId);
        return result;
    }
}