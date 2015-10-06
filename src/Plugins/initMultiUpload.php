<?php namespace Hareluya\AliyunOss\Plugins;

use League\Flysystem\FilesystemInterface;
use League\Flysystem\PluginInterface;

class initMultiUpload implements PluginInterface
{
    protected $filesystem;
    public function setFilesystem(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function getMethod()
    {
        return 'initMultiUpload';
    }

    public function handle($path)
    {
        $uploadId = $this->filesystem->initMultiUpload($path);

        return $uploadId;
    }
}