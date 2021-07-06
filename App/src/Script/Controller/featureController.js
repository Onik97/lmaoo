import axios from "../Utility/AxiosWrapper.js";

export default class Feature {

    static async createFeature(json) {
        let result = await axios.Post("/feature",json);
        return result;
    }

    static async readFeature(featureId) {
        let result = await axios.Get(`/feature/${featureId}`);
        return result[0];
    }

    static async updateFeature(json) {
        let result = await axios.Put("/feature", json);
        return result;
    }
}