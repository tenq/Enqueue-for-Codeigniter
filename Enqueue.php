<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Enqueue Class for Codeigniter
*
* @version 0.1
* @author TomCandia
*
**/
class Enqueue {
 
    protected $scripts;
    protected $styles;
    
    protected $enqueue_scripts;
    protected $enqueue_styles;
    
    /**
    * Construct
    * 
    * If defaults scripts & styles are set in config files, enqueue its.
    *
    * @since 0.1
    * 
    * @return void
    **/
    public function __construct() {
        
        $this->scripts = array();
        $this->styles = array();
        $this->enqueue_scripts = array();
        $this->enqueue_styles = array();
        
        $CI =& get_instance();
        $CI->load->helper('url');
        $CI->load->config('enqueue');
        
        $config =& get_config(); 
        $default_scripts = $config['enqueue_default_script'];
        $default_styles = $config['enqueue_default_style'];
        
        foreach($default_scripts as $name => $script){
            $this->scripts[$name] = $script;
            
        }
        
        foreach($default_styles as $name => $style) {
            $this->styles[$name] = $style;
        }
        
    }
    
    /**
    * Enqueue a script
    *
    * Register a new script and enqueue its. Does NOT override a previous enqueued script
    *
    * @since 0.1
    *
    * @param string         $name       Name of the script
    * @param string|bool    $src        Path to the script. It must be relative to the root directory.
    *                                   Example: 'assets/js/script.js'.
    * @param array|bool     $dependency Optional. An array of the names of scripts this script depends on.
    * @param bool           $in_footer  Optional. Whether the script goes in footer or not.
    * @param bool           $async      Optional. If set to true, the script will be loaded asynchronously
    *
    * @return void
    **/
    public function enqueue_script($name,$src = FALSE,$dependency = FALSE, $in_footer = FALSE, $async = FALSE) {
        
        if($src && !isset($this->scripts[$name])) {
            $this->scripts[$name] = array(
                'path'          => $script,
                'dependency'    => $dependency,
                'async'         => $async,
                'in_footer'     => $in_footer
            );
        }
        
    }
    
    /**
    * Enqueue a style
    *
    * register a new style and enqueue its. Does NOT override a previous enqueued script
    *
    * @since 0.1
    *
    * @param string         $name       Name of the style.
    * @param string|bool    $src        Path to the style. It must be relative to the root directory.
    *                                   Example: 'assets/css/style.css'.
    * @param array|bool     $dependency Optional. An array of name of styles registered this style depends on.
    * @param string         $media      Optional. Media type for what the stylesheet has been defined.
    *                                   Example: 'all', 'screen', 'print'.
    *                                   defaults to 'all'.
    *
    * @return void
    **/
    public function enqueue_style($name, $src = FALSE, $dependency = FALSE,$media = 'all') {
        
        if($src && !isset($this->styles[$name])) {
            $this->styles[$name] = array(
                'path'          => $src,
                'dependency'    => $dependency,
                'media'         => $media
            );
        }
        
    }
    
    public function load_scripts_head() {
        
        
        echo '<!-- Loading Javascript -->';
        foreach($this->scripts as $name => $script) {
            
            if(!$script['in_footer'] && !in_array($name,$this->enqueue_scripts)) {
                if($script['dependency'] && is_array($script['dependency'])){
                    foreach($script['dependency'] as $depen) {
                        if(!in_array($depen, $this->enqueue_scripts)) {
                            $this->make_enqueue_script($depend);
                        }
                    }
                }
                
                if(!in_array($name,$this->enqueue_scripts)) {
                    $this->make_enqueue_script($name);
                }
            }
            
        }
        echo '<!-- End of scripts loading -->';
        
    }
    
    public function load_scripts_footer() {
        
        echo '<!-- Loading Javascript -->'.PHP_EOL;
        
        foreach($this->scripts as $name => $script) {
            if($script['in_footer'] && !in_array($name, $this->enqueue_scripts)) {
                if($script['dependency'] && is_array($script['dependency'])) {
                    foreach($script['dependency'] as $depend) {
                        if(!in_array($depen, $this->enqueue_scripts)) {
                            $this->make_enqueue_script($depend);
                        }
                    }
                }
                
                if(!in_array($name,$this->enqueue_scripts)) {
                    $this->make_enqueue_script($name);
                }
            }
        }
        
        echo '<!-- End of scripts loading -->'.PHP_EOL;
    }
    
    public function load_styles() {
        
        echo '<!-- Loading CSS -->'.PHP_EOL;
        
        foreach($this->styles as $name => $style) {
            if(!in_array($name, $this->enqueue_styles)) {
                if($style['dependency'] && is_array($style['dependency'])) {
                    foreach($style['dependency'] as $depend) {
                        if(!in_array($depen, $this->enqueue_styles)) {
                            $this->make_enqueue_style($depend);
                        }
                    }
                }
            }
            
            if(!in_array($name, $this->enqueue_styles)) {
                $this->make_enqueue_style($name);
            }
        }
        
        echo '<!-- End of style loading -->'.PHP_EOL;
    }
    
    protected function make_enqueue_script($name) {
        
        if(isset($this->scripts[$name])) {
        
            $script = $this->scripts[$name];

            $output = '<script src="'.base_url($script['path']).'" type="text/javascript"';
            if($script['async']) $output .= ' async';
            $output .= '></script>'.PHP_EOL;

            $this->scripts[$name]['enqueued'] = TRUE;
            $this->enqueue_script[] = $name;

            echo $output;
        }
    }
    
    protected function make_enqueue_style($name) {
        
        if(isset($this->styles[$name])) {
            
            $style = $this->styles[$name];
            
            $output = '<link href="'.base_url($style['path']).'" rel="stylesheet"';
            if($style['media']) $output .= ' media="'.$style['media'].'"';
            $output .= '>'.PHP_EOL;
            
            $this->styles[$name]['enqueued'] = TRUE;
            $this->enqueue_style[] = $name;
            
            echo $output;
            
        }
        
    }
    
}
