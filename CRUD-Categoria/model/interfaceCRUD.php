<?php

interface iModelCrud {
    public function create( $object );
    public function read( );
    public function update( $object );
    public function delete( $param );
}


?>