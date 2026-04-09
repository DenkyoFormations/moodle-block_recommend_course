// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * TODO describe module init_email_placeholders
 *
 * @module     block_recommend_course/init_email_placeholders
 * @copyright  2026 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
/* global tinymce */
define(['jquery'], function($) {

    return {
        init: function(textareaid = 'id_email_body') {

            // Placeholder insert (same as before).
            $(document).on('click', '.insert-placeholder', function(e) {
                e.preventDefault();
                const value = $(this).data('value');

                // TinyMCE
                if (typeof tinymce !== 'undefined') {
                    let editor = tinymce.get(textareaid);
                    if (editor) {
                        editor.focus();
                        editor.insertContent(value);
                        return;
                    }
                }

                // Atto.
                let attoEditor = document.getElementById(textareaid + 'editable');
                if (attoEditor) {
                    attoEditor.focus();
                    document.execCommand('insertText', false, value);
                    return;
                }

                // Fallback.
                let textarea = $('#' + textareaid);
                if (textarea.length) {
                    textarea.val(textarea.val() + value);
                }
            });


            /**
             * Clean option buttons if atto editor loads
             */
            function cleanAtto() {
                $('.atto_image_button').closest('button').hide();
                $('.atto_media_button').closest('button').hide();
                $('.atto_managefiles_button').closest('button').hide();
                $('.atto_recordrtc_button').closest('button').hide();
                $('.atto_table_button').closest('button').hide();
            }


            /**
             * Clean option buttons if TinyMce editor loads
             */
function cleanTinyMCE() {

    const interval = setInterval(function() {

        if (typeof tinymce !== 'undefined' && tinymce.editors.length) {

            tinymce.editors.forEach(function(editor) {

                const container = $(editor.getContainer());

                if (container.length) {

                    // Hide buttons using data-mce-name (best way)
                    container.find('button[data-mce-name="tiny_media_image"]').hide();
                    container.find('button[data-mce-name="tiny_media_video"]').hide();
                    container.find('button[data-mce-name="tiny_h5p"]').hide();
                    container.find('button[data-mce-name="tiny_equation"]').hide();

                }
            });

        }

    }, 500); // runs every 500ms

}


            // ⏱ Run after load
            setTimeout(function() {
                cleanAtto();
                cleanTinyMCE();
            }, 1200);


            // 🔁 Re-run on focus
            $(document).on('focus', '.editor_atto_content', function() {
                cleanAtto();
            });

            $(document).on('focus', '.tox-edit-area iframe', function() {
                cleanTinyMCE();
            });

        }
    };
});