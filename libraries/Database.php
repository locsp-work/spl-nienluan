<?php
   /**
   *
   */
  echo "met ";

   class Database
   {
       public $link;
      
       public function __construct()
       {
           try{
            $port='5432';
            $host='ec2-34-193-113-223.compute-1.amazonaws.com';
            $user='xpehnwyltvfgtj';
            $password='e155b86bdeaeb35be03d8740e149913f79041d43ffdd47482fcc1af284027140';
            $dbname='dc9q9sd3uophcq';
            $dsn='pgsql:host='.$host.' port='.$port.' dbname='.$dbname;
            $this->link = new PDO($dsn, $user, $password,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
           }catch(PDOException $e){
            die($e->getMessage());
           }
         
       }

       public function insert($table, array $data)
       {
           //code
           $sql = "INSERT INTO {$table} ";
           $columns = implode(',', array_keys($data));
           $values  = "";
           $sql .= '(' . $columns . ')';
           foreach($data as $field => $value) {
               if(is_string($value)) {
                   $values .= "'". pg_escape_string($this->link,$value) ."',";
               } else {
                   $values .= pg_escape_string($this->link,$value) . ',';
               }
           }
           $values = substr($values, 0, -1);
           $sql .= " VALUES (" . $values . ')';
           // _debug($sql);die;
           pg_query($this->link, $sql) or die("Lỗi  query  insert" .pg_result_error ($this->link));
           return pg_insert($this->link);
       }

       public function update($table, array $data, array $conditions)
       {
           $sql = "UPDATE {$table}";

           $set = " SET ";

           $where = " WHERE ";

           foreach($data as $field => $value) {
               if(is_string($value)) {
                   $set .= $field .'='.'\''. pg_escape_string($this->link, xss_clean($value)) .'\',';
               } else {
                   $set .= $field .'='. pg_escape_string($this->link, xss_clean($value)) . ',';
               }
           }

           $set = substr($set, 0, -1);


           foreach($conditions as $field => $value) {
               if(is_string($value)) {
                   $where .= $field .'='.'\''. pg_escape_string($this->link, xss_clean($value)) .'\' AND ';
               } else {
                   $where .= $field .'='. pg_escape_string($this->link, xss_clean($value)) . ' AND ';
               }
           }

           $where = substr($where, 0, -5);

           $sql .= $set . $where;
           // _debug($sql);die;

           pg_query($this->link, $sql) or die( "Lỗi truy vấn Update -- " .pg_result_error());

           return pg_affected_rows($this->link);
       }
       public function updateview($sql)
       {
           $result = pg_query($this->link,$sql)  or die ("Lỗi update view " .pg_result_error($this->link));
           return pg_affected_rows($this->link);

       }
       public function countTable($table)
       {
           $sql = "SELECT id FROM  {$table}";
           $result = pg_query($this->link, $sql) or die("Lỗi Truy Vấn countTable----" .pg_result_error($this->link));
           $num = pg_num_rows($result);
           return $num;
       }


       public function delete ($table , $id )
       {
           $sql = "DELETE FROM {$table} WHERE id =$id";

           pg_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .pg_result_error ($this->link));
           return pg_affected_rows($this->link);
       }


       public function fetchsql( $sql )
       {
           $result = pg_query($this->link,$sql) or die("Lỗi  truy vấn sql " .pg_result_error($this->link));
           $data = [];
           if( $result)
           {
               while ($num = pg_fetch_assoc($result))
               {
                   $data[] = $num;
               }
           }
           return $data;
       }
       public function fetchsql_arr( $sql )
       {
           $result = pg_query($this->link,$sql) or die("Lỗi  truy vấn sql " .pg_result_error($this->link));
           $data = [];
           if( $result)
           {
               while ($num = pg_fetch_array($result))
               {
                   $data[] = $num;
               }
           }
           return $data;
       }
      //lấy dữ liệu tại dòng ID=? và trả về mảng result
       public function fetchID($table, $id )
       {
           $sql = "SELECT * FROM {$table} WHERE id = $id ";
           $result = pg_query($this->link,$sql) or die("Lỗi  truy vấn fetchID " .pg_result_error($this->link));
           return pg_fetch_assoc($result);
       }

       public function fetchOne($table , $query)
       {
           $sql  = "SELECT * FROM {$table} WHERE ";
           $sql .= $query;
           $sql .= "LIMIT 1";
           $result = pg_query($this->link,$sql) or die("Lỗi  truy vấn fetchOne " .pg_result_error($this->link));
           return pg_fetch_assoc($result);
       }

       public function deletesql ($table ,  $sql )
       {
           $sql = "DELETE FROM {$table} WHERE " .$sql;
           // _debug($sql);die;
           pg_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .pg_result_error($this->link));
           return pg_affected_rows($this->link);
       }
//Lấy tất cả dữ liệu trong cơ sở dữ liệu đưa vào mảng
        public function fetchAll($table)
       {
           $sql = "SELECT * FROM {$table} WHERE 1" ;
           $result = pg_query($this->link,$sql) or die("Lỗi Truy Vấn fetchAll " .pg_result_error($this->link));
           $data = [];
           if( $result)
           {
               while ($num = pg_fetch_assoc($result))
               {
                   $data[] = $num;
               }
           }
           return $data;
       }

//Phân trang
       public  function fetchJones($table,$sql,$total = 1,$page,$row ,$pagi = true )
       {

           $data = [];

           if ($pagi == true )
           {
               $sotrang = ceil($total / $row);
               $start = ($page - 1 ) * $row ;
               $sql .= " LIMIT $start,$row ";
               $data = [ "page" => $sotrang];

               $result = pg_query($this->link,$sql) or die("Lỗi truy vấn fetchJone" .pg_result_error($this->link));
           }
           else
           {
               $result = pg_query($this->link,$sql) or die("Lỗi truy vấn fetchJone" .pg_result_error($this->link));
           }

           if( $result)
           {
               while ($num = pg_fetch_assoc($result))
               {
                   $data[] = $num;
               }
           }

           return $data;
       }
        public  function fetchJone($table,$sql ,$page = 0,$row ,$pagi = false )
       {

           $data = [];
           // _debug($sql);die;
           if ($pagi == true )
           {
               $total = $this->countTable($table);
               $sotrang = ceil($total / $row);
               $start = ($page - 1 ) * $row ;
               $sql .= " LIMIT $start,$row";
               $data = [ "page" => $sotrang];

               $result = pg_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .pg_result_error($this->link));
           }
           else
           {
               $result = pg_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .pg_result_error($this->link));
           }

           if( $result)
           {
               while ($num = pg_fetch_assoc($result))
               {
                   $data[] = $num;
               }
           }
           // _debug($data);
           return $data;
       }
       public function total($sql)
       {
           $result = pg_query($this->link  , $sql);
           $tien = pg_fetch_assoc($result);
           return $tien;
       }
   }

   ?>
