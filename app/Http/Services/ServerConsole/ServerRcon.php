<?php

namespace App\Http\Services\ServerConsole;

use Exception;

class ServerRcon {

    /** @var string Host name */
    protected string $host;
    /** @var int Host rcon port */
    protected int $port;
    /** @var string Host password */
    protected string $password;
    /** @var int Connection timeout */
    protected int $timeout;

    /** @var resource Socket resource */
    private $socket;

    /** @var bool Is authorized in server */
    private bool $authorized;
    /** @var string|null Last response after command send or connection */
    private ?string $lastResponse = null;
    /** @var int Response code */
    private int $lastResponseCode;

    const PACKET_AUTHORIZE = 5;
    const PACKET_COMMAND = 6;

    const SERVERDATA_AUTH = 3;
    const SERVERDATA_AUTH_RESPONSE = 2;
    const SERVERDATA_EXEC_COMMAND = 2;
    const SERVERDATA_RESPONSE_VALUE = 0;

    /**
     *
     * Rcon class
     *
     * @param string $host Host address
     * @param int $port Rcon port
     * @param string $password Rcon password
     * @param int $timeout Connection timeout
     */
    public function __construct(string $host, int $port, string $password, int $timeout = 3)
    {
        $this->host = $host;
        $this->port = $port;
        $this->password = $password;
        $this->timeout = $timeout;

        $this->connect();
    }

    /**
     *
     * Get response text
     *
     * @return string
     */
    public function getResponse(): ?string
    {
        return $this->lastResponse;
    }

    /**
     *
     * Get response code
     *
     * @return int
     */
    public function getResponseCode(): int
    {
        return $this->lastResponseCode;
    }

    /**
     *
     * Connect to server
     *
     * @return void
     */
    private function connect(): void
    {
        try{
            $this->socket = fsockopen($this->host, $this->port, $errorCode, $errorString, $this->timeout);
        } catch (Exception $exception) {
            $this->lastResponse = "неверный адрес сервера.";
            $this->authorized = false;
            return;
        }


        if (!$this->socket) {
            $this->lastResponse = $errorString;
            $this->lastResponseCode = $errorCode;

            $this->authorized = false;
        }

        // setting timeout
        stream_set_timeout($this->socket, 3, 0);

        // authorize
        $this->authorize();
    }

    public function disconnect(): void
    {
        if ($this->socket) {
            fclose($this->socket);
        }
    }

    public function isConnected(): bool
    {
        return $this->authorized;
    }

    public function sendCommand($command)
    {
        if (!$this->isConnected()) {
            return false;
        }

        // send command packet.
        $this->writePacket(self::PACKET_COMMAND, self::SERVERDATA_EXEC_COMMAND, $command);

        // get response.
        $response_packet = $this->readPacket();
        if ($response_packet['id'] == self::PACKET_COMMAND) {
            if ($response_packet['type'] == self::SERVERDATA_RESPONSE_VALUE) {
                $this->lastResponse = $response_packet['body'];
                return $response_packet['body'];
            }
        }

        return false;
    }

    private function authorize(): void
    {
        $this->writePacket(self::PACKET_AUTHORIZE, self::SERVERDATA_AUTH, $this->password);
        $response_packet = $this->readPacket();

        if(!$response_packet) {
            $this->lastResponse = "MNS Game не получил ответ при попытке запроса данных с сервера.";
            $this->authorized = false;
            return;
        }

        if ($response_packet['type'] == self::SERVERDATA_AUTH_RESPONSE) {
            if ($response_packet['id'] == self::PACKET_AUTHORIZE) {
                $this->authorized = true;
                return;
            }
        }

        $this->authorized = false;
        $this->lastResponse = "неверный Rcon пароль сервера";

        $this->disconnect();
    }

    /**
     * Writes a packet to the socket stream
     * @param $packet_id
     * @param $packet_type
     * @param $packet_body
     */
    private function writePacket($packet_id, $packet_type, $packet_body)
    {
        //create packet
        $packet = pack("VV", $packet_id, $packet_type);
        $packet = $packet . $packet_body . "\x00";
        $packet = $packet . "\x00";

        // get packet size.
        $packet_size = strlen($packet);

        // attach size to packet.
        $packet = pack("V", $packet_size) . $packet;

        // write packet.
        fwrite($this->socket, $packet, strlen($packet));

    }

    private function readPacket()
    {
        // Read packet size
        $sizeData = fread($this->socket, 4);

        try {
            $sizePack = unpack("V1size", $sizeData);
        } catch (Exception $exception) {
            return false;
        }

        $size = $sizePack['size'];

        return unpack("V1id/V1type/a*body", fread($this->socket, $size));
    }
}
