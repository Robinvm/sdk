<?php
declare(strict_types=1);

namespace PayNL\Sdk\Hydrator;

use \Exception;
use Zend\Hydrator\ClassMethods;
use PayNL\Sdk\Model\Refund as RefundModel;
use PayNL\Sdk\DateTime;
use PayNL\Sdk\Validator\ObjectInstanceValidator;
use PayNL\Sdk\Exception\InvalidArgumentException;

/**
 * Class Refund
 *
 * @package PayNL\Sdk\Hydrator
 */
class Refund extends ClassMethods
{
    /**
     * @param array $data
     * @param object $object
     *
     * @throws InvalidArgumentException
     * @throws Exception
     *
     * @return RefundModel
     */
    public function hydrate(array $data, $object): RefundModel
    {
        $instanceValidator = new ObjectInstanceValidator();
        if (false === $instanceValidator->isValid($object, RefundModel::class)) {
            throw new InvalidArgumentException(
                implode(PHP_EOL, $instanceValidator->getMessages())
            );
        }

        if (true === array_key_exists('processDate', $data) && false === empty($data['processDate'])) {
            $data['processDate'] = DateTime::createFromFormat(DateTime::ATOM, $data['processDate']);
        }

        /** @var RefundModel $refund */
        $refund = parent::hydrate($data, $object);
        return $refund;
    }
}
