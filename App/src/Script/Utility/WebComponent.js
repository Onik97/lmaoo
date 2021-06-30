export default class WebComponent {
    static Assignee(selector, assignees) {
        $(selector).html("<option value='0' selected disabled>Select user</option>"); // To avoid duplicates
        assignees.forEach(assignee => {
            let { userId, forename, surname, username } = assignee;
            $(selector).append(`<option value="${userId}">${forename} ${surname} (${username})</option>`);
        });
    }
}