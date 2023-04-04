<?php

namespace Technodrive\Process\Enumeration;

enum StepEnum
{
    case load;
    case bootstrap;
    case route;
    case dispatch;
    case view_render;
    case layout_render;
    case error;
}
