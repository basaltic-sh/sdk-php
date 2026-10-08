<?php

declare(strict_types=1);

namespace Basaltic;

// Generated service accessors. Do not edit.
final class Client
{
    private readonly Transport $transport;
    /** @var array<string, AbstractService> */
    private array $services = [];

    /** @param Config|array<string, mixed> $config */
    public function __construct(#[\SensitiveParameter] Config|array $config = [])
    {
        $this->transport = new Transport($config instanceof Config ? $config : new Config($config));
    }

    public function audit(): Service\Audit
    {
        $service = $this->services['audit'] ??= new Service\Audit($this->transport);
        assert($service instanceof Service\Audit);
        return $service;
    }

    public function billing(): Service\Billing
    {
        $service = $this->services['billing'] ??= new Service\Billing($this->transport);
        assert($service instanceof Service\Billing);
        return $service;
    }

    public function catalog(): Service\Catalog
    {
        $service = $this->services['catalog'] ??= new Service\Catalog($this->transport);
        assert($service instanceof Service\Catalog);
        return $service;
    }

    public function certificate(): Service\Certificate
    {
        $service = $this->services['certificate'] ??= new Service\Certificate($this->transport);
        assert($service instanceof Service\Certificate);
        return $service;
    }

    public function compute(): Service\Compute
    {
        $service = $this->services['compute'] ??= new Service\Compute($this->transport);
        assert($service instanceof Service\Compute);
        return $service;
    }

    public function dns(): Service\Dns
    {
        $service = $this->services['dns'] ??= new Service\Dns($this->transport);
        assert($service instanceof Service\Dns);
        return $service;
    }

    public function iam(): Service\Iam
    {
        $service = $this->services['iam'] ??= new Service\Iam($this->transport);
        assert($service instanceof Service\Iam);
        return $service;
    }

    public function kms(): Service\Kms
    {
        $service = $this->services['kms'] ??= new Service\Kms($this->transport);
        assert($service instanceof Service\Kms);
        return $service;
    }

    public function loadbalancer(): Service\Loadbalancer
    {
        $service = $this->services['loadbalancer'] ??= new Service\Loadbalancer($this->transport);
        assert($service instanceof Service\Loadbalancer);
        return $service;
    }

    public function network(): Service\Network
    {
        $service = $this->services['network'] ??= new Service\Network($this->transport);
        assert($service instanceof Service\Network);
        return $service;
    }

    public function quota(): Service\Quota
    {
        $service = $this->services['quota'] ??= new Service\Quota($this->transport);
        assert($service instanceof Service\Quota);
        return $service;
    }

    public function secrets(): Service\Secrets
    {
        $service = $this->services['secrets'] ??= new Service\Secrets($this->transport);
        assert($service instanceof Service\Secrets);
        return $service;
    }

    public function storage(): Service\Storage
    {
        $service = $this->services['storage'] ??= new Service\Storage($this->transport);
        assert($service instanceof Service\Storage);
        return $service;
    }

    public function telemetry(): Service\Telemetry
    {
        $service = $this->services['telemetry'] ??= new Service\Telemetry($this->transport);
        assert($service instanceof Service\Telemetry);
        return $service;
    }

    public function workspace(): Service\Workspace
    {
        $service = $this->services['workspace'] ??= new Service\Workspace($this->transport);
        assert($service instanceof Service\Workspace);
        return $service;
    }
}
