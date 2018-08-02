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
 * @package    theme_unicundi
 * @copyright  2015 onwards LMSACE Dev Team (http://www.lmsace.com)
 * @author    LMSACE Dev Team
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * unicundi core renderer renderer from the moodle core renderer
 * @copyright  2015 onwards LMSACE Dev Team (http://www.lmsace.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class theme_unicundi_core_renderer extends theme_boost\output\core_renderer {
    
    /**
      * Renders the header bar.
      *
      * @param context_header $contextheader Header bar object.
      * @return string HTML for the header bar.
      */
    protected function render_context_header(context_header $contextheader) {

        // All the html stuff goes here.
        $html = html_writer::start_div('page-context-header');

        // Image data.
        if (isset($contextheader->imagedata)) {
            // Header specific image.
            $html .= html_writer::div($contextheader->imagedata, 'page-header-image');
        }

        $html .= html_writer::tag('div', $headings, array('class' => 'page-header-headings'));

        // Buttons.
        if (isset($contextheader->additionalbuttons)) {
            $html .= html_writer::start_div('btn-group header-button-group');
            foreach ($contextheader->additionalbuttons as $button) {
                if (!isset($button->page)) {
                    // Include js for messaging.
                    if ($button['buttontype'] === 'togglecontact') {
                        \core_message\helper::togglecontact_requirejs();
                    }
                    $image = $this->pix_icon($button['formattedimage'], $button['title'], 'moodle', array(
                        'class' => 'iconsmall',
                        'role' => 'presentation'
                    ));
                    $image .= html_writer::span($button['title'], 'header-button-title');
                } else {
                    $image = html_writer::empty_tag('img', array(
                        'src' => $button['formattedimage'],
                        'role' => 'presentation'
                    ));
                }
                $html .= html_writer::link($button['url'], html_writer::tag('span', $image), $button['linkattributes']);
            }
            $html .= html_writer::end_div();
        }
        $html .= html_writer::end_div();

        return $html;
    }
    
    /**
     * Custom menu in header.
     * @param custom_menu $menu
     * @return type
     */
    public function custom_menu_render(custom_menu $menu) {
        global $CFG;

        $langs = get_string_manager()->get_list_of_translations();
        $haslangmenu = $this->lang_menu() != '';

        if (!$menu->has_children() && !$haslangmenu) {
            return '';
        }

        $content = '';
        foreach ($menu->get_children() as $item) {
            $context = $item->export_for_template($this);
            $content .= $this->render_from_template('theme_unicundi/custom_menu_item', $context);
        }

        return $content;
    }
    
     /**
     * Wrapper for header elements.
     *
     * @return string HTML to display the main header.
     */
    public function full_header_frontpage() {
        global $PAGE;

        $html = html_writer::start_tag('header', array('id' => 'page-header', 'class' => 'row'));
        $html .= html_writer::start_div('col-xs-12 p-a-1');
        $html .= html_writer::start_div('card');
        $html .= html_writer::start_div('card-block');
        $html .= html_writer::div($this->context_header_settings_menu(), 'pull-xs-right context-header-settings-menu');
        $html .= html_writer::start_div('pull-xs-left');
        $html .= $this->navbar();
        $html .= html_writer::end_div();
        $pageheadingbutton = $this->page_heading_button();

        $html .= html_writer::tag('div', $this->course_header(), array('id' => 'course-header'));
        $html .= html_writer::end_div();
        $html .= html_writer::end_div();
        $html .= html_writer::end_div();
        $html .= html_writer::end_tag('header');
        return $html;
    }

    public function logologin(){
        if($backgroundimage = $this->page->theme->setting_file_url('logologin', 'logologin')){
            return '<img src="'.$backgroundimage.'" style="max-width: 100%;">';
        }else{
            return '';
        }
    }
    
    /**
     * Returns standard main content placeholder.
     * Designed to be called in theme layout.php files.
     *
     * @return string HTML fragment.
     */
    public function main_content() {
        // This is here because it is the only place we can inject the "main" role over the entire main content area
        // without requiring all theme's to manually do it, and without creating yet another thing people need to
        // remember in the theme.
        // This is an unfortunate hack. DO NO EVER add anything more here.
        // DO NOT add classes.
        // DO NOT add an id.
        return '<div role="main">'.$this->unique_main_content_token.'</div>';
    }

    public function anuncios(){
        
        $html = '';
        $html = '<div class="row" style="padding: 20px; ">';
        $tituloanuncio1 = theme_unicundi_get_setting('tituloanuncio1');
        $tituloanuncio2 = theme_unicundi_get_setting('tituloanuncio2');
        $tituloanuncio3 = theme_unicundi_get_setting('tituloanuncio3');
        $tituloanuncio4 = theme_unicundi_get_setting('tituloanuncio4');
        if($tituloanuncio1){
            $html .= '<div class="col-md-3" style="text-align: center;">';
                if($backgroundimage = $this->page->theme->setting_file_url('logoanuncios1', 'logoanuncios1')){
                    $html .= "<div>";
                        $html .= '<img src="'.$backgroundimage.'" style="max-width: 100%; height: 187px">';
                    $html .= "</div>";
                }
                
                $html .= '<div style="font-weight: 700; color: #1f3f3e; margin-top: 10px;">';
                $html .= $tituloanuncio1;
                $html .= '</div>';
                $html .= '<div style="color: #58595b">';
                $html .= theme_unicundi_get_setting('descripcionanuncio1');
                $html .= '</div>';
                
                $html .= '<button type="button" class="" data-toggle="modal" data-target="#myModal" style="color: #8e9e9e; background: transparent; border: solid 2px #8e9e9e;" >Leer MÁS</button>';
                $html .= '
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Leer MÁS</h4>
                                </div>
                                <div class="modal-body">
                                  '.theme_unicundi_get_setting('vermasanuncio1').'
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                              </div>

                            </div>
                        </div>
                        ';
                
            $html .= '</div>';
        }
        if($tituloanuncio2){
            $html .= '<div class="col-md-3" style="text-align: center;">';
                if($backgroundimage = $this->page->theme->setting_file_url('logoanuncios2', 'logoanuncios2')){
                    $html .= "<div>";
                        $html .= '<img src="'.$backgroundimage.'" style="max-width: 100%; height: 187px">';
                    $html .= "</div>";
                }
                $html .= '<div style="font-weight: 700; color: #1f3f3e; margin-top: 10px;">';
                $html .= $tituloanuncio2;
                $html .= '</div>';
                $html .= '<div style="color: #58595b">';
                $html .= theme_unicundi_get_setting('descripcionanuncio2');
                $html .= '</div>';
                
                $html .= '<button type="button" class="" data-toggle="modal" data-target="#myModal2" style="color: #8e9e9e; background: transparent; border: solid 2px #8e9e9e;" >Leer MÁS</button>';
                $html .= '
                        <div id="myModal2" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Leer MÁS</h4>
                                </div>
                                <div class="modal-body">
                                  '.theme_unicundi_get_setting('vermasanuncio2').'
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                              </div>

                            </div>
                        </div>
                        ';
                
            $html .= '</div>';
        }
        if($tituloanuncio3){
            $html .= '<div class="col-md-3" style="text-align: center;">';
                if($backgroundimage = $this->page->theme->setting_file_url('logoanuncios3', 'logoanuncios3')){
                    $html .= "<div>";
                        $html .= '<img src="'.$backgroundimage.'" style="max-width: 100%; height: 187px">';
                    $html .= "</div>";
                }
                $html .= '<div style="font-weight: 700; color: #1f3f3e; margin-top: 10px;">';
                $html .= $tituloanuncio3;
                $html .= '</div>';
                $html .= '<div style="color: #58595b">';
                $html .= theme_unicundi_get_setting('descripcionanuncio3');
                $html .= '</div>';
                
                $html .= '<button type="button" class="" data-toggle="modal" data-target="#myModal3" style="color: #8e9e9e; background: transparent; border: solid 2px #8e9e9e;" >Leer MÁS</button>';
                $html .= '
                        <div id="myModal3" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Leer MÁS</h4>
                                </div>
                                <div class="modal-body">
                                  '.theme_unicundi_get_setting('vermasanuncio3').'
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                              </div>

                            </div>
                        </div>
                        ';
            $html .= '</div>';
        }
        if($tituloanuncio4){
            $html .= '<div class="col-md-3" style="text-align: center;">';
                if($backgroundimage = $this->page->theme->setting_file_url('logoanuncios4', 'logoanuncios4')){
                    $html .= "<div>";
                        $html .= '<img src="'.$backgroundimage.'" style="max-width: 100%; height: 187px">';
                    $html .= "</div>";
                }
                $html .= '<div style="font-weight: 700; color: #1f3f3e; margin-top: 10px;">';
                $html .= $tituloanuncio4;
                $html .= '</div>';
                $html .= '<div style="color: #58595b">';
                $html .= theme_unicundi_get_setting('descripcionanuncio4');;
                $html .= '</div>';
                
                $html .= '<button type="button" class="" data-toggle="modal" data-target="#myModal4" style="color: #8e9e9e; background: transparent; border: solid 2px #8e9e9e;" >Leer MÁS</button>';
                $html .= '
                        <div id="myModal4" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Leer MÁS</h4>
                                </div>
                                <div class="modal-body">
                                  '.theme_unicundi_get_setting('vermasanuncio4').'
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                              </div>

                            </div>
                        </div>
                        ';
                
            $html .= '</div>';
        }
        
        $html .= '</div>';
        return $html;
    }
    
    public function bgheader(){
        global $CFG;
        $img = $CFG->wwwroot."/theme/unicundi/pix/header_cundinamarca.png"; 
        return $img;
    }
    
    public function logofooter(){
        global $CFG;
        if($backgroundimage = $this->page->theme->setting_file_url('logofooter', 'logofooter')){
            return '<a href="'.$CFG->dirroot.'/?redirect=0"><img src="'.$backgroundimage.'" alt="unicundi"></a>';
        }else{
            return '';
        }
    }
}
