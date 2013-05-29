<?php
/**
 * JChiliHighlighter class file.
 *
 * @author Stefan Volkmar <volkmar_yii@email.de>
 * @license New BSD License
 * @version 1.4
 *
 * JS Chili Plugin (c) 2007 Andrea Ercolino
 */

/**
 *
 * Syntax highlighting tool for C++, C#, CSS, Delphi, Java, JavaScript, LotusScript,
 * MySQL, PHP, and XHTML listings.
 *
 * This widget encapsulates the Chili-jQuery plugin and can be used to decorate code
 * listings in most of popular computer languages.
 * ({@link http://noteslog.com/category/chili/}).
 *
 * @author Stefan Volkmar <volkmar_yii@email.de>
 */
Yii::setPathOfAlias('JChiliHighlighter',dirname(__FILE__));

class JChiliHighlighter extends CWidget
{
	
	/**
	 * @var string Source type - 'cplusplus', 'csharp', 'css', 'delphi',
     *             'html', 'java', 'javascript', 'lotusscript', 'mysql', 'php'.
	 * Defaults to "php".
	 */
    public $lang="php";
    /**
	 * @var string A Yii path alias.
	 * Defaults to an empty string.
	 */
    public $pathAlias;
	/**
	 * @var string Name of the source file.
	 * Defaults to an empty string.
	 */
    public $fileName;
	/**
	 * @var string source code to highlight
	 * Defaults to an empty string.
	 */
    public $code;
	/**
	 * @var array the HTML attributes that should be rendered in the HTML code tag
     * which contain the code of the computer languages.
	 */
	public $htmlOptions=array();
	/**
	 * @var boolean show line number or not?
	 * Defaults to TRUE.
	 */
    public $showLineNumbers = true;
    /**
	 * @var string start with following line number if showLineNumbers = true
	 * Defaults to 1.
	 */
    public $firstLineNumber = 1;
	/**
	 * @var mixed the CSS file used for the widget.
	 * If false, the default CSS file will be used. Otherwise, the specified CSS file
	 * will be included when using this widget.
	 */
	public $cssFile=false;
    
	/**
	 * Initializes the widget.
	 * This method registers all needed client scripts 
	 */
	public function init()
	{
		parent::init();

		$id=$this->getId();
		if (isset($this->htmlOptions['id']))
			$id = $this->htmlOptions['id'];
		else
			$this->htmlOptions['id']=$id;

        $this->htmlOptions['class']=$this->lang;
      	
      	$baseUrl = CHtml::asset(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets');
        $url = ($this->cssFile!==false)
             ? $this->cssFile
             : $baseUrl.'/css/jchili.css';

		Yii::app()->getClientScript()->registerCoreScript('jquery')
           ->registerScriptFile($baseUrl.'/js/jquery.chili-2.2.js')
           ->registerScriptFile($baseUrl.'/js/recipes.js')
           ->registerCssFile($url);
        		        
        if ($this->showLineNumbers)
            echo CHtml::openTag("pre",array('class'=>'ln-'.$this->firstLineNumber,'style'=>''));
        else
            echo CHtml::openTag("pre");
        echo CHtml::openTag("code",$this->htmlOptions)."\n";
        ob_start();
	}

	/**
	 * Renders the close tag of the container.
	 */
	public function run()
	{
        $this->code=($this->code)
            ? $this->code . ob_get_clean()
            : ob_get_clean();

        $this->readFile();
        echo CHtml::encode($this->code);
		echo "\n".CHtml::closeTag("code");
        echo CHtml::closeTag("pre");
	}

    /**
     * Read the code from the source file
     *
     * @access protected
     * @return void
     */
    protected function readFile()
    {
        if ($this->fileName){
            $path="";
            if(strpos($this->pathAlias,'.')) // it is a path alias ?
                $path=Yii::getPathOfAlias($this->pathAlias);

            if($path){
                $fileName = $path.DIRECTORY_SEPARATOR.$this->fileName;
            } else {
                $this->code = file_get_contents($this->fileName);
                return;
            }

            if (is_file($fileName)) {
                $this->code = file_get_contents($fileName);
            } else {
                echo "$fileName wasn't detected as file!";
            }
        }
    }
	
}
