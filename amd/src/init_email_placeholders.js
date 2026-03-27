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

            $(document).on('click', '.insert-placeholder', function(e) {
                e.preventDefault();
                const value = $(this).data('value');
                // Try TinyMCE.
                if (typeof tinymce !== 'undefined') {
                    let editor = tinymce.get(textareaid);
                    if (editor) {
                        editor.focus();
                        editor.insertContent(value);
                        return;
                    }
                }

                // Try Atto Editor.
                let attoEditor = document.getElementById(textareaid + 'editable');
                if (attoEditor) {
                    attoEditor.focus();
                    // Insert at cursor.
                    if (document.execCommand) {
                        document.execCommand('insertText', false, value);
                    } else {
                        attoEditor.innerHTML += value;
                    }
                    return;
                }
                // Fallback (textarea).
                let textarea = $('#' + textareaid);
                if (textarea.length) {
                    textarea.val(textarea.val() + value);
                }
            });
        }
    };
});