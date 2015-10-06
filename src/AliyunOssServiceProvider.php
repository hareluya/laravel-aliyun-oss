<?php namespace Hareluya\AliyunOss;

use Storage;
use Aliyun\ALIOSS;
use Hareluya\AliyunOss\AliyunOssAdapter;
use League\Flysystem\Filesystem;
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

            $client = new ALIOSS($ossconfig['AccessKeyId'], $ossconfig['AccessKeySecret'], $ossconfig['Endpoint']);

            return new Filesystem(new AliyunOssAdapter($client, $config['bucket'], $config['prefix']));
        });
    }

    public function register()
    {
        //
    }
}
