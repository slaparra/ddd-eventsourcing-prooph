<?php

namespace Core\Domain\Model\Employee;

use SharedKernel\Common\Collection\ArrayCollection;
use SharedKernel\Common\Collection\Collection;
use SharedKernel\Domain\Aggregate\AggregateRoot;
use SharedKernel\Domain\ValueObject\Address;
use SharedKernel\Domain\ValueObject\Email;

class Employee extends AggregateRoot
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
    private $title;

    /**
     * @var Employee
     */
    private $manager;

    /**
     * @var Collection
     */
    private $employees;

    /**
     * @var \DateTimeImmutable
     */
    private $birthDate;

    /**
     * @var \DateTimeImmutable
     */
    private $hireDate;

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
     * @var Email
     */
    private $email;

    public function __construct(EmployeeId $id, string $firstName, string $lastName)
    {
        parent::__construct($id);
        $this->employees = ArrayCollection::createEmpty();
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

    public function title(): string
    {
        return $this->title;
    }

    public function manager(): Employee
    {
        return $this->manager;
    }

    public function employees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(Employee $employee): void
    {
        $this->employees->add($employee);
    }

    public function removeEmployee(Employee $employee): void
    {
        $this->employees->removeElement($employee);
    }

    public function birthDate(): \DateTimeImmutable
    {
        return $this->birthDate;
    }

    public function hireDate(): \DateTimeImmutable
    {
        return $this->hireDate;
    }

    public function address(): Address
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

    public function email(): Email
    {
        return $this->email;
    }
}
