import axios from "../Utility/AxiosWrapper.js";

export default class Project 
{
    static async createFeature()
    {
        let projectId = new URL(window.location.href).searchParams.get("projectId");
        let name = $("#projectName").text();

        let data = [{"name" : name, "projectId" : projectId}]
        let endpoint = "/feature/"

        let result = await axios.Post(endpoint, data);
        return result;
    }
}