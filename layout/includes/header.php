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
 * Version details
 *
 * @package    theme
 * @subpackage bcu
 * @copyright  2014 Birmingham City University <michael.grant@bcu.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

theme_bcu_initialise_zoom($PAGE);
$setzoom = theme_bcu_get_zoom();

theme_bcu_initialise_full($PAGE);
$setfull = theme_bcu_get_full();

$left = (!right_to_left());  // To know if to add 'pull-right' and 'desktop-first-column' classes in the layout for LTR.

$hasmiddle = $PAGE->blocks->region_has_content('middle', $OUTPUT);
$hasfootnote = (!empty($PAGE->theme->settings->footnote));
$haslogo = (!empty($PAGE->theme->settings->logo));

// Get the HTML for the settings bits.
$html = theme_bcu_get_html_for_settings($OUTPUT, $PAGE);

if (right_to_left()) {
    $regionbsid = 'region-bs-main-and-post';
} else {
    $regionbsid = 'region-bs-main-and-pre';
}

echo $OUTPUT->doctype();
?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <link href='//fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body <?php echo $OUTPUT->body_attributes(array('two-column', $setzoom)); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>
<div id="page" class="container-fluid <?php echo "$setfull"; ?>">
    
<?php if (core\session\manager::is_loggedinas()) { ?>
<div class="customalert">
<div class="container">
<?php echo $OUTPUT->login_info(); ?>
</div>
</div>

<?php
} else if (!empty($PAGE->theme->settings->alertbox)) {
?>
<div class="customalert">
<div class="container">
<?php echo $PAGE->theme->settings->alertbox; ?>
</div>
</div>
<?php
}
?>

<div id="page-header-wrapper">

<div id="above-header">
    <div class="clearfix container userhead">
    
    <div class="pull-left">
    <?php echo $OUTPUT->user_menu(); ?> 
    </div>
    
    <div class="headermenu row">
   <?php if (!isloggedin() || isguestuser()) { ?>
   <?php echo $OUTPUT->page_heading_menu(); ?>
   <?php echo $OUTPUT->login_info() ?>
   <?php echo $OUTPUT->lang_menu(); ?>
   <?php } else { ?>
    <div class="dropdown secondone">
    <a class="dropdown-toggle usermendrop" data-toggle="dropdown" href="#"><span class="fa fa-user"></span><?php echo fullname($USER) ?> <span class="fa fa-angle-down"></span></a>
    <ul class="dropdown-menu usermen" role="menu" aria-labelledby="dropdownMenu2">
<?php if (!empty($PAGE->theme->settings->enablemy)) { ?>
<li><a href="<?php p($CFG->wwwroot) ?>/my" title="My Dashboard"><i class="fa fa-dashboard"></i><?php echo get_string('myhome') ?></a></li>
<?php } ?>
<?php if (!empty($PAGE->theme->settings->enableprofile)) { ?>
<li><a href="<?php p($CFG->wwwroot) ?>/user/profile.php" title="View profile"><i class="fa fa-user"></i><?php echo get_string('viewprofile') ?></a></li>
<?php } ?>
<?php if (!empty($PAGE->theme->settings->enableeditprofile)) { ?>
<li><a href="<?php p($CFG->wwwroot) ?>/user/edit.php" title="Edit profile"><i class="fa fa-cog"></i><?php echo get_string('editmyprofile') ?></a></li>
<?php } ?>

<?php if (!empty($PAGE->theme->settings->enableprivatefiles)) { ?>
<li><a href="<?php p($CFG->wwwroot) ?>/user/files.php" title="private files"><i class="fa fa-file"></i><?php echo get_string('privatefiles', 'block_private_files') ?></a></li>
<?php } ?>

<?php  if (!empty($PAGE->theme->settings->enablebadges)) { ?>
<li><a href="<?php p($CFG->wwwroot) ?>/badges/mybadges.php" title="badges"><i class="fa fa-certificate"></i><?php echo get_string('badges') ?></a></li>
<?php } ?>

<?php if (!empty($PAGE->theme->settings->enablecalendar)) { ?>
<li><a href="<?php p($CFG->wwwroot) ?>/calendar/view.php" title="Calendar"><i class="fa fa-calendar"></i><?php echo get_string('pluginname', 'block_calendar_month') ?></a></li>
<?php } ?>
<li><a href="<?php p($CFG->wwwroot) ?>/login/logout.php" title="Log out"><i class="fa fa-lock"></i><?php echo get_string('logout') ?></a></li>
    </ul>
    </div>
   <?php } ?>
    </div>      
    </div>
</div>

    <header id="page-header" class="clearfix container">
        <?php if ($haslogo) { ?>
            <a href="<?php p($CFG->wwwroot) ?>"><?php echo "<img src='".$PAGE->theme->setting_file_url('logo', 'logo')."' alt='logo' id='logo' />"; echo "</a>";
        } else { ?>
            <a href="<?php p($CFG->wwwroot) ?>"><img src="<?php echo $OUTPUT->pix_url('2xlogo', 'theme')?>" id="logo"></a>
        <?php } ?>
     
   
     
     <div id="coursetitle" class="pull-left">
     <span title='<?php echo $PAGE->heading ?>'><?php echo $PAGE->heading ?></span>
     </div>
     
        <div class="searchbox">
            <form action="<?php p($CFG->wwwroot) ?>/course/search.php">
                <label class="hidden" for="search-1" style="display: none;">Search iCity</label>
                <div class="search-box grey-box bg-white clear-fix">
                    <input placeholder="Search courses" accesskey="6" class="search_tour bg-white no-border left search-box__input ui-autocomplete-input" type="text" name="search" id="search-1" autocomplete="off">
                    <button type="submit" class="no-border bg-white pas search-box__button"><abbr class="fa fa-search"></abbr></button>
                </div>
            </form>
        </div>
                  
        <div id="course-header">
            <?php echo $OUTPUT->course_header(); ?>
        </div>
    </header>
</div>    

<div id="navwrap">
    <div class="container">
        <div class="navbar">
            <nav role="navigation" class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="nav-collapse collapse ">
                        <?php echo $OUTPUT->custom_menu(); ?>
                        <ul class="nav pull-right">
                            <li class="hbl"><a href="#" class="moodlezoom"><i class="fa fa-indent fa-lg"></i> <span class="zoomdesc">Hide blocks</span></a></li>
                            <li class="sbl"><a href="#" class="moodlezoom"><i class="fa fa-outdent fa-lg"></i> <span class="zoomdesc">Show blocks</span></a></li>
                            <li class="hbll"><a href="#" class="moodlewidth"><i class="fa fa-expand fa-lg"></i> <span class="zoomdesc">Full screen</span></a></li>
                            <li class="sbll"><a href="#" class="moodlewidth"><i class="fa fa-compress fa-lg"></i> <span class="zoomdesc">Standard view</span></a></li>
                        </ul>
                        <div id="edittingbutton" class="pull-right breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); ?></div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>