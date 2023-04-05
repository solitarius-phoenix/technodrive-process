<?php

namespace Technodrive\Process;

use Technodrive\Core\Factory\ResponseFactory;
use Technodrive\Core\Request;
use Technodrive\Core\Response;
use Technodrive\Process\Enumeration\StepEnum;
use Technodrive\Process\Interface\StepInterface;
use Technodrive\Router\RouteMatch;
use Technodrive\Router\Router;

class Process implements StepInterface
{

    protected StepEnum $currentStep;
    protected Request $request;
    protected Response $response;
    protected Router $router;
    protected RouteMatch $routeMatch;

    protected string$controllerModule;

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
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * @param Response $response
     * @return Process
     */
    public function setResponse(Response $response): Process
    {
        $this->response = $response;
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

    /**
     * @return RouteMatch
     */
    public function getRouteMatch(): RouteMatch
    {
        return $this->routeMatch;
    }

    /**
     * @param RouteMatch $routeMatch
     * @return Process
     */
    public function setRouteMatch(RouteMatch $routeMatch): Process
    {
        $this->routeMatch = $routeMatch;
        return $this;
    }

    /**
     * @return string
     */
    public function getControllerModule(): string
    {
        return $this->controllerModule;
    }

    /**
     * @param string $controllerModule
     * @return Process
     */
    public function setControllerModule(string $controllerModule): Process
    {
        $this->controllerModule = $controllerModule;
        return $this;
    }
}