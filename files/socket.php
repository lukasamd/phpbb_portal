<?php

/*
date_default_timezone_set('Europe/Berlin');

     
require_once('integrator.php');


require_once("vendor/autoload.php");
use Devristo\Phpws\Server\WebSocketServer;

$loop = \React\EventLoop\Factory::create();

// Create a logger which writes everything to the STDOUT
$logger = new \Zend\Log\Logger();
$writer = new Zend\Log\Writer\Stream("php://output");
$logger->addWriter($writer);

// Create a WebSocket server using SSL
$server = new WebSocketServer("tcp://0.0.0.0:12345", $loop, $logger);

$i = 0;

$loop->addPeriodicTimer(0.5, function() use($server, $logger){
    $time = new DateTime();
    $string = $time->format("Y-m-d H:i:s Y");
    
    global $i, $db;

    
    $logger->notice("Broadcasting time to all clients: $string");
    foreach($server->getConnections() as $client)
        $client->sendString($string);
});


// Bind the server
$server->bind();

// Start the event loop
$loop->run();

*/

require_once('integrator.php');

// Set timezone of script to UTC inorder to avoid DateTime warnings in
// vendor/zendframework/zend-log/Zend/Log/Logger.php
date_default_timezone_set('UTC');

require_once("vendor/autoload.php");

// Run from command prompt > php chat.php
use Devristo\Phpws\Framing\WebSocketFrame;
use Devristo\Phpws\Framing\WebSocketOpcode;
use Devristo\Phpws\Messaging\WebSocketMessageInterface;
use Devristo\Phpws\Protocol\WebSocketTransportInterface;
use Devristo\Phpws\Server\IWebSocketServerObserver;
use Devristo\Phpws\Server\UriHandler\WebSocketUriHandler;
use Devristo\Phpws\Server\WebSocketServer;

/**
* This ChatHandler handler below will respond to all messages sent to /chat (e.g. ws://localhost:12345/chat)
*/
class ChatHandler extends WebSocketUriHandler {

    /**
* Notify everyone when a user has joined the chat
*
* @param WebSocketTransportInterface $user
*/
    public function onConnect(WebSocketTransportInterface $user){   
        foreach($this->getConnections() as $client){
            $client->sendString("Użytkownik <b>{$user->getId()}</b> dołączył do czatu: ");

        }
    }

    /**
* Broadcast messages sent by a user to everyone in the room
*
* @param WebSocketTransportInterface $user
* @param WebSocketMessageInterface $msg
*/
    public function onMessage(WebSocketTransportInterface $user, WebSocketMessageInterface $msg) {
        $this->logger->notice("Wysyłanie " . strlen($msg->getData()) . " bajtów");
        
        foreach($this->getConnections() as $client){   
            $client->sendString($msg->getData());
        }
    }
}



// Obsługa innych pokoi - nie zaimplementowane
/*
class ChatHandlerForUnroutedUrls extends WebSocketUriHandler {
public function onConnect(WebSocketTransportInterface $user){

$this->logger->notice("User {$user->getId()} did not join any room");
    }
    public function onMessage(WebSocketTransportInterface $user, WebSocketMessageInterface $msg) {
        $this->logger->notice("User {$user->getId()} is not in a room but tried to say: {$msg->getData()}");
    }
}
*/


$loop = \React\EventLoop\Factory::create();

// Create a logger which writes everything to the STDOUT
$logger = new \Zend\Log\Logger();
$writer = new Zend\Log\Writer\Stream("php://output");
$logger->addWriter($writer);

// Create a WebSocket server
$server = new WebSocketServer("tcp://0.0.0.0:12345", $loop, $logger);

// Create a router which transfers all /chat connections to the ChatHandler class
$router = new \Devristo\Phpws\Server\UriHandler\ClientRouter($server, $logger);
// route /chat url
$router->addRoute('#^/chat$#i', new ChatHandler($logger));



// route unmatched urls durring this demo to avoid errors
// $router->addRoute('#^(.*)$#i', new ChatHandlerForUnroutedUrls($logger));

// Bind the server
$server->bind();

// Start the event loop
$loop->run();
