<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CodeGenerator extends Command
{
    private $config;
    private $generate_stub_path;
    private $controller_action;
    private $controller_use_request;
    private $service_action;
    private $request_action;


    public function __construct()
    {
        parent::__construct();

        $app_path=app_path();
        $root_path=base_path();
        $this->generate_stub_path = $app_path . '/Console/Commands/Stubs/generate/';
        $config_tmp = [
            //模版目录
            'template' => [
                'controller' => $app_path . '/Console/Commands/Stubs/generate/controller.stub',
                'service' => $app_path . '/Console/Commands/Stubs/generate/service.stub',
                'model'      => $app_path . '/Console/Commands/Stubs/generate/model.stub',
                'view' => $app_path . '/Console/Commands/Stubs/generate/view.stub',
            ],
            //生成文件目录
            'file_dir' => [
                'controller' => $app_path . '/Http/Controllers/Admin/',
                'model'      => $app_path . '/Models/Admin/',
                'service'      => $app_path . '/Services/Admin/',
                'request'   => $app_path . '/Http/Requests/Admin/',
                'view'       => $root_path . '/resources/admin/views/',
            ],
        ];
        $this->config = $config_tmp;
    }

    /**
     * The name and signature of the console command.
     * name class
     * create 可选 c:controller m:model s:service r:request
     * action ,分割 可选 create update edit
     * @var string
     */

    protected $signature = "crud:generator {name} {create?} {action?}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CRUD operations';

    protected function getStub($type)
    {
        return CodeGenerator::getFile($this->config['template'][$type]);
    }

    protected static function getFile($path)
    {
        if (file_exists($path)){
            return file_get_contents($path);
        }else{
            return '';
        }
    }
    protected static function saveFile($path,$template)
    {
        if (!file_exists($path)){
            return file_put_contents($path,$template);
        }
    }

    //驼峰命名转下划线命名
    function toUnderScore($str)
    {
        $dstr = preg_replace_callback('/([A-Z]+)/',function($matchs)
        {
            return '_'.strtolower($matchs[0]);
        },$str);
        return trim(preg_replace('/_{2,}/','_',$dstr),'_');
    }

    public function handle()
    {
        $name = $this->argument('name');
        $create = $this->argument('create');

        if ($action = $this->argument('action')) {
            $action = explode(',',$action);

            $controller_action = [];
            $controller_use_request = [];
            $service_action = [];
            $request_action = [];

            foreach ($action as $a_k => $a){

                $controller_action[$action[$a_k]] = CodeGenerator::getFile($this->generate_stub_path.'controller/'.$a.'.stub');
                $controller_use_request[$action[$a_k]] = CodeGenerator::getFile($this->generate_stub_path.'controller/use/'.$a.'.stub');


                $service_action[$action[$a_k]] = CodeGenerator::getFile($this->generate_stub_path.'service/'.$a.'.stub');


                $request_action[$action[$a_k]] = CodeGenerator::getFile($this->generate_stub_path.'request/'.$a.'.stub');
            }
            $this->controller_action = $controller_action;
            $this->controller_use_request = $controller_use_request;
            $this->service_action = $service_action;
            $this->request_action = $request_action;

        }
        if ($create){
            $create = explode(',',$create);
            if (in_array("c",$create)) $this->controller($name);//是否创建controller
            if (in_array("m",$create)) $this->model($name);//是否创建model
            if (in_array("s",$create)) $this->service($name);//是否创建service
            if (in_array("r",$create)) $this->request($name);//是否创建request
        }

    }
    protected function controller($name)
    {
        $action = $this->controller_action;
        $use_request = $this->controller_use_request;

        $controllerTemplate = self::replace(
            [
                '{{requestCreate}}',
                '{{requestUpdate}}',
                '{{index}}',
                '{{create}}',
                '{{edit}}',
                '{{update}}',
                '{{delete}}',
                '{{Name}}',
                '{{serviceName}}',
            ],
            [
                @$use_request['create'],
                @$use_request['update'],
                @$action['index'],
                @$action['create'],
                @$action['edit'],
                @$action['update'],
                @$action['delete'],
                $name,
                lcfirst($name),
            ],
            $this->getStub('controller')
        );

        CodeGenerator::saveFile($this->config['file_dir']['controller'].$name.'Controller.php', $controllerTemplate);
    }
    protected function model($name)
    {
        $modelTemplate = self::replace(
            [
                '{{Name}}',
                '{{tolowerName}}',
            ],
            [
                $name,
                self::toUnderScore($name),
            ],
            $this->getStub('model')
        );
        CodeGenerator::saveFile($this->config['file_dir']['model'].$name.'.php', $modelTemplate);
    }
    protected function service($name)
    {
        $action = $this->service_action;
        $serviceTemplate = self::replace(
            [
                '{{lists}}',
                '{{Name}}',
                '{{modelName}}',
            ],
            [
                @$action['lists'],
                $name,
                lcfirst($name),
            ],
            $this->getStub('service')
        );
        CodeGenerator::saveFile($this->config['file_dir']['service'].$name.'Service.php', $serviceTemplate);
    }
    protected function request($name)
    {
        $action = $this->request_action;

        foreach ($action as $k=> $v){
            $template = self::replace(
                [
                    '{{Name}}',
                    '{{TableName}}',
                ],
                [
                    $name,
                    self::toUnderScore($name),
                ],
                @$action[$k]
            );
            if ($template){
                CodeGenerator::saveFile($this->config['file_dir']['request'].$name.ucfirst($k).'Request.php', $template);
            }
        }
    }
    protected function replace($find,$replace,$string){
        return str_replace($find,$replace,$string);
    }
}
