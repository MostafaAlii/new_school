'use strict';

const express   =       require('express');
const http      =       require('http');
const socket    =       require('socket.io');

class Server{
    constructor(){
        this.port = 7000;
        this.host = 'localhost';
        this.app  = express();
        this.http = http.Server(this.app);

    }
    runServer(){
        this.http.listen(this.port,this.host,()=>{
            console.log(`the server is runing at http://${this.host}:${this.port}`);
    });
    }
}
const app = new Server();
app.runServer();