<?php
declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Customers;
use App\Repository\CustomerRepositoryInterface;
use Illuminate\Support\Collection;

class CustomerRepository implements CustomerRepositoryInterface
{
    /**
     * CustomerRepository constructor.
     * 
     * @param Customers $model
     */
    public function __construct(Customers $model)
    {
        $this->model = $model;
    
    }

    /**
     * @return Array
     */
    public function findCustomerQuote(string $email): ?Array
    {
        $customer = Customers::where('email', $email)->first();
        return ($customer)->toArray() ?? null;
    }

   /**
     * @param array $attributes
     *
     * @return bool
     */
    public function saveCustomer(array $attributes): bool
    {
        $newCustomer = new Customers($attributes);

        return $newCustomer->save();
    }
}