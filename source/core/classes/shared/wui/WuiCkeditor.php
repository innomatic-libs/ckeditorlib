<?php
/**
 * Innomatic
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.
 *
 * @category  Widget
 * @package   WUI
 * @author    Amanda Accalai <amanda.accalai@innoteam.it>
 * @copyright 1999-2014 Innoteam Srl
 * @license   http://www.innomatic.org/license/BSD License
 * @link      http://www.innomatic.org
 * @since     Class available since Release 5.0
 */
namespace Shared\Wui;

/**
 * Widget of Editor 
 *
 * Example of widget definition: 
 *     <ckeditor row="0" col="0">
 *         <args>
 *             <id>textarea_helloword</id>
 *             <height>300</height>
 *             <width>700</width>
 *             <value>Hello Word</value>
 *         </args>
 *     </ckeditor>
 * 
 * @category  Widget
 * @package   WUI
 * @author    Amanda Accalai <amanda.accalai@innoteam.it>
 * @copyright 1999-2014 Innoteam Srl
 * @license   http://www.innomatic.org/license/BSD License
 * @link      http://www.innomatic.org
 * @since     Class available since Release 5.0
 */
class WuiCKEditor extends \Innomatic\Wui\Widgets\WuiWidget
{
    /**
     * Costruct 
     * @param string $elemName   name of element
     * @param string $elemArgs   array witch params
     * @param string $elemTheme  theme of element
     * @param string $dispEvents dispacer of events
     */
    public function __construct($elemName, $elemArgs='', $elemTheme='', $dispEvents='') 
    {
        parent::__construct($elemName, $elemArgs, $elemTheme, $dispEvents);
 
        if ( !isset( $this->mArgs['height'] ) ) {
            $this->mArgs['height'] = '200';
        }
        if ( !isset( $this->mArgs['width'] ) ) {
            $this->mArgs['width'] = '550';
        }
    }

    /**
     * Generate Source Html of this Widget
     * @return string code html
     */
    public function generateSource()
    {

        $id = $this->mArgs['id'];
        $value = $this->mArgs['value'];
        $height = $this->mArgs['height'];
        $width = $this->mArgs['width'];

        $this->mLayout = ($this->mComments ? '<!-- begin ' . $this->mName . ' textarea -->' : '') 
            . '<textarea ' . (isset($id) ? ' id="'.$id.'"' : '') . (isset($id) ? ' name="'.$id.'"' : '') . '>' 
            . ((isset($value) and strlen($value)) ? \Innomatic\Wui\Wui::utf8_entities($value) : '') 
            . '</textarea>'
            . '<script type="text/javascript">'
            . ' $.getScript("../shared/ckeditor/ckeditor.js", function(){'
            . '   function onChange(){ document.getElementById("'.$id.'").innerHTML = CKEDITOR.instances.'.$id.'.getData(); }'
            . '   CKEDITOR.replace( "'.$id.'", { '
            .       (isset($width) ? ' width:"'.$width.'px",' : '') 
            .       (isset($height) ? ' height:"'.$height.'px",' : '') 
            . '     on: { change: onChange } 
                  });'
            . ' });'
            . '</script>'
            . ($this->mComments ? '<!-- end ' . $this->mName . " textarea -->\n" : '');

        return true;
    }
}

?>
