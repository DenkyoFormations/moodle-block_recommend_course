<?php
// phpcs:disable moodle.Files.FileHeader.Missing
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Email settings management page for Recommend Course block.
 *
 * @package    block_recommend_course
 * @copyright  2026 Justaddwater <contact@justaddwater.in>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
// phpcs:enable
require('../../config.php');
require_once('recommend_course_settings_form.php');

require_login();

// Restrict to admin only.
require_capability('moodle/site:config', context_system::instance());

$url = new moodle_url('/blocks/recommend_course/setting.php');
$PAGE->set_url($url);
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Recommend Course Settings');
$PAGE->requires->js_call_amd('block_recommend_course/init_email_placeholders', 'init');

// Create Form Class.


// Instantiate form.
$mform = new recommend_course_settings_form();

// Handle form submit.
if ($mform->is_cancelled()) {
    redirect(new moodle_url('/my'));
} else if ($data = $mform->get_data()) {
    // Save notification toggle.
    set_config('send_notification', $data->send_notification, 'block_recommend_course');

    // Save email toggle.
    set_config('send_email', $data->send_email, 'block_recommend_course');

    // Save email body (editor).
    $emailbody = $data->email_body['text'];
    set_config('email_body', $emailbody, 'block_recommend_course');

    redirect($PAGE->url, 'Settings saved successfully', null, \core\output\notification::NOTIFY_SUCCESS);
}

// Load existing values.
$toform = new stdClass();

$toform->send_notification = get_config('block_recommend_course', 'send_notification');
$toform->send_email = get_config('block_recommend_course', 'send_email');

$toform->email_body = [
    'text' => get_config('block_recommend_course', 'email_body'),
    'format' => FORMAT_HTML,
];

$mform->set_data($toform);

// Output.
echo $OUTPUT->header();

echo $OUTPUT->heading('Recommend Course Settings');

$mform->display();

echo $OUTPUT->footer();
