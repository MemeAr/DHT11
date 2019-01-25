<?php
class NodeMcu {
    public function dataNodeMcu(){
        $data_json = file_get_contents("php://input");
        $filename_temperature = 'data.json';
        
        $data = json_decode($data_json);
        if (! $data) {
            http_response_code(415);
            exit();
        }
        
        elseif (! $data->temperature || ! $data->humidite) {
            http_response_code(400);
            exit();
        }
        
        $op = file_put_contents($filename_temperature, $data_json);
        if (! $op) {
            http_response_code(500);
        }
    }
}