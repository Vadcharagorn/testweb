<?php
    class db{
        private $db;
        private $debug;
        function __construct($user,$pass,$dbname,$debug){
            $this->db = new mysqli("localhost",$user,$pass,$dbname);
            $this->db->set_charset("utf8");
            $this->debug = $debug;
            if($this->db->connect_errno){
                echo "Failed to connect to MySQL".
                    $this->db->connect_error;
                exit();
            }
            else $this->debug_text("Connected");
        }

        function query($sql){
            $result = $this->db->query($sql);
            $this->debug_text($sql);
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data;
        }

        function query_set($sql){
            $result = $this->db->query($sql);
            $this->debug_text($sql);
        }

        function debug_text($text){
            if($this->debug == 1){
                echo "Debug: {$text}";
            }
        }

        function close(){
            $this->db->close();
        }
    }

    //$mydb = new db("root","","personal", true);
    //$data = $mydb->query("select * from personal");
    //print_r($data);
?>