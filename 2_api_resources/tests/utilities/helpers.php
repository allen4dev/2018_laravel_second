<?php
  
function create($class, $overrides = [], $times = null)
{
  return factory($class, $times)->create($overrides);
}

function make($class, $overrides = [], $times = null)
{
  return factory($class, $times)->make($overrides);
}

function raw($class, $overrides = [], $times = null)
{
  return factory($class, $times)->raw($overrides);
}