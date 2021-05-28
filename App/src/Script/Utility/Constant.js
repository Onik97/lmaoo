export default class Constant {
    // User Constants
    static USER_PASSWORD_MIN = 5;
    static USER_USERNAME_MAX = 15;
    static USER_FORENAME_MAX = 15;
    static USER_SURNAME_MAX = 15;

    // Project Constants
    static PROJECT_NAME_MAX = 20;
    static PROJECT_STATUS_MAX = 20
    
    // Feature Constants
    static FEATURE_NAME_MAX = 50;
    
    // Ticket Constants
    static TICKET_SUMMARY_MAX = 50;
    static TICKET_PROGRESS_MAX = 20; // May make a seperate enum for this
    
    // Comment Constants
    static COMMENT_CONTENT_MAX = 255;
}