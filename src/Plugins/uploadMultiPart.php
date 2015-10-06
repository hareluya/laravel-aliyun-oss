<?php namespace Hareluya\AliyunOss\Plugins;

use League\Flysystem\FilesystemInterface;
use League\Flysystem\PluginInterface;

class uploadMultiPart implements PluginInterface
{
    protected $filesystem;
    public function setFilesystem(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function getMethod()
    {
        return 'uploadMultiPart';
    }

    public function handle($file,$path,$uploadId,$count)
    {

        $response = $this->filesystem->uploadMultiPart($file,$path,$uploadId,$count);

        return $response;
    }
}