export default class SummernoteWrapper {
    static Load(selector, placeholder) {
        $(selector).summernote({
            placeholder: placeholder, 
            height: 125,
            toolbar: [ ['style', ['bold', 'italic', 'underline', 'clear']], ['font', ['strikethrough' ]], ['para', ['ul', 'ol']] ],
            popover: { image: [], link: [], air: [] }
        });
        $('.note-statusbar').hide();
        return this;
    }

    static onKeyDown(selector, callback) {
        $(selector).on('summernote.keydown', (we, e) => callback());
        return this;
    }

    static getValue(selector) {
        return $(selector).summernote('code');
    }

    static setValue(selector, value) {
        $(selector).summernote('code', value);
        return this;
    }

    static Close(selector) {
        $(selector).summernote("destroy");
        return this;
    }
}