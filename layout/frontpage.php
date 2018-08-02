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
 * Frontpage Layout.
 * @package    theme_unicundi
 * @copyright  2015 onwards LMSACE Dev Team (http://www.lmsace.com)
 * @author    LMSACE Dev Team
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir . '/behat/lib.php');
if (isloggedin() && !behat_is_test_site()) {

}else{
	require_login();
}

// Get the HTML for the settings bits.
$html = theme_unicundi_get_html_for_settings($OUTPUT, $PAGE);
if (right_to_left()) {
    $regionbsid = 'region-bs-main-and-post';
} else {
    $regionbsid = 'region-bs-main-and-pre';
}
echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body <?php echo $OUTPUT->body_attributes(); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<?php
    // Header file included.
    require_once(dirname(__FILE__) . '/includes/header.php');
?>
<?php
    // Theme bootstrap carousel js files are added into moodle.
    $PAGE->requires->js('/theme/unicundi/javascript/bootstrap-carousel.js');
    $PAGE->requires->js('/theme/unicundi/javascript/bootstrap-transition.js');
?>
<!--=========== Slideshow section start here ===========-->
<div>
<?php
    $toggleslideshow = theme_unicundi_get_setting('toggleslideshow');
if ($toggleslideshow == 1) {
    require_once(dirname(__FILE__) . '/includes/slideshow.php');
} else {
    echo "<br/><br/>";
}
?>
</div>
<!--=========== Slideshow section start here ===========-->
<!--Slider-->

<!-- Main Moodle Main Contents -->
<div id="page" class="container">

    <?php
        echo $OUTPUT->full_header_frontpage();
    ?>
    
    <div id="page-content" class="row">

    <?php
    if (!empty($OUTPUT->blocks_for_region('side-pre'))) {
        $class = "col-md-9";
    } else {
        $class = "col-md-12";
    }
    ?>

    <div id="<?php echo $regionbsid ?>" class="<?php echo $class; ?>" >
        <?php
                echo $OUTPUT->course_content_header();
                echo '<div style="border: 1px solid #e9e9e9;">';
                echo $OUTPUT->anuncios();
                echo $OUTPUT->main_content();
                echo '</div>';
                echo $OUTPUT->course_content_footer();
        ?>
    </div>
    <?php echo $OUTPUT->blocks('side-pre', 'col-md-3'); ?>
    </div>
    <?php echo (!empty($flatnavbar)) ? $flatnavbar : ""; ?>
</div>
<?php  require_once(dirname(__FILE__) . '/includes/footer.php');  ?>
</body>
</html>
