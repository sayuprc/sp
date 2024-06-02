<?php

function funcA()
{
    return 'func_a';
}

function funcB()
{
   return 'func_b/' . funcA();
}

echo funcB();
