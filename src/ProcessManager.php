<?php

namespace Technodrive\Process;

use Technodrive\Core\Enumeration\ProcessStepEnum;
use Technodrive\Core\Interface\ListenerInterface;
use Technodrive\Core\Service\ServiceManager;
use Technodrive\Process\Exception\BadListenerException;
use Technodrive\Process\Interface\ProcessInterface;

class ProcessManager implements ProcessInterface
{
    protected Process $step;
    protected \ArrayObject $configuration;

    protected ServiceManager $serviceManager;

    public function __construct(ServiceManager $serviceManager)
    {
        $this->setConfiguration($serviceManager->getConfig());
        $this->setServiceManager($serviceManager);
    }

    /**
     * @return Process
     */
    public function getProcess(): Process
    {
        return $this->step;
    }

    /**
     * @param Process $step
     * @return ProcessManager
     */
    public function setProcess(Process $step): ProcessManager
    {
        $this->step = $step;
        return $this;
    }

    /**
     * @return ServiceManager
     */
    public function getServiceManager(): ServiceManager
    {
        return $this->serviceManager;
    }

    /**
     * @param ServiceManager $serviceManager
     * @return ProcessManager
     */
    public function setServiceManager(ServiceManager $serviceManager): ProcessManager
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    public function setConfiguration(\ArrayObject $configuration): void
    {
        $this->configuration = $configuration;
    }

    public function triggerStep(Process $step)
    {
        $this->triggerListener($step);
    }

    /**
     * @param Process $step
     * @return void
     * @throws BadListenerException
     * @throws \Technodrive\Core\Exception\BadFactoryException
     * @todo aggregate listeners to permit listener detachment
     */
    public function triggerListener(Process $step): void
    {
        $stepName = $step->getCurrentStepName();
        $listeners = $this->configuration['listeners'];
        if(! isset($listeners['listen'][$stepName])){
            //not listener fot the step
            //echo 'no listener for : ' . $stepName;
            return;
        }
        foreach ($listeners['listen'][$stepName] as $listener){
            //@todo call a specific method
            $callable = $this->serviceManager->get($listener);
            if(! $callable instanceof ListenerInterface) {
                throw new BadListenerException(sprintf('Listener %1$s must implement %2$s', $callable::class, ListenerInterface::class));
            }
            $callable->call();
        }
    }
}