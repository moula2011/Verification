<?php
    class Consult{

        private $json_file;

        private $stored_data;

        private $number_of_records;

        private $ids=[];

        private $insurance_codes = [];

        public function __construct($file_path)
        {
            $this->json_file=$file_path;
            $this->stored_data = json_decode(file_get_contents($this->json_file),true);
            $this->number_of_records = count($this->stored_data);

            if ($this->number_of_records !=0) {
                foreach($this->stored_data as $client){
                    array_push($this->ids,$client['id']);
                    array_push($this->insurance_codes,$client['client_id']);
                }
                
            }
        }

        private function setClientId($client){
            if ($this->number_of_records == 0) {
                $client['id'] = 1;              
            }else{
                $client['id'] = max($this->ids)+1;
            }
            return $client;
        }

        private function storeData(){
            file_put_contents(
                $this->json_file,
                json_encode($this->stored_data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)
            );
        }

        public function insertNewClient($new_client){
            $client_with_id_field = $this-> setClientId($new_client);
            array_push($this->stored_data,$client_with_id_field);
            if ($this->number_of_records == 0) {
                $this->storeData();
            }else {
                if (!in_array($new_client['client_id'],$this->insurance_codes)) {
                    $this->storeData();

                }
            }
        }

        public function updateClient($client_id,$item,$item_value,$conso,$conso_value,$check,$check_value
        ,$verifie,$verifie_value){
            foreach($this->stored_data as $key =>$stored_client){
                if($stored_client['client_id']==$client_id){
                    $this->stored_data[$key][$item]=$item_value; 
                    $this->stored_data[$key][$conso]=$conso_value; 
                    $this->stored_data[$key][$check]=$check_value;  
                    $this->stored_data[$key][$verifie]=$verifie_value; 
                }
                $this->storeData();
            }
        }

        public function updatechecked($client_id,$chk,$chk_value,$item,$item_value){
            foreach($this->stored_data as $key =>$stored_client){
                if($stored_client['client_id']==$client_id){
                    $this->stored_data[$key][$chk]=$chk_value; 
                    $this->stored_data[$key][$item]=[$item_value]; 
                }
                $this->storeData();
            }
        }

        public function deleteClient($id){

        }

        public function deleteAllClients(){

        }

        public function getClients(){

            return $this->stored_data;
        }
    }