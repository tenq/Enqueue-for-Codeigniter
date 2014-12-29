Enqueue for Codeigniter
=======================

##Setup

1. Copy the file from `libraries/Enqueue.php` to your Application Library folder (`PATH/TO/APP/libraries/`).
2. Copy the file from `config/enqueue.php` to your Application Config folder (`PATH/TO/APP/config/`).
3. (Optional) Add 'enqueue' to you're autoload file (`PATH/TO/APP/config/autoload.php`).

##Usage

If you don't autoloaded the library, you can call `$this->load->library('enqueue')`; from your controller or model to use the library.

In your views:
1. Add `$this->enqueue->load_styles();` just before the end of `<head>` tag.
2. Add `$this->enqueue->load_scripts_head();` also at the end of the `<head>` tag.
3. Add `$this->enqueue->load_scripts_footer();` just before the end of `<body>` tag.
    
In your controllers or models add:

        // To add new Script
        $this->enqueue->script(
            $name,      // Name of the script.
            $src,       // Path to the script.
            $deps,      // names of the scripts this script depends on.
            $footer,    // If it is placed in footer or not.
            $async      // If it is load asynchronously or not.
            );
            
        // To remove a script
        $this->enqueue->remove_script($name) // $name = name of the script to remove
            
        // To add new Style     
        $this->enqueue->style(
            $name,      // Name of the style.
            $src,       // Path of the style.
            $deps,      // Names of the styles this style depends on.
            $media      // Media type of the stylesheet.
        );
        
        // To remove a style
        $this->enqueue->remove_style($name) // $name = name of the style to remove