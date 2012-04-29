<?php

  // Configure lowcarb
  
  /* Development config */
  $config->url = "//something.dev/";
  $config->salt = "somesalt";
  $config->db = array(
    "host" => "localhost"
  , "user" => "root"
  , "password" => "root"
  , "db" => "something"
  );
  $config->routes = array(
    "" => "index"
  , "on" => "on"
  , "write" => "write"
  , "edit" => "edit"
  , "logout" => "out"
  , "error" => "error"
  , "comment" => "comment"
  , "delete" => "delete"
  );