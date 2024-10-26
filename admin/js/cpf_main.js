window.shortcode123 = '';
function cpfInsertShortcodeIntoEditor(shortcode, api_key) {
    var tinymce = top.window.tinyMCE;

    code = '[123-form-builder i'+shortcode+']';
    if (api_key) {
        if (api_key.indexOf('EU.') > -1 || api_key.indexOf('EU-') > -1 ) {
            code = '[123-form-builder-eu i' + shortcode + ']';
        }
    }
    window.shortcode123 = code;

    if (tinymce) {
        tinymce.execCommand('mceInsertContent', false, code);
        tinymce.execCommand('mceRepaint');
    }

}

window.addEventListener("message", receiveMessage, false);

function receiveMessage(event) {
    if (event && event.data && Array.isArray(event.data)) {
        cpfInsertShortcodeIntoEditor(event.data[0], event.data[1]);
    }
};

function set123DialogModalCss() {
    document.getElementById('TB_window').classList.add("captainForm123DialogModal");
    document.querySelector('.captainForm123DialogModal').style.zIndex = '550000';

    document.querySelector('.captainForm123DialogModal').style.height = '250px';
    document.querySelector('.captainForm123DialogModal').style.width = '500px';
    document.querySelector('.captainForm123DialogModal').style.marginLeft = '-250px';
    document.querySelector('.captainForm123DialogModal').style.marginTop = '150px';
}
