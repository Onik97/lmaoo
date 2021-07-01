import axios from "../Utility/AxiosWrapper.js";

export default class TicketController {
    static async updateTicket(json) {
        let results = await axios.Put("/ticket", json);
        return results;
    }

    static async loadAssignees() {
        let results = await axios.Get("/ticket/assignee");
        return results;
    }

    static async createComment(json) {
        let result = axios.Post("/ticket/comment", json);
        return result;
    }
    
    static async updateComment(json) {
        let result = axios.Put("/ticket/comment", json);
        return result;
    }

    static async deleteComment(id) {
        let result = axios.Delete(`/ticket/comment/${id}`);
        return result;
    }
}