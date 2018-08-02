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
 * Settings configuration for admin setting section
 * @package    theme_unicundi
 * @copyright  2015 onwards LMSACE Dev Team (http://www.lmsace.com)
 * @author    LMSACE Dev Team
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if (is_siteadmin()) {
    $settings = new theme_boost_admin_settingspage_tabs('themesettingunicundi', get_string('configtitle', 'theme_unicundi'));
    $ADMIN->add('themes', new admin_category('theme_unicundi', 'unicundi'));

    /* Header Settings */
    $temp = new admin_settingpage('theme_unicundi_header', get_string('headerheading', 'theme_unicundi'));

    // Logo file setting.
    $name = 'theme_unicundi/logo';
    $title = get_string('logo', 'theme_unicundi');
    $description = get_string('logodesc', 'theme_unicundi');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Custom CSS file.
    $name = 'theme_unicundi/customcss';
    $title = get_string('customcss', 'theme_unicundi');
    $description = get_string('customcssdesc', 'theme_unicundi');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    $settings->add($temp);
    
    /* Slideshow Settings Start */
    $temp = new admin_settingpage('theme_unicundi_slideshow', get_string('slideshowheading', 'theme_unicundi'));
    $temp->add(new admin_setting_heading('theme_unicundi_slideshow', get_string('slideshowheadingsub', 'theme_unicundi'),
    format_text(get_string('slideshowdesc', 'theme_unicundi'), FORMAT_MARKDOWN)));

    // Display Slideshow.
    $name = 'theme_unicundi/toggleslideshow';
    $title = get_string('toggleslideshow', 'theme_unicundi');
    $description = get_string('toggleslideshowdesc', 'theme_unicundi');
    $yes = get_string('yes');
    $no = get_string('no');
    $default = 1;
    $choices = array(1 => $yes , 0 => $no);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);

    // Number of slides.
    $name = 'theme_unicundi/numberofslides';
    $title = get_string('numberofslides', 'theme_unicundi');
    $description = get_string('numberofslides_desc', 'theme_unicundi');
    $default = 3;
    $choices = array(
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
        7 => '7',
        8 => '8',
        9 => '9',
        10 => '10',
        11 => '11',
        12 => '12',
    );
    $temp->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    // Slideshow settings.
    $numberofslides = get_config('theme_unicundi', 'numberofslides');
    for ($i = 1; $i <= $numberofslides; $i++) {

        // This is the descriptor for Slide One.
        $name = 'theme_unicundi/slide' . $i . 'info';
        $heading = get_string('slideno', 'theme_unicundi', array('slide' => $i));
        $information = get_string('slidenodesc', 'theme_unicundi', array('slide' => $i));
        $setting = new admin_setting_heading($name, $heading, $information);
        $temp->add($setting);

        // Slide Image.
        $name = 'theme_unicundi/slide' . $i . 'image';
        $title = get_string('slideimage', 'theme_unicundi');
        $description = get_string('slideimagedesc', 'theme_unicundi');
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide' . $i . 'image');
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Slide Caption.
        $name = 'theme_unicundi/slide' . $i . 'caption';
        $title = get_string('slidecaption', 'theme_unicundi');
        $description = get_string('slidecaptiondesc', 'theme_unicundi');
        $default = get_string('slidecaptiondefault', 'theme_unicundi', array('slideno' => sprintf('%02d', $i) ));
        $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
        $temp->add($setting);

        // Slide Description Text.
        $name = 'theme_unicundi/slide' . $i . 'desc';
        $title = get_string('slidedesc', 'theme_unicundi');
        $description = get_string('slidedesctext', 'theme_unicundi');
        $default = get_string('slidedescdefault', 'theme_unicundi');
        $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
        $temp->add($setting);
    }
    $settings->add($temp);

    /* Slideshow Settings End*/

    /* Footer Settings start */
    $temp = new admin_settingpage('theme_unicundi_footer', get_string('footerheading', 'theme_unicundi'));

    /* Enable and Disable footer logo */
    $name = 'theme_unicundi/footlogo';
    $title = get_string('enable', 'theme_unicundi');
    $description = '';
    $default = '1';
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $temp->add($setting);

    /* Footer Content */
    $name = 'theme_unicundi/footnote';
    $title = get_string('footnote', 'theme_unicundi');
    $description = get_string('footnotedesc', 'theme_unicundi');
    $default = get_string('footnotedefault', 'theme_unicundi');
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // INFO Link.
    $name = 'theme_unicundi/infolink';
    $title = get_string('infolink', 'theme_unicundi');
    $description = get_string('infolink_desc', 'theme_unicundi');
    $default = get_string('infolinkdefault', 'theme_unicundi');
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $temp->add($setting);

    // Copyright.
    $name = 'theme_unicundi/copyright_footer';
    $title = get_string('copyright_footer', 'theme_unicundi');
    $description = '';
    $default = get_string('copyright_default', 'theme_unicundi');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    /* Address , Email , Phone No */
    $name = 'theme_unicundi/address';
    $title = get_string('address', 'theme_unicundi');
    $description = '';
    $default = get_string('defaultaddress', 'theme_unicundi');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    $name = 'theme_unicundi/emailid';
    $title = get_string('emailid', 'theme_unicundi');
    $description = '';
    $default = get_string('defaultemailid', 'theme_unicundi');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    $name = 'theme_unicundi/phoneno';
    $title = get_string('phoneno', 'theme_unicundi');
    $description = '';
    $default = get_string('defaultphoneno', 'theme_unicundi');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    /* Facebook, Pinterest, Twitter, Google+ Settings */
    $name = 'theme_unicundi/fburl';
    $title = get_string('fburl', 'theme_unicundi');
    $description = get_string('fburldesc', 'theme_unicundi');
    $default = get_string('fburl_default', 'theme_unicundi');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    $name = 'theme_unicundi/pinurl';
    $title = get_string('pinurl', 'theme_unicundi');
    $description = get_string('pinurldesc', 'theme_unicundi');
    $default = get_string('pinurl_default', 'theme_unicundi');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    $name = 'theme_unicundi/twurl';
    $title = get_string('twurl', 'theme_unicundi');
    $description = get_string('twurldesc', 'theme_unicundi');
    $default = get_string('twurl_default', 'theme_unicundi');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    $name = 'theme_unicundi/gpurl';
    $title = get_string('gpurl', 'theme_unicundi');
    $description = get_string('gpurldesc', 'theme_unicundi');
    $default = get_string('gpurl_default', 'theme_unicundi');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    $settings->add($temp);
     /*  Footer Settings end */
    
    //imagenes
     $temp = new admin_settingpage('theme_esba33', 'Pagina principal');
    // Logo login file setting.
     
    $name = 'theme_unicundi/logologin';
    $title = "Imagen del login";
    $description = "Imagen del login";
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logologin');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Logo login file setting.
    $name = 'theme_unicundi/logofooter';
    $title = "Imagen del footer";
    $description = "Imagen del footer";
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logofooter');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    //imagen primer anuncio 
    $name = 'theme_unicundi/logoanuncios1';
    $title = "Imagen primer anuncio";
    $description = "Imagen primer anuncio";
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logoanuncios1');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //titulo anuncio 1
    $name = 'theme_unicundi/tituloanuncio1';
    $title = "Titulo primer anuncio";
    $description = "Titulo primer anuncio";
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //descripcion anuncio 1
    $name = 'theme_unicundi/descripcionanuncio1';
    $title = "Descripcion primer anuncio";
    $description = "Descripcion primer anuncio";
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //contenido ver mas anuncio 1
    $name = 'theme_unicundi/vermasanuncio1';
    $title = "Contenido ver mas anuncio 1";
    $description = "Contenido ver mas anuncio 1";
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //imagen segundo anuncio
    $name = 'theme_unicundi/logoanuncios2';
    $title = "Imagen segundo anuncio";
    $description = "Imagen segundo anuncio";
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logoanuncios2');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //titulo segundo anuncio
    $name = 'theme_unicundi/tituloanuncio2';
    $title = "Titulo segundo anuncio";
    $description = "Titulo segundo anuncio";
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //descripcion segundo anuncio 
    $name = 'theme_unicundi/descripcionanuncio2';
    $title = "Descripcion segundo anuncio";
    $description = "Descripcion segundo anuncio";
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //contenido ver mas anuncio 2
    $name = 'theme_unicundi/vermasanuncio2';
    $title = "Contenido ver mas anuncio 2";
    $description = "Contenido ver mas anuncio 2";
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //imagen tercer anuncio
    $name = 'theme_unicundi/logoanuncios3';
    $title = "Imagen tercer anuncio";
    $description = "Imagen tercer anuncio";
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logoanuncios3');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //titulo tercer anuncio
    $name = 'theme_unicundi/tituloanuncio3';
    $title = "Titulo tercer anuncio";
    $description = "Titulo tercer anuncio";
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //descripcion tercer anuncio 
    $name = 'theme_unicundi/descripcionanuncio3';
    $title = "Descripcion tercer anuncio";
    $description = "Descripcion tercer anuncio";
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //contenido ver mas anuncio 3
    $name = 'theme_unicundi/vermasanuncio3';
    $title = "Contenido ver mas anuncio 3";
    $description = "Contenido ver mas anuncio 3";
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //imagen cuarto anuncio
    $name = 'theme_unicundi/logoanuncios4';
    $title = "Imagen cuarto anuncio";
    $description = "Imagen cuarto anuncio";
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logoanuncios4');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //titulo cuarto anuncio
    $name = 'theme_unicundi/tituloanuncio4';
    $title = "Titulo cuarto anuncio";
    $description = "Titulo cuarto anuncio";
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //descripcion cuarto anuncio 
    $name = 'theme_unicundi/descripcionanuncio4';
    $title = "Descripcion cuarto anuncio";
    $description = "Descripcion cuarto anuncio";
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //contenido ver mas anuncio 4
    $name = 'theme_unicundi/vermasanuncio4';
    $title = "Contenido ver mas anuncio 4";
    $description = "Contenido ver mas anuncio 4";
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $settings->add($temp);
}
