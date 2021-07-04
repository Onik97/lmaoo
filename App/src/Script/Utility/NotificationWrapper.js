export default class NotificationWrapper { 
    static successMessage(message) {
        const myNotification = window.createNotification({
              theme: "success",
              showDuration: 3500,
              displayCloseButton: true,
              closeOnClick: true
        });
        myNotification({ message: message });
    }

    static errorMessage(message) {
        const myNotification = window.createNotification({
              theme: "error",
              showDuration: 3500,
              displayCloseButton: true,
              closeOnClick: true
        });
        myNotification({ message: message });
    }

    static warnMessage(message) {
        const myNotification = window.createNotification({
              theme: "warn",
              showDuration: 3500,
              displayCloseButton: true,
              closeOnClick: true
        });
        myNotification({ message: message });
    }
}