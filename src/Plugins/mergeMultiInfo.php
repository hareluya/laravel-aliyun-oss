<?php namespace Hareluya\AliyunOss\Plugins;

use League\Flysystem\FilesystemInterface;
use League\Flysystem\PluginInterface;

class mergeMultiInfo implements PluginInterface
{
    protected $filesystem;
    public function setFilesystem(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function getMethod()
    {
        return 'mergeMultiInfo';
    }

    public function handle($res,$partsList,$count)
    {

        $partsList = $this->filesystem->mergeMultiInfo($res,$partsList,$count);

        return $partsList;
    }
}