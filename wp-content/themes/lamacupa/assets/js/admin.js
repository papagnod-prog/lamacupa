/**
 * Lamacupa Admin JS
 * Tab switching, color picker, media uploader
 */

(function($) {
    'use strict';

    // ============================================================
    // COLOR PICKERS
    // ============================================================
    function initColorPickers() {
        $('.lamacupa-color-picker').each(function() {
            $(this).wpColorPicker({
                change: function(event, ui) {
                    // live preview could be added here
                },
                clear: function() {}
            });
        });
    }

    // ============================================================
    // MEDIA UPLOADER
    // ============================================================
    function initMediaUploader() {
        $(document).on('click', '.lamacupa-upload-btn', function(e) {
            e.preventDefault();

            var targetId   = $(this).data('target');
            var previewId  = $(this).data('preview');
            var $input     = $('#' + targetId);
            var $wrap      = $('#' + previewId + '-wrap');

            var mediaFrame = wp.media({
                title:    'Seleziona o carica immagine',
                button:   { text: 'Usa questa immagine' },
                multiple: false
            });

            mediaFrame.on('select', function() {
                var attachment = mediaFrame.state().get('selection').first().toJSON();
                var url = attachment.url;

                // Update hidden input
                $input.val(url);

                // Update or create preview
                var $preview = $wrap.find('.lamacupa-image-preview');
                if ($preview.length) {
                    $preview.find('img').attr('src', url);
                } else {
                    $wrap.prepend(
                        '<div class="lamacupa-image-preview">' +
                        '<img src="' + url + '" style="max-height:80px;max-width:200px;display:block;margin-bottom:8px;">' +
                        '</div>'
                    );
                }

                // Show remove button if not present
                if (!$wrap.find('.lamacupa-remove-img').length) {
                    $wrap.find('.lamacupa-upload-btn').after(
                        ' <button type="button" class="button lamacupa-remove-img" ' +
                        'data-target="' + targetId + '" data-preview="' + previewId + '">Rimuovi</button>'
                    );
                }
            });

            mediaFrame.open();
        });

        // Remove image
        $(document).on('click', '.lamacupa-remove-img', function(e) {
            e.preventDefault();
            var targetId  = $(this).data('target');
            var previewId = $(this).data('preview');

            $('#' + targetId).val('');
            $('#' + previewId + '-wrap').find('.lamacupa-image-preview').remove();
            $(this).remove();
        });
    }

    // ============================================================
    // SAVE FEEDBACK
    // ============================================================
    function initSaveFeedback() {
        $('form').on('submit', function() {
            var $btn = $('#lamacupa-save-btn');
            if ($btn.length) {
                $btn.val('Salvataggio in corso...').prop('disabled', true);
            }
        });
    }

    // ============================================================
    // IMPORT TOOL: XML IMPORT
    // ============================================================
    function initXmlImport() {
        $('#lamacupa-xml-import-form').on('submit', function(e) {
            e.preventDefault();
            var $form    = $(this);
            var $btn     = $form.find('.lamacupa-import-btn');
            var $progress = $form.find('.lamacupa-progress');
            var $results  = $form.find('.lamacupa-results');
            var $feedback = $form.find('.lamacupa-feedback');

            var fileInput = $form.find('input[type="file"]')[0];
            if (!fileInput || !fileInput.files.length) {
                alert('Seleziona un file XML/WXR da importare.');
                return;
            }

            var formData = new FormData($form[0]);
            formData.append('action', 'lamacupa_import_xml');

            $btn.prop('disabled', true).text('Importazione...');
            $progress.show();
            $progress.find('.lamacupa-progress-bar__fill').css('width', '30%');
            $progress.find('.lamacupa-progress-text').text('Caricamento file...');
            $results.html('');
            $feedback.hide();

            $.ajax({
                url:         lamacupaAdmin.ajaxurl,
                type:        'POST',
                data:        formData,
                contentType: false,
                processData: false,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(evt) {
                        if (evt.lengthComputable) {
                            var pct = Math.round((evt.loaded / evt.total) * 60) + 30;
                            $progress.find('.lamacupa-progress-bar__fill').css('width', pct + '%');
                        }
                    });
                    return xhr;
                },
                success: function(response) {
                    $progress.find('.lamacupa-progress-bar__fill').css('width', '100%');
                    $progress.find('.lamacupa-progress-text').text('Completato.');
                    $btn.prop('disabled', false).text('Importa XML');

                    if (response.success) {
                        $feedback.removeClass('lamacupa-feedback--error')
                                 .addClass('lamacupa-feedback--success')
                                 .html(response.data.message)
                                 .show();
                        if (response.data.rows) {
                            renderResultsTable($results, response.data.rows);
                        }
                    } else {
                        showError($feedback, response.data ? response.data.message : 'Errore sconosciuto.');
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).text('Importa XML');
                    showError($feedback, 'Errore di connessione: ' + xhr.statusText);
                }
            });
        });
    }

    // ============================================================
    // IMPORT TOOL: CSV IMPORT
    // ============================================================
    function initCsvImport() {
        $('#lamacupa-csv-import-form').on('submit', function(e) {
            e.preventDefault();
            var $form    = $(this);
            var $btn     = $form.find('.lamacupa-import-btn');
            var $progress = $form.find('.lamacupa-progress');
            var $results  = $form.find('.lamacupa-results');
            var $feedback = $form.find('.lamacupa-feedback');

            var fileInput = $form.find('input[type="file"]')[0];
            if (!fileInput || !fileInput.files.length) {
                alert('Seleziona un file CSV da importare.');
                return;
            }

            var formData = new FormData($form[0]);
            formData.append('action', 'lamacupa_import_csv');

            $btn.prop('disabled', true).text('Importazione in corso...');
            $progress.show();
            $progress.find('.lamacupa-progress-bar__fill').css('width', '20%');
            $progress.find('.lamacupa-progress-text').text('Elaborazione CSV...');
            $feedback.hide();

            $.ajax({
                url:         lamacupaAdmin.ajaxurl,
                type:        'POST',
                data:        formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $progress.find('.lamacupa-progress-bar__fill').css('width', '100%');
                    $progress.find('.lamacupa-progress-text').text('Completato.');
                    $btn.prop('disabled', false).text('Importa CSV');

                    if (response.success) {
                        $feedback.removeClass('lamacupa-feedback--error')
                                 .addClass('lamacupa-feedback--success')
                                 .html(response.data.message)
                                 .show();
                        if (response.data.rows) {
                            renderResultsTable($results, response.data.rows);
                        }
                    } else {
                        showError($feedback, response.data ? response.data.message : 'Errore sconosciuto.');
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).text('Importa CSV');
                    showError($feedback, 'Errore di connessione: ' + xhr.statusText);
                }
            });
        });
    }

    // ============================================================
    // IMPORT TOOL: ZIP IMPORT
    // ============================================================
    function initZipImport() {
        $('#lamacupa-zip-import-form').on('submit', function(e) {
            e.preventDefault();
            var $form    = $(this);
            var $btn     = $form.find('.lamacupa-import-btn');
            var $progress = $form.find('.lamacupa-progress');
            var $results  = $form.find('.lamacupa-results');
            var $feedback = $form.find('.lamacupa-feedback');

            var fileInput = $form.find('input[type="file"]')[0];
            if (!fileInput || !fileInput.files.length) {
                alert('Seleziona un file ZIP da importare.');
                return;
            }

            var formData = new FormData($form[0]);
            formData.append('action', 'lamacupa_import_zip');

            $btn.prop('disabled', true).text('Estrazione in corso...');
            $progress.show();
            $progress.find('.lamacupa-progress-bar__fill').css('width', '10%');
            $progress.find('.lamacupa-progress-text').text('Caricamento archivio...');
            $feedback.hide();

            $.ajax({
                url:         lamacupaAdmin.ajaxurl,
                type:        'POST',
                data:        formData,
                contentType: false,
                processData: false,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(evt) {
                        if (evt.lengthComputable) {
                            var pct = Math.round((evt.loaded / evt.total) * 50) + 10;
                            $progress.find('.lamacupa-progress-bar__fill').css('width', pct + '%');
                            $progress.find('.lamacupa-progress-text').text('Caricamento: ' + pct + '%');
                        }
                    });
                    return xhr;
                },
                success: function(response) {
                    $progress.find('.lamacupa-progress-bar__fill').css('width', '100%');
                    $progress.find('.lamacupa-progress-text').text('Importazione completata.');
                    $btn.prop('disabled', false).text('Importa ZIP');

                    if (response.success) {
                        $feedback.removeClass('lamacupa-feedback--error')
                                 .addClass('lamacupa-feedback--success')
                                 .html(response.data.message)
                                 .show();
                        if (response.data.rows) {
                            renderResultsTable($results, response.data.rows);
                        }
                    } else {
                        showError($feedback, response.data ? response.data.message : 'Errore sconosciuto.');
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).text('Importa ZIP');
                    showError($feedback, 'Errore di connessione: ' + xhr.statusText);
                }
            });
        });
    }

    // ============================================================
    // HELPERS
    // ============================================================
    function showError($el, msg) {
        $el.removeClass('lamacupa-feedback--success')
           .addClass('lamacupa-feedback lamacupa-feedback--error')
           .html('<strong>Errore:</strong> ' + msg)
           .show();
    }

    function renderResultsTable($container, rows) {
        var html = '<table><thead><tr><th>Elemento</th><th>Stato</th><th>Note</th></tr></thead><tbody>';
        $.each(rows, function(i, row) {
            var cls = row.status === 'ok' ? 'status-ok' : (row.status === 'error' ? 'status-error' : 'status-skip');
            html += '<tr>' +
                    '<td>' + escapeHtml(row.name || '') + '</td>' +
                    '<td class="' + cls + '">' + escapeHtml(row.status || '') + '</td>' +
                    '<td>' + escapeHtml(row.note || '') + '</td>' +
                    '</tr>';
        });
        html += '</tbody></table>';
        $container.html(html);
    }

    function escapeHtml(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    // ============================================================
    // DOCUMENT READY
    // ============================================================
    $(document).ready(function() {
        initColorPickers();
        initMediaUploader();
        initSaveFeedback();
        initXmlImport();
        initCsvImport();
        initZipImport();
    });

})(jQuery);
