<?php

namespace app\components;

use nizsheanez\jsonRpc\Client as BaseClient;
use yii\base\Component;


class Client extends Component
{

    public $url;

    private $client;

    public function init()
    {
        $this->client = new BaseClient($this->url);
    }

    public function send($name, $arguments)
    {
        return $this->client->callServer($name, $arguments, $this->url);
    }

}
