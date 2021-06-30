export default class SummernoteWrapper {
    constructor(selector, placeholder, simple = false) {
        this.selector = selector;
        $(selector).summernote({
            placeholder: placeholder, 
            height: 125,
            toolbar: simple == false 
                     ? [ ['style', ['bold', 'italic', 'underline', 'clear']], ['font', ['strikethrough' ]], ['para', ['ul', 'ol']] ]
                     : [] ,
            popover: { image: [], link: [], air: [] }
        });
        $('.note-statusbar').hide();
        this.initalValue = this.getValue();
        return this;
    }
    
    onKeyDown(saveCallback, cancelCallback = null) {
        $(this.selector).on('summernote.keydown', (we, e) => {
            if(e.ctrlKey && e.code == "Enter") {
                this.value = $(this.selector).summernote('code');
                e.preventDefault();
                saveCallback();
            }
            if (cancelCallback != null) { 
                if(e.code == "Escape") cancelCallback(this.initalValue); 
            }
        });
    }

    getValue() {
        return $(this.selector).summernote('code');
    }

    setValue(value) {
        $(this.selector).summernote('code', value);
        return this;
    }

    Close(selector) {
        $(selector).summernote("destroy");
        return this;
    }
}