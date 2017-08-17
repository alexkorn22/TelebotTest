<?php
namespace core;

class Debug {
    protected $debugLibs = true;
    protected $pathFile = '/art_debug.html';

    public function __construct(){
        $this->pathFile = WWW . $this->pathFile;
    }

    public function d($value, $die = false, $bt = false) {
        if (!$bt) {
            $bt = debug_backtrace();
        }
        echo $this->render($bt, $value);
        if ($die) {
            die();
        }
    }

    protected function render($bt,$value) {
        $bt = $bt[0];
        $dRoot = $_SERVER["DOCUMENT_ROOT"];
        $dRoot = str_replace("/","\\",$dRoot);
        $bt["file"] = str_replace($dRoot,"",$bt["file"]);
        $dRoot = str_replace("\\","/",$dRoot);
        $bt["file"] = str_replace($dRoot,"",$bt["file"]);
        $res = "<div style=\"font-size: 9pt; color: #000; background: #fff; border: 1px dashed #000;\">";
        $res .= "<div style=\"padding: 3px 5px; background: #99CCFF; font-weight: bold;\">File: " . $bt["file"] . " [" . $bt["line"] . "]</div>";
        if (!$this->debugLibs) {
            $res .= " <pre style=\"padding: 10px;\">" . print_r($value,true) . "</pre>";
        } else {
            require_once WWW . '/libs/dBug.php';
            ob_start();
            new \dBug($value);
            $res .= ob_get_clean();
        }
        $res .= "</div>";
        return $res;
    }

    public function dDie($value) {
        $bt = debug_backtrace();
        $this->d($value, true,$bt);
    }

    public function inF($value, $clearFile = false, $die = false, $bt = false){
        if (!$bt) {
            $bt = debug_backtrace();
        }
        $render = " <hr>" . date("Y-m-d H:i:s") . " <br>" . $this->render($bt, $value);

        if (!$clearFile) {
            $render .= file_get_contents($this->pathFile);
        }
        file_put_contents($this->pathFile, $render);
        if ($die) {
            die();
        }
    }


}