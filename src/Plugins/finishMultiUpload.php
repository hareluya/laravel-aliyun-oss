<?php namespace Hareluya\AliyunOss\Plugins;

use League\Flysystem\FilesystemInterface;
use League\Flysystem\PluginInterface;

class finishMultiUpload implements PluginInterface
{
    protected $filesystem;
    public function setFilesystem(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function getMethod()
    {
        return 'finishMultiUpload';
    }

    public function handle($path,$uploadId,$partsList)
    {
        $res = $this->filesystem->finishMultiUpload($path,$uploadId,$partsList);

        return $res;
    }
}