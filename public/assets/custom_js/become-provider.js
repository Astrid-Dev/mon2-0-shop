let imageUrl = null;
const logoPreview = $('#logo-preview');
const logoPlaceholder = $('#logo-placeholder');
// logoPreview.hide();

function fileChosen(event) {
    console.log(event)
    fileToDataUrl(event, (src) => {
        // logoPlaceholder.hide();
        logoPreview.attr('src', src);
        // logoPreview.show();
    });
}

function fileToDataUrl(event, callback) {
    if (!event.target.files.length) return;

    let file = event.target.files[0],
        reader = new FileReader();

    reader.readAsDataURL(file);
    reader.onloadend = function () {
        console.log(this.result);
        logoPreview.attr('src', this.result);
    }
}
