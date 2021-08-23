<?php

namespace api\controller;

interface InterfaceMetodos{

    public function get($param);

    public function post($param);

    public function put($param);

    public function delete($param);
    
}