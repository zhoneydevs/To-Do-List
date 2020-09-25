<?php

const HOST = "localhost:3308";
const USER = "root";
const PASSWORD = "";
const DATABASE = "to_do";

final class DBStaticFactory {
    static final function con() {
        return new mysqli(HOST,USER,PASSWORD,DATABASE);
    }
}