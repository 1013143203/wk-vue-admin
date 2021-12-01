<?php

//快速修改.env文件
function modifyEnv(array $data)
{
    $envPath      = base_path() . DIRECTORY_SEPARATOR . '.env';
    $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));
    $contentArray->transform(function ($item) use ($data)
    {
        foreach ($data as $key => $value) {
            if (str_contains($item, $key)) {
                return $key . '=' . $value;
            }
        }
        return $item;
    });
    $content = implode($contentArray->toArray(), "\n");
    \Illuminate\Support\Facades\File::put($envPath, $content);
}
function modifyConfig($name,$value)
{
    $config = \Illuminate\Support\Facades\Config::get($name);
    $path = base_path()  . DIRECTORY_SEPARATOR . 'config'.DIRECTORY_SEPARATOR."$name.php";
    file_put_contents($path, "<?php \n return ".var_export($value, true)  . ";");
}