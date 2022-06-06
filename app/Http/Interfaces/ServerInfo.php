<?php
namespace App\Http\Interfaces;


abstract class ServerInfo
{
    /**
     * @var string Server IP address
     */
    protected $serverIp;

    /**
     * @var string Server Port
     */
    protected $serverPort;

    /**
     * @var mixed|null Server Application Steam Id
     */
    protected $serverAppId;

    /**
     * @var int Server players count
     */
    protected $playersCount;

    /**
     * ServerInfo constructor.
     * @param string $serverAddress
     * @param null $appId
     */
    public function __construct(string $serverAddress, $appId = null)
    {
        list($this->serverIp, $this->serverPort) = array_pad(explode(":", $serverAddress), 2, null);
        $this->serverAppId = $appId;
    }

    /**
     *
     * Check is port of server default
     *
     */
    abstract protected function checkPort();

    /**
     *
     * Making query by server app type
     *
     * @return bool Is query done
     */
    abstract protected function makeQuery(): bool;
}
