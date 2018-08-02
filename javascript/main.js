/**
 * @package    theme_unicundi
 * @author    2017 Osvaldo Arriola <osvaldo@e-abclearning.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(['core/first'], function(){
    require(['jquery', 'theme_unicundi/init', 'core/log'], function($, theme, log){
        $(".toogle-list-courses").click(function(){
            log.info('testtest2');
        })
    });
});