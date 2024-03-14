<?php
/**
 * Plugin Name:     Chunker
 * Plugin URI:      www.chunker.org
 * Description:     This plugin add webpack to your active theme to help you build your assets easily
 * Author:          Ludovic Ekalle
 * Author URI:      www.ekallejrl.me
 * Text Domain:     Chunker
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Chunker
 */

// Your code starts here.


register_activation_hook(__FILE__, function () {

shell_exec(
'[[ ! -f ' . get_template_directory() . '/webpack.config.js ]] && [[ ! -f ' . get_template_directory() . '/options/webpack.inc.php ]] && ' .
'cp ' . __DIR__ . '/webpack-config/.babelrc ' . get_template_directory() . ' && ' .
'cp ' . __DIR__ . '/webpack-config/component.js ' . get_template_directory() . ' && ' .
'cp ' . __DIR__ . '/webpack-config/package.json ' . get_template_directory() . ' && ' .
'cp ' . __DIR__ . '/webpack-config/postcss.config.js ' . get_template_directory() . ' && ' .
'cp ' . __DIR__ . '/webpack-config/webpack.config.js ' . get_template_directory() . ' && ' .
'cp -R ' . __DIR__ . '/webpack-config/sass ' . get_template_directory() . '/assets' . ' && ' .
'cp ' . __DIR__ . '/webpack-config/index.js ' . get_template_directory() . ' && ' .
'if [ -d ' . get_template_directory() . '/options' . ' ] ; then cp ' . __DIR__ . '/webpack-config/webpack.inc.php ' . get_template_directory() . '/options/webpack.inc.php' . 
' ; else mkdir ' . get_template_directory() . '/options && cp ' . __DIR__ . '/webpack-config/webpack.inc.php ' . get_template_directory() . '/options/webpack.inc.php' . ' ; fi' . ' && ' .
'if [ -f ' . get_template_directory() . '/functions.php' . ' ] ; then echo "\
\n// Add webpack \
\nrequire_once(\'options/webpack.inc.php\'); \
" >> ' . get_template_directory() . '/functions.php' .
' ; else touch ' . get_template_directory() . '/functions.php && echo "\
\n// Add webpack \
\nrequire_once(\'options/webpack.inc.php\'); \
" >> ' . get_template_directory() . '/functions.php' . ' ; fi'
);

});

