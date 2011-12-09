<?php

  // Configure lowcarb
  
  /* Development config */
  $config->url = "//blog.dev/";
  $config->salt = "cardiffschoolofcomputerscience";
  $config->db = array(
    "host" => "localhost"
  , "user" => "root"
  , "password" => "root"
  , "db" => "lowcarb"
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

  /* Production config */
  $config->environment('production');
  
  $config->url = "//project.cs.cf.ac.uk/T.Ashworth/blog/";
  $config->prefix = "/T.Ashworth/blog";
  $config->salt = "cardiffschoolofcomputerscience";
  $config->db = array(
    "host" => "ephesus.cs.cf.ac.uk"
  , "user" => "c1103808"
  , "password" => "howbau"
  , "db" => "c1103808"
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