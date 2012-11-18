<?php

namespace Sling\View;

use \Sling\MVC\ViewInterface;

class Layout {
    
    /** @var String */
    protected $_title;
    
    /** @var String */
    protected $_doc_type;
    
    /** @var \Sling\MVC\ViewInterface */
    protected $_view;
    
    /** @var String */
    protected $_path;

    /**
     * 
     * @param String $doc_type
     * @return \Sling\View\Layout
     */
    public function setDocType($doc_type) {
        $this->_doc_type = $doc_type;
        return $this;
    }
    
    /**
     * 
     * @return String
     */
    public function getDocType() {
        return $this->_doc_type;
    }
    
    /**
     * 
     * @param String $title
     * @return \Sling\View\Layout
     */
    public function setTitle($title) {
        $this->_title = $title;
        return $this;
    }
    
    /**
     * 
     * @return String
     */
    public function getTitle() {
        return $this->_title;
    }
    
    /**
     * 
     * @param \Sling\MVC\ViewInterface $view
     * @return \Sling\View\Layout
     */
    public function setView(ViewInterface $view) {
        $this->_view = $view;
        return $this;
    }
    
    /**
     * 
     * @return \Sling\MVC\ViewInterface
     */
    public function getView() {
        return $this->view;
    }
    
    /**
     * 
     * @param String $path
     * @return \Sling\View\Layout
     */
    public function setPath($path) {
        $this->_path = $path;
        return $this;
    }
    
    /**
     * 
     * @return String
     */
    public function getPath() {
        return $this->_path;
    }
    
    public function render() {
        
    }
    
}
