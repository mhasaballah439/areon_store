<?php namespace Coolnet\adminauthv2;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }
	public function boot()
    {
    	$this->bootPackages();
    }

    public function bootPackages()
    {
        // Get the namespace code of the current plugin
        $pluginNamespace = str_replace('\\', '.', strtolower(__NAMESPACE__));
        
        // Locate the packages to boot
        $packages = \Config::get($pluginNamespace . '::packages');
		//dd($packages);
        // Boot each package
        foreach ($packages as $name => $options) {
            // Apply the configuration for the package
            if (
                !empty($options['config']) &&
                !empty($options['config_namespace'])
            ) {
                \Config::set($options['config_namespace'], $options['config']);
            }
        }
    }
 
}
