/* Lamacupa admin.js */
jQuery(function ($) {
  // Image uploader
  $(document).on('click', '.lm-upload-btn', function (e) {
    e.preventDefault();
    var targetId = $(this).data('target');
    var frame = wp.media({
      title: 'Seleziona immagine',
      button: { text: 'Usa questa immagine' },
      multiple: false
    });
    frame.on('select', function () {
      var att = frame.state().get('selection').first().toJSON();
      $('#' + targetId).val(att.url);
    });
    frame.open();
  });
});
