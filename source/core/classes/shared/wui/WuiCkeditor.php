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
 *             <basicstyles>true</basicstyles>
 *             <paragraph>false</paragraph>
 *             <links>false</links>
 *             <inline>true</inline>
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
    /*! @public mValue string - Value of textarea. */
    public $mId;
    /*! @public mHeight string - Height for this element. */
    public $mHeight = '200';
    /*! @public mHeight string - Height for this element. */
    public $mWidth = '550';
    /*! @public mValue string - Value of textarea. */
    public $mValue;
    /*! @public mValue string - Value of textarea. */
    public $mBasicstyles = true;
    /*! @public mValue string - Value of textarea. */
    public $mParagraph = true;
    /*! @public mValue string - Value of textarea. */
    public $mLinks = true;
    /*! @public mValue string - Value of textarea. */
    public $mInline = false;

    /**
     * Costruct:
     * @param string $elemName   name of element
     * @param string $elemArgs   array witch params
     * @param string $elemTheme  theme of element
     * @param string $dispEvents dispacer of events
     */
    public function __construct($elemName, $elemArgs='', $elemTheme='', $dispEvents='') 
    {
        parent::__construct($elemName, $elemArgs, $elemTheme, $dispEvents);
 
        $this->mId = $this->mArgs['id'];
        $this->mValue = $this->mArgs['value'];

        if (isset($this->mArgs['height'])) $this->mHeight = $this->mArgs['height'];
        if (isset($this->mArgs['width'])) $this->mWidth = $this->mArgs['width'];

        // default components of the toolbar are true
        if (isset($this->mArgs['basicstyles'])) {
            if ($this->mArgs['basicstyles'] === 'false') $this->mBasicstyles = false;
        }
        if (isset($this->mArgs['paragraph'])) {
            if ($this->mArgs['paragraph'] === 'false') $this->mParagraph = false;
        }
        if (isset($this->mArgs['links'])) {
            if ($this->mArgs['links'] === 'false') $this->mLinks = false;
        } 

        if (isset($this->mArgs['inline'])) {
            if ($this->mArgs['inline'] === 'true') $this->mInline = true;
        } 
    }

    /**
     * Generate Source Html of this Widget
     * @return string code html
     */
    public function generateSource()
    {

        $basicstyles = '{ name: "basicstyles", items: [ "Bold", "Italic" ] },';
        $paragraph = '{ name: "paragraph", items: [ "NumberedList", "BulletedList", "-", "Outdent", "Indent" ] },';
        $links = '{ name: "links", items: [ "Link", "Unlink" ] },';

        $this->mLayout = ($this->mComments ? '<!-- begin ' . $this->mName . ' textarea -->' : '') 
            . ( $this->mInline ? 
                '<style> .cke_textarea_inline[title~='.$this->mId.'] { 
                    padding-left: 10px; 
                    padding-right: 10px; 
                    height: '.$this->mHeight.'px;
                    overflow: auto; 
                    border: 1px solid gray; 
                    -webkit-appearance: textfield; } 
                </style>' : '')
            . '<textarea id="'.$this->mId.'" name="'.$this->mId.'" >' 
            . ((isset($this->mValue) and strlen($this->mValue)) ? \Innomatic\Wui\Wui::utf8_entities($this->mValue) : '') 
            . '</textarea>'
            . '<script type="text/javascript">'
            . ' $.getScript("../shared/ckeditor/ckeditor.js", function(){'
            . '   function onChange(){ 
                    document.getElementById("'.$this->mId.'").innerHTML = CKEDITOR.instances.'.$this->mId.'.getData(); 
                  }'
            . '   CKEDITOR.'.( $this->mInline ? 'inline' : 'replace' ).'( "'
                    .$this->mId.'", { '
            . '     width:"'.$this->mWidth.'px",' 
            . '     height:"'.$this->mHeight.'px",'
            . '     on: { change: onChange },
                    toolbar: ['
            .           ( $this->mBasicstyles ? $basicstyles : '')
            .           ( $this->mParagraph ? $paragraph : '')
            .           ( $this->mLinks ? $links : '')
            .'          { name: "about", items: [ "About" ] }
                    ],
                  });'
            . ' });'
            . '</script>'
            . ($this->mComments ? '<!-- end ' . $this->mName . " textarea -->\n" : '');

        return true;
    }
}

?>
