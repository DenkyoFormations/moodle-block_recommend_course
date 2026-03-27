<?php
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
 * TODO describe file settings_form
 *
 * @package    block_recommend_course
 * @copyright  2026 Justaddwater <contact@justaddwater.in>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir . '/formslib.php');
/**
 * Form for recommending a course to selected users.
 *
 * @package    block_recommend_course
 * @category   form
 */
class recommend_course_settings_form extends moodleform {
    /**
     * Add elements to form
     */
    public function definition() {
        $mform = $this->_form;

        // Send Notification Toggle.
        $notification = $mform->createElement(
            'advcheckbox',
            'send_notification',
            '',
            '&nbsp;' . get_string('enable', 'block_recommend_course')
        );

        $mform->addGroup(
            [$notification],
            'send_notification_group',
            get_string('sendnotification', 'block_recommend_course'),
            [' '],
            false
        );

        $mform->setDefault('send_notification', 1);

        // Help button (group).
        $mform->addHelpButton('send_notification_group', 'sendnotification', 'block_recommend_course');

        // Send Notification Toggle.
        $notification = $mform->createElement(
            'advcheckbox',
            'send_email',
            '',
            '&nbsp;' . get_string('enable', 'block_recommend_course')
        );

        $mform->addGroup(
            [$notification],
            'send_email_group',
            get_string('sendemail', 'block_recommend_course'),
            [' '],
            false
        );

        $mform->setDefault('send_email', 1);

        // Help button (group).
        $mform->addHelpButton('send_email_group', 'sendemail', 'block_recommend_course');

        // Email Body Editor.
        $editoroptions = [
        'maxfiles' => 0,
        'context' => context_system::instance(),
        ];

        $mform->addElement(
            'editor',
            'email_body',
            get_string('emailbody', 'block_recommend_course'),
            null,
            $editoroptions
        );

        $mform->setType('email_body', PARAM_RAW);

        // Help button.
        $mform->addHelpButton('email_body', 'emailbody', 'block_recommend_course');

        // Placeholders.
        $mform->addElement(
            'static',
            'placeholders',
            '',
            '<strong>' . get_string('availableplaceholders', 'block_recommend_course') . '</strong><br>
        <a href="#" class="insert-placeholder" data-value="[course_name]"><code>[course_name]</code></a><br>
        <a href="#" class="insert-placeholder" data-value="[recommended_by]"><code>[recommended_by]</code></a>'
        );

        // Submit.
        $this->add_action_buttons(true, get_string('savesettings', 'block_recommend_course'));
    }
}
