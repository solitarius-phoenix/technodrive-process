<?php

namespace Technodrive\Process\Interface;

use Technodrive\Process\Process;

interface ProcessInterface
{
    public function triggerStep(Process $step);
}