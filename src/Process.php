<?php

namespace Technodrive\Process;

use Technodrive\Core\Request;
use Technodrive\Process\Enumeration\StepEnum;
use Technodrive\Process\Interface\StepInterface;
use Technodrive\Router\Router;

class Process implements StepInterface
{

    protected StepEnum $currentStep;
    protected Request $request;
    protected Router $router;
    public function setCurrentStep(StepEnum $step): self
    {
        unset($this->currentStep);
        $this->currentStep = $step;
        return $this;
    }

    public function getCurrentStep(): StepEnum
    {
        return $this->currentStep;
    }

    public function getCurrentStepName(): string
    {
        return$this->currentStep->name;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @param Request $request
     * @return Process
     */
    public function setRequest(Request $request): Process
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return Router
     */
    public function getRouter(): Router
    {
        return $this->router;
    }

    /**
     * @param Router $router
     * @return Process
     */
    public function setRouter(Router $router): Process
    {
        $this->router = $router;
        return $this;
    }

}