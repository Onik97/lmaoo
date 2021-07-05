export default class WebComponent {
    static Comment(selector, comment) {
        let { commentId, commentContent, commentCreated, forename, surname, picture } = comment; 
        $(selector).append(`
                <div class='row'>
                    <div class='col-1'>
                        <div id='commentThumbnail'>
                            <img class='profilePicture mt-1' src=${picture}'>
                        </div>
                    </div>

                    <div class='col-8'>
                        <div id='commentBody' class='mt-2 ml-2'>
                            <h6>${forename} ${surname}</h6>
                            <span>${commentCreated}</span>
                        </div>

                        <div id='mainComment${commentId}' class='ml-2'>${commentContent}</div>
                    </div>
                
                    <div class='col-2 mt-2 ml-5' id='commentActions'>
                        <img class='CommentImages deleteComment' src='/Images/trash.svg' value='${commentId}' role='button'>
                        <img class='CommentImages editComment' src='/Images/pencilsquare.svg' value='${commentId}' role='button'>
                    </div>
                </div>
            `);
    }

    static Assignee(selector, assignees) {
        $(selector).html("<option value='0' selected disabled>Select user</option>"); // To avoid duplicates
        assignees.forEach(assignee => {
            let { userId, forename, surname, username } = assignee;
            $(selector).append(`<option value="${userId}">${forename} ${surname} (${username})</option>`);
        });
    }
}