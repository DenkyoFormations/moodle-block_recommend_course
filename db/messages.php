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
 * Defines message providers (types of messages being sent) for Recommend a course
 *
 * @package    block_recommend_course
 * @category   message
 * @copyright  2026 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

$messageproviders = [

    'recommendation_both' => [
        'defaults' => [
            'popup' => MESSAGE_PERMITTED,
            'email' => MESSAGE_PERMITTED,
        ],
    ],

    'recommendation_popup' => [
        'defaults' => [
            'popup' => MESSAGE_PERMITTED,
            'email' => MESSAGE_DISALLOWED,
        ],
    ],

    'recommendation_email' => [
        'defaults' => [
            'popup' => MESSAGE_DISALLOWED,
            'email' => MESSAGE_PERMITTED,
        ],
    ],
];
