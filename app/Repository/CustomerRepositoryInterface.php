<?php
declare(strict_types=1);

namespace App\Repository;
use Illuminate\Support\Collection;

interface CustomerRepositoryInterface
{
   public function findCustomerQuote(string $email): ?Array;

   public function saveCustomer(array $attributes): bool;
}