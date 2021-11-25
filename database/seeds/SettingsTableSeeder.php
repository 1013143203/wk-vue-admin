<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Settings;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'=>'files',
                'value'=>[
                    'storage'=>'local',
                    "img"=>[
                        'size'=>5000,
                        'ext'=>['gif','jpg','jpeg','png'],
                        'dir'=>'img/',
                    ],
                    'audio'=>array(
                        'size'=>5000,
                        'ext'=>['mp3'],
                        'dir'=>'audio/'
                    ),
                    'file'=>array(
                        'size'=>5000,
                        'ext'=>['doc','docx','xls','xlsx','ppt','pptx','pdf','rar','zip'],
                        'dir'=>'file/'
                    ),
                    'video'=>array(
                        'size'=>5000,
                        'ext'=>['mp4'],
                        'dir'=>'video/'
                    ),
                ]
            ]
        ];
        foreach ($data as $d){
            $d['value'] = json_encode($d['value']);
            Settings::create($d);
        }
        dump('系统设置 success');
    }
}
