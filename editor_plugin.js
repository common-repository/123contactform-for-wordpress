(function() {
    var checkForGutenbergOnPage = document.body.classList.contains( 'block-editor-page' );
    if ( checkForGutenbergOnPage !== true ) {
        tinymce.create('tinymce.plugins.contact_123', {
            init : function(ed, url){
                ed.addCommand('123_embed_window', function() {
                    tb_show('', url + '/dialog-modal.php?TB_iframe=true&width=600&height=550');
                    set123DialogModalCss();
                });
                ed.addButton('123contactform', {
                    title : 'Insert form',
                    cmd : '123_embed_window',
                    image: url + "/123logo.png"
                });
            },
    
            getInfo : function() {
                return {
                    longname : '123FormBuilder for Wordpress plugin',
                    author : '123FormBuilder',
                    authorurl : 'https://www.123formbuilder.com',
                    infourl : '',
                    version : "1.2.0"
                };
            }
        });
    
        tinymce.PluginManager.add('contact_123', tinymce.plugins.contact_123);
    }
    
})();
