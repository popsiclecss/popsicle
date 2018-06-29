<?php
  interface ConnectionAdapterInterface {
    public function __construct( $_srv, $_db, $_usr, $_pass);
    public function query( $_query );
    public function queryFetch( $_query );
    public function queryArray( $_query );
    public function queryInsert( $_query );
  }
?>
