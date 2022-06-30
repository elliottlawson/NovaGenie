<?php

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
