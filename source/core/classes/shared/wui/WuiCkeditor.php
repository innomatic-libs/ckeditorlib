<?php
/**
 * Innomatic
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.
 *
 * @copyright  1999-2014 Innoteam Srl
 * @license    http://www.innomatic.org/license/   BSD License
 * @link       http://www.innomatic.org
 * @since      Class available since Release 5.0
 */
namespace Shared\Wui;

/**
 * @package WUI
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
    public function __construct($elemName, $elemArgs = '', $elemTheme = '', $dispEvents = '') 
    {
        parent::__construct($elemName, $elemArgs, $elemTheme, $dispEvents);
 
    }

    /**
     * Generate Source Html of this Widget
     * @return string code html
     */
    public function generateSource()
    {
        $result = false;
        $event_data = new \Innomatic\Wui\Dispatch\WuiEventRawData(isset($this->mArgs['disp']) ? $this->mArgs['disp'] : '', $this->mName);

        $this->mLayout = ($this->mComments ? '<!-- begin ' . $this->mName . ' textarea -->' : '') 
            // . '<textarea class="ckeditor"' 
            . '<textarea ' 
            . (isset($this->mArgs['id']) ? ' id="'.$this->mArgs['id'].'"' : '')
            . (isset($this->mArgs['id']) ? ' name="'.$this->mArgs['id'].'"' : '')
            . (isset($this->mArgs['maxlength']) ? ' maxlength="'.$this->mArgs['maxlength'].'"' : '')
            . (strlen($this->mArgs['cols']) ? ' cols="' . $this->mArgs['cols'] . '"' : '') 
            . (strlen($this->mArgs['rows']) ? ' rows="' . $this->mArgs['rows'] . '"' : '') 
            . '>' 
            . ((isset($this->mArgs['value']) and strlen($this->mArgs['value'])) ? \Innomatic\Wui\Wui::utf8_entities($this->mArgs['value']) : '') 
            . '</textarea>'
            . '<script type="text/javascript">'
            . ' $.getScript("../shared/ckeditor/ckeditor.js", function(){'
            . '   function onChange(){ document.getElementById("'.$this->mArgs['id'].'").innerHTML = CKEDITOR.instances.'.$this->mArgs['id'].'.getData(); }'
            . '   CKEDITOR.replace( "'.$this->mArgs['id'].'", { on: { change: onChange } });'
            . ' });'
            // . ((isset($this->mArgs['readonly']) and strlen($this->mArgs['readonly'])) ? 'CKEDITOR.instances.'.$this->mArgs['id'].'.setReadOnly();' : '')
            . '</script>'
            . ($this->mComments ? '<!-- end ' . $this->mName . " textarea -->\n" : '');

        $result = true;
        return $result;
    }
}

?>
