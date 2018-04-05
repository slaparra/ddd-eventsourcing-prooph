<?php

namespace Core\Domain\Model\Customer;

use SharedKernel\Common\Collection\ArrayCollection;
use SharedKernel\Common\Collection\Collection;
use SharedKernel\Domain\Aggregate\AggregateRoot;
use Core\Domain\Model\Employee\Employee;
use Core\Domain\Model\Invoice\Invoice;
use SharedKernel\Domain\ValueObject\Address;

class Customer extends AggregateRoot
{
    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $company;

    /**
     * @var Address
     */
    private $address;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $fax;

    /**
     * @var string
     */
    private $email;

    /**
     * @var Employee
     */
    private $supporter;

    /**
     * @var Collection
     */
    private $invoices;

    public function __construct(CustomerId $id, string $firstName, string $lastName)
    {
        parent::__construct($id);
        $this->invoices = ArrayCollection::createEmpty();
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function company(): string
    {
        return $this->company;
    }

    public function address(): string
    {
        return $this->address;
    }

    public function phone(): string
    {
        return $this->phone;
    }

    public function fax(): string
    {
        return $this->fax;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function supporter(): Employee
    {
        return $this->supporter;
    }

    public function addInvoice(Invoice $invoice): void
    {
        $this->invoices->add($invoice);
    }

    /**
     * @param Invoice $invoice
     */
    public function removeInvoice(Invoice $invoice)
    {
        $this->invoices->removeElement($invoice);
    }
}
