import axios from "../Utility/AxiosWrapper.js";

export default class TicketController {
    static async loadAssignees() {
        let results = await axios.Get("/ticket/assignee");
        return results;
    }
}