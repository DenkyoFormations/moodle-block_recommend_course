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
define(['jquery'], function($) {

    return {
        init: function() {

            /**
             * Get the TinyMCE editor instance for the email body field.
             *
             * This function checks if TinyMCE is loaded on the page and
             * returns the editor instance associated with the textarea
             * having ID `id_email_body`. If TinyMCE is not available or
             * the editor is not initialized, it returns null.
             *
             * @function getEditor
             * @returns {tinymce.Editor|null} The TinyMCE editor instance if available, otherwise null.
             */
            function getEditor() {
                if (typeof window.tinymce !== 'undefined') {
                    return window.tinymce.get('id_email_body');
                }
                return null;
            }

            $(document).on('click', '.insert-placeholder', function(e) {
                e.preventDefault();

                let value = $(this).data('value');

                let attempts = 0;

                let interval = setInterval(function() {
                    let editor = getEditor();

                    if (editor) {
                        editor.focus();
                        editor.insertContent(value);
                        clearInterval(interval);
                    }

                    attempts++;

                    if (attempts > 10) { // Stop after ~2 seconds
                        clearInterval(interval);

                        // Fallback
                        let textarea = $('#id_email_body');
                        if (textarea.length) {
                            textarea.val(textarea.val() + value);
                        }
                    }

                }, 200);
            });

        }
    };

});