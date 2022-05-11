<?php
namespace Neosoft\Nettelo\Api;

interface BodyMeasurementInterface
{

    /**
     * @api
     * @param mixed[] $ExternalId
     * @return string
     */
    public function bodyMeasurement($ExternalId);
}