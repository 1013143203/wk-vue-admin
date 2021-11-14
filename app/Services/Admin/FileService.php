<?php
namespace App\Services\Admin;

use App\Exceptions\AdminException;
use App\Models\Admin\FileSystems;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class FileService extends BaseService
{
    public function __construct(FileSystems $file_systems)
    {
        $this->model = $file_systems;
    }
    public function chunk($request)
    {
        $md5 = $request->input('identifier');
        $tmpDir = $this->tmpDir($md5);
        if ($_GET['identifier']){
            if ($this->model->where('md5',$md5)->first()){
                return ['skipUpload'=>true];//文件已存在
            }
            $uploaded = [];
            for ($i=1;$i<=$request->input('totalChunks');$i++){
                if ($this->fileExists($tmpDir.$i)){//分块已存在
                    $uploaded[] = $i;
                }
            }
            return [
                'skipUpload'=>false,
                'uploaded'=>$uploaded
            ];
        }else{
            $file = $request->file('upfile');
            $res = [];
            $chunkNumber = $request->input('chunkNumber');
            if(empty($file) || !$file->isValid() || !$request->hasFile('upfile')){
                throw new AdminException(201,'文件上传失败');
            }
            $this->filePut($tmpDir.$chunkNumber,$file);
            $res['msg'] = "分块-{$chunkNumber}-已上传";
            if ($request->input('chunkNumber') == $request->input('totalChunks')){
                $res['needMerge'] = true;
                $res['totalChunks'] = $request->input('totalChunks');
                $res['identifier'] = $request->input('identifier');
            }
            return $res;
        }
    }

    public function merge($request)
    {
        $md5 = $request->input('identifier');
        $ext = '.'.$request->input('ext');

        $tmpDir = $this->tmpDir($md5);
        $fileDir = $this->fileDir($md5);
        $filepath = public_path().DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.$fileDir.$md5.$ext;
        for ($i=1;$i<=(int)$request->input('totalChunks');$i++){
            if ($this->fileExists($tmpDir.$i)){//分块已存在
                $blob = $this->fileContent($tmpDir.$i);
                file_put_contents($filepath,$blob,FILE_APPEND);
            }else{
                $this->fileDelete($fileDir.$ext);
                throw new AdminException(201,'文件合并失败');
            }
        }
        for ($i=1;$i<=$request->input('totalChunks');$i++){
            $this->fileDelete($tmpDir.$i);
        }

        //存入数据库
        $id = $this->model->createItem([
            'url'=>$filepath,
            'create_id' =>request('user')->id,
            'fileType'=>$request->input('fileType'),
            'type'=>$request->input('fileType'),
            'md5'=>$request->input('identifier'),
            'name'=>$request->input('name'),
            'size'=>$request->input('size'),
            'ext'=>$request->input('ext'),
            'storage'=>'local',
        ]);


        return [
            'msg'=>'合并成功',
            'id'=>$id
        ];
    }

    function fileContent($filename){
        return Storage::disk('local')->get($filename);
    }
    protected function fileExists($filename){
        return Storage::disk('local')->exists($filename);
    }
    protected function filePut($filename,$file){
        $bool = Storage::disk('local')->put($filename,file_get_contents($file->getRealPath()));
        if (!$bool){
            throw new AdminException(201,'文件上传失败');
        }
    }
    protected function fileDelete($filename){
        Storage::disk('local')->delete($filename);
    }

    protected function tmpDir($md5){
        $dir = 'tmp'.DIRECTORY_SEPARATOR.$md5.DIRECTORY_SEPARATOR;
        $this->createDir($dir);
        return $dir;
    }

    protected function fileDir(){
        $now = Carbon::now();
        $dir = $now->year.DIRECTORY_SEPARATOR.$now->month.DIRECTORY_SEPARATOR.$now->day.DIRECTORY_SEPARATOR;
        $this->createDir($dir);
        return $dir;
    }

    protected function createDir($dir){
        if (!is_dir($dir)) {
            Storage::disk('local')->makeDirectory($dir);
//            mkdir($dir, 0777, true);
        }
    }
}
