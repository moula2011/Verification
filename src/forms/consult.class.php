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
            file_put_contents($this->json_file,json_encode($this->stored_data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
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

        public function updateProd($client_id,$item,$item_value,$check,$verify){
            foreach($this->stored_data as $key =>$stored_client){
                if($stored_client['client_id']==$client_id){
                    if($this->stored_data[$key][$item]['medicines']==null){
                        $this->stored_data[$key][$item]['medicines']=$item_value;
                        $this->stored_data[$key]['checked']=$check;
                        $this->stored_data[$key]['verified']=$verify;
                        $this->stored_data[$key]['num']=$this->number_of_records;
                    }else{
                        array_push($this->stored_data[$key][$item]['medicines'],$item_value[0]); 
                    }
                }
                $this->storeData();
            }
        }
        public function updateconsu($client_id,$item,$item_value,$check,$verify){
            foreach($this->stored_data as $key =>$stored_client){
                if($stored_client['client_id']==$client_id){

                    if($this->stored_data[$key][$item]['consultation']==null){
                        $this->stored_data[$key][$item]['consultation']=$item_value;
                        $this->stored_data[$key]['checked']=$check;
                        $this->stored_data[$key]['verified']=$verify;
                        $this->stored_data[$key]['num']=$this->number_of_records;

                    }else{
                        array_push($this->stored_data[$key][$item]['consultation'],$item_value[0]); 
                    }
                }
                $this->storeData();
            }
        }

        public function updatelabo($client_id,$item,$item_value,$check,$verify){
            foreach($this->stored_data as $key =>$stored_client){
                if($stored_client['client_id']==$client_id){
                    if($this->stored_data[$key][$item]['laboratoire']==null){
                        $this->stored_data[$key][$item]['laboratoire']=$item_value;
                        $this->stored_data[$key]['checked']=$check;
                        $this->stored_data[$key]['verified']=$verify;
                    }else{
                        array_push($this->stored_data[$key][$item]['laboratoire'],$item_value[0]); 
                    }
                }
                $this->storeData();
            }
        }

        public function updatesoin($client_id,$item,$item_value,$check,$verify){
            foreach($this->stored_data as $key =>$stored_client){
                if($stored_client['client_id']==$client_id){
                    if($this->stored_data[$key][$item]['soins']==null){
                        $this->stored_data[$key][$item]['soins']=$item_value;
                        $this->stored_data[$key]['checked']=$check;
                        $this->stored_data[$key]['verified']=$verify;
                    }else{
                        array_push($this->stored_data[$key][$item]['soins'],$item_value[0]); 
                    }
                }
                $this->storeData();
            }
        }

        public function updatehosp($client_id,$item,$item_value,$check,$verify){
            foreach($this->stored_data as $key =>$stored_client){
                if($stored_client['client_id']==$client_id){
                    if($this->stored_data[$key][$item]['hospitalisation']==null){
                        $this->stored_data[$key][$item]['hospitalisation']=$item_value;
                        $this->stored_data[$key]['checked']=$check;
                        $this->stored_data[$key]['verified']=$verify;
                    }else{
                        array_push($this->stored_data[$key][$item]['hospitalisation'],$item_value[0]); 
                    }
                }
                $this->storeData();
            }
        }

        public function updateconsum($client_id,$item,$item_value,$check,$verify){
            foreach($this->stored_data as $key =>$stored_client){
                if($stored_client['client_id']==$client_id){
                    if($this->stored_data[$key][$item]['consommables']==null){
                        $this->stored_data[$key][$item]['consommables']=$item_value;
                        $this->stored_data[$key]['checked']=$check;
                        $this->stored_data[$key]['verified']=$verify;
                    }else{
                        array_push($this->stored_data[$key][$item]['consommables'],$item_value[0]); 
                    }
                }
                $this->storeData();
            }
        }

        public function updateVerif($client_id,$item,$type,$item_value,$it){
            foreach($this->stored_data as $key =>$stored_client){
                if($stored_client['client_id']==$client_id){
                    if($this->stored_data[$key][$item]['verification'][$type]==null){
                        $this->stored_data[$key][$item]['verification'][$type]=$item_value;
                    }else{ 
                        // $this->stored_data[$key][$item]['verification'][$type]=$item_value;                       
                        //---------------------------------kkkkkkkkkkkk----------------------------
                        foreach($this->stored_data[$key][$item]['verification'][$type] as $k => $v){                                                 
                            if($v['item']==$it){
                                $this->stored_data[$key][$item]['verification'][$type][$k]=$item_value[0];                                
                            }else{
                                
                            }                                                                                  
                        }
                        //---------------------------------kkkkkkkkkkkk----------------------------                 
                    }
                }
                $this->storeData();
            }
        }

        public function updateDone($client_id){
            foreach($this->stored_data as $key =>$stored_client){
                if($stored_client['client_id']==$client_id){
                    $this->stored_data[$key]['done']=1;                        
                }
                $this->storeData();
            }
        }

        public function updatechecked($client_id,$item,$item_value){
            foreach($this->stored_data as $key =>$stored_client){
                if($stored_client['client_id']==$client_id){
                    $this->stored_data[$key][$item]=$item_value; 
                }
                $this->storeData(); 
            }
        }

        public function updatecheckedspecial($client_id,$item,$item_value){
            foreach($this->stored_data as $key =>$stored_client){
                if($stored_client['client_id']==$client_id){
                    $this->stored_data[$key][$item]=$item_value; 
                }
                $this->storeData(); 
            }
        }

        public function updatecheckedmed($client_id,$item,$item_value,$name){
            foreach($this->stored_data as $key =>$stored_client){
                if($stored_client['client_id']==$client_id || $stored_client['med_item']==$name){
                    $this->stored_data[$key]['items']['medicines'][$key][$item]=$item_value; 
                }
                $this->storeData(); 
            }
        }
        public function updatecheckedconso($client_id,$item,$item_value,$name){
            foreach($this->stored_data as $key =>$stored_client){
                if($stored_client['client_id']==$client_id || $stored_client['conso_item']==$name){
                    $this->stored_data[$key]['items']['consommables'][$key][$item]=$item_value; 
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