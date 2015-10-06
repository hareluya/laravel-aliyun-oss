<?php namespace Hareluya\AliyunOss;

use Hareluya\AliyunOss\Plugins\finishMultiUpload;
use Hareluya\AliyunOss\Plugins\initMultiUpload;
use Hareluya\AliyunOss\Plugins\mergeMultiInfo;
use Hareluya\AliyunOss\Plugins\uploadMultiPart;
use Storage;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter;
use Illuminate\Support\ServiceProvider;

class AliyunOssServiceProvider extends ServiceProvider {

 	public function boot()
    {
        Storage::extend('oss', function($app, $config)
        {
            $ossconfig = [
                'AccessKeyId'       => $config['access_id'],
                'AccessKeySecret'   => $config['access_key']
            ];

            if (isset($config['endpoint']) && !empty($config['endpoint']))
                $ossconfig['Endpoint'] = $config['endpoint'];

            $client = new \ALIOSS($ossconfig['AccessKeyId'], $ossconfig['AccessKeySecret'], $ossconfig['Endpoint']);

            $filesystem=new Filesystem(new AliyunOssAdapter($client, $config['bucket'], $config['prefix']));
            $filesystem->addPlugin(new initMultiUpload);
            $filesystem->addPlugin(new mergeMultiInfo);
            $filesystem->addPlugin(new uploadMultiPart);
            $filesystem->addPlugin(new finishMultiUpload);

            return $filesystem;



        });
    }

    public function register()
    {
        //
    }
}
