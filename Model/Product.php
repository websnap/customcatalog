<?php

namespace Magedirect\CustomCatalog\Model;

class Product extends \Magento\Framework\DataObject implements \Magedirect\CustomCatalog\Api\Data\ProductInterface
{

    /**
     * Return Product ID
     * @return null
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Set Product ID
     * @param string $value
     * @return $this
     */
    public function setEntityId($value)
    {
        $this->setData(self::ENTITY_ID, $value);
        return $this;
    }

    /**
     * Return Copy Write Info
     * @return null
     */
    public function getCopyWriteInfo()
    {
        return $this->getData(self::COPY_WRITE_INFO);
    }

    /**
     * Set Copy Write Info
     * @param string $value
     * @return $this
     */
    public function setCopyWriteInfo($value)
    {
        $this->setData(self::COPY_WRITE_INFO, $value);
        return $this;
    }

    /**
     * Return VPN
     * @return null
     */
    public function getVpn()
    {
        return $this->getData(self::VPN);
    }

    /**
     * Set VPN
     * @param string $value
     * @return $this
     */
    public function setVpn($value)
    {
        $this->setData(self::VPN, $value);
        return $this;
    }
}
