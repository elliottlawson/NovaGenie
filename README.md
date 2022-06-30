
# A Fluent Laravel Nova Testing Utility

[![Latest Version on Packagist](https://img.shields.io/packagist/v/elliottlawson/novagenie.svg?style=flat-square)](https://packagist.org/packages/elliottlawson/novagenie)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/elliottlawson/novagenie/run-tests?label=tests)](https://github.com/elliottlawson/novagenie/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/elliottlawson/novagenie/Check%20&%20fix%20styling?label=code%20style)](https://github.com/elliottlawson/novagenie/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/elliottlawson/novagenie.svg?style=flat-square)](https://packagist.org/packages/elliottlawson/novagenie)

## Installation

You can install the package via composer:

```bash
composer require elliottlawson/novagenie
```

## Usage

Asserting on Lenses
```php
it('operates on lenses', function () {
    novaGenie()
        ->verifyLens(CustomersLens::class)
        ->hasFields([
            Text::class,
            DateTime::class,
        ])
        ->hasFilters([
            NameFilter::class,
            DateFilter::class,
        ])
        ->hasActions([
            UpdateName::class,
        ])
        ->hasCards([
            TopCustomers::class,
        ])
        ->hasUriKey('customers-lens')
        ->hasName('Customers');
});
```
<br/>

Testing Menus
```php
it('operates on menus', function () {
    novaGenie()
        ->accessingMenu(CustomerMenu::class)
        ->as(['editor', 'admin'])
        ->and(function () {
            // custom setup here
        })
        ->isVisible()
        ->isNotVisible()
        ->availableResourcesShouldBe([
            LensResouce::make(Customer::class, NewCustomers::class),
            LensResouce::make(Customer::class, TopCustomers::class),
        ])
        ->availableResourcesShouldNotBe([
            LensResouce::make(Customer::class, HighestRevenueCustomers::class),
        ]);
});
```
<br/>

Testing Filters
```php
it('operates on filters', function() {
    $options = novaGenie()->getFilterOptions(CustomerNameFilter::class);

    novaGenie()
        ->usingFilter(CustomerNameFilter::class)
        ->and(function() {
            Customer::factory()->count(10)->create();
        })
        ->on(Customer::query())
        ->withOption('John Doe')
        ->resultsIn(function (Collection $results) {
            $this->assertCount(1, $results);

            $results->each(fn (Customer $customer) => assertEquals('John Doe', $customer->name));
        });
});
```
## Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
