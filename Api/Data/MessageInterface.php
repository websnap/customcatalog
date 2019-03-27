<?php

namespace Magedirect\CustomCatalog\Api\Data;

/**
 * Interface MessageInterface
 * @package Magedirect\CustomCatalog\Api\Data
 */
interface MessageInterface
{

    const ENTITY_ID = 'entity_id';

    const COPY_WRITE_INFO = 'copy_write_info';

    const VPN = 'vpn';

    const STORE_ID = 'store_id';

    /** @return string */
    public function getEntityId();

    /**
     * @param string $value
     * @return $this
     */
    public function setEntityId($value);

    /** @return string */
    public function getCopyWriteInfo();

    /**
     * @param string $value
     * @return $this
     */
    public function setCopyWriteInfo($value);

    /** @return string */
    public function getVpn();

    /**
     * @param string $value
     * @return $this
     */
    public function setVpn($value);

    /** @return int */
    public function getStoreId();

    /**
     * @param int $value
     * @return $this
     */
    public function setStoreId($value);
}
