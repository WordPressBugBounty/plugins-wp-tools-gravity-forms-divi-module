<?php
/**
 * Static Module class.
 *
 * @package DTMC\Modules\GravityFormModule;
 */

namespace WPT\DiviGravity\Divi5\Modules\GravityFormModule;

if ( !defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

use ET\Builder\Packages\ModuleLibrary\ModuleRegistration;
use WPT\DiviGravity\Divi5\Modules\GravityFormModule\GravityFormModuleTraits;
use ET\Builder\Framework\DependencyManagement\Interfaces\DependencyInterface;

/**
 * Class GravityFormModule
 *
 * @package DTMC\Modules\GravityFormModule
 */
class GravityFormModule implements DependencyInterface
{

    use GravityFormModuleTraits\RenderCallbackTrait;
    use GravityFormModuleTraits\ModuleClassnamesTrait;
    use GravityFormModuleTraits\ModuleStylesTrait;
    use GravityFormModuleTraits\ModuleScriptDataTrait;

    /**
     * Load the module
     */
    public function load()
    {
        $container               = wpt_divi_gf_container();
        $module_json_folder_path = $container['dir'] . '/divi-5/visual-builder/src/modules/gravity-form-module';

        add_action(
            'init',
            function () use ( $module_json_folder_path ) {
                ModuleRegistration::register_module(
                    $module_json_folder_path,
                    [
                        'render_callback' => [GravityFormModule::class, 'render_callback'],
                    ]
                );
            }
        );
    }
}
